<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function channelchecker_info()
{
	return array(
		"name"			=> "Sprawdzanie kanałów",
		"description"	=> "Sprawdza kanały odnośnie ważności oraz przedłuża automatycznie ich ważność.",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 30,'seconds' => 0)
	);
}

function channelchecker_install()
{
	$setting_group = array(
		"name"			=> "channelchecker_group",
		"title"			=> "Sprawdzanie kanałów",
		"description"	=> "Sprawdza kanały odnośnie ważności oraz przedłuża automatycznie ich ważność.",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "channelchecker_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "channelchecker_time",
		"title" => "Czas przedłużenia",
		"description" => "O ile dni przedłużać ważność kanału?",
		"optionscode" => "numeric",
		"value" => "3",
		"gid" => $gid
		);
	createSettings($setting);
}

function channelchecker_uninstall()
{
	deleteSettingsCategory("channelchecker_group");
	deleteSettings("channelchecker_turnon");
	deleteSettings("channelchecker_time");
}

function channelchecker_is_installed()
{
	if(getSettingsCategoryID("channelchecker_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function channelchecker_core()
{
	global $query, $settings, $mysql;
	if($settings['channelchecker_turnon'])
	{
		$result = $mysql->query("SELECT * FROM `ibot_privatechannels`");
		if($result->num_rows)
		{
			while($row = $result->fetch_assoc())
			{
				if((int)$row['time'] < time())
				{
					$query->channelDelete($row['cid'], 1);
					$mysql->query("DELETE FROM `ibot_privatechannels` WHERE `cid`='".$row['cid']."'");
				}
			}
		}
		$result->close();

		$channels = $query->getElement('data', $query->channelList("-topic"));
		foreach($channels as $channel)
		{
			if($channel['channel_topic'] == 'delete')
			{
				$query->channelDelete($channel['cid'], 1);
				$mysql->query("DELETE FROM `ibot_privatechannels` WHERE `cid`='".$channel['cid']."'");
			}
		}

		$clients = $query->getElement('data', $query->clientList("-uid"));
		foreach($clients as $client)
		{
			$result = $mysql->query("SELECT * FROM `ibot_privatechannels` WHERE `uid`='".$client['client_unique_identifier']."' AND `cid`='".$client['cid']."'");
			if($result->num_rows > 0)
			{
				$time = time() + ($settings['channelchecker_time'] * 86400);
				$mysql->query("UPDATE `ibot_privatechannels` SET `time`='{$time}' WHERE `uid`='".$client['client_unique_identifier']."'");
				$query->channelEdit($client['cid'], array(
					'channel_topic'=>date("d.m.y H:i", $time)
					));
			}
		}
	}
}