<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function afkchecker_info()
{
	return array(
		"name"			=> "AFK Checker",
		"description"	=> "Sprawdza stan afk użytkowników",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 5)
	);
}

function afkchecker_install()
{
	$setting_group = array(
		"name"			=> "afkchecker_group",
		"title"			=> "AFK Checker",
		"description"	=> "Ustawienia pluginu AFK Checker",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "afkchecker_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "afkchecker_group",
		"title" => "Grupa AFK",
		"description" => "Jaką grupę ma nadawać gdy użytkownik jest AFK?",
		"optionscode" => "servergroups",
		"value" => "1",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "afkchecker_move",
		"title" => "Przenosić gdy AFK?",
		"description" => "Czy przenosić użytkownika gdy jest AFK?",
		"optionscode" => "yesno",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "afkchecker_channel",
		"title" => "Grupa AFK",
		"description" => "Na jaki kanał przenosić gdy AFK?",
		"optionscode" => "channels",
		"value" => "1",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "afkchecker_time",
		"title" => "Czas do AFK?",
		"description" => "Po jakim czasie traktować użytkownika jako AFK?",
		"optionscode" => "numeric",
		"value" => "30",
		"gid" => $gid
		);
	createSettings($setting);
}

function afkchecker_uninstall()
{
	deleteSettingsCategory("afkchecker_group");
	deleteSettings("afkchecker_turnon");
	deleteSettings("afkchecker_group");
	deleteSettings("afkchecker_move");
	deleteSettings("afkchecker_channel");
	deleteSettings("afkchecker_time");
}

function afkchecker_is_installed()
{
	if(getSettingsCategoryID("afkchecker_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function afkchecker_core()
{
	global $query, $settings, $clientchannel;
	if($settings['afkchecker_turnon'])
	{
		$users = $query->getElement('data',$query->clientList('-groups -voice -away -times -uid'));
		foreach ($users as $client)
		{
			$idle = $client['client_idle_time'];
			$time = $settings['afkchecker_time'];
			$group = $settings['afkchecker_group'];

			if($client['client_type'] == 0)
			{
				if($idle>$time*60000 || $client['client_input_muted']==1 || $client['client_output_muted']==1 || $client['client_away']==1)
			    {
			    	$query->serverGroupAddClient($group, $client['client_database_id']);
					if($settings['afkchecker_move'])
					{
						$clientchannel[$client['client_unique_identifier']] = $client['cid'];
						$query->clientMove($client['clid'], $settings['afkchecker_channel']);
					}
				}
				else
				{
					$query->serverGroupDeleteClient($group, $client['client_database_id']);
					if($settings['afkchecker_move'])
					{
						$query->clientMove($client['clid'], $clientchannel[$client['client_unique_identifier']]);
						unset($clientchannel[$client['client_unique_identifier']]);
					}
				}
			}
		}
		unset($users);
		unset($idle);
		unset($time);
		unset($group);
	}
}