<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function adminlist_info()
{
	return array(
		"name"			=> "Lista administracji",
		"description"	=> "Wyświetla listę administracji online w opisie kanału",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0)
	);
}

function adminlist_install()
{
	$setting_group = array(
		"name"			=> "adminlist_group",
		"title"			=> "Lista administracji",
		"description"	=> "Wyświetla listę administracji online w opisie kanału",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "adminlist_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "adminlist_groups",
		"title" => "Grupy",
		"description" => "Jakie grupy ma wyświetlać",
		"optionscode" => "text",
		"value" => "6",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "adminlist_channels",
		"title" => "Grupy",
		"description" => "Na którym kanale wyświetlać listę administracji?",
		"optionscode" => "channels",
		"value" => "6",
		"gid" => $gid
		);
	createSettings($setting);
}

function adminlist_uninstall()
{
	deleteSettingsCategory("adminlist_group");
	deleteSettings("adminlist_turnon");
	deleteSettings("adminlist_groups");
	deleteSettings("adminlist_channels");
}

function adminlist_is_installed()
{
	if(getSettingsCategoryID("adminlist_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function adminlist_core()
{
	global $query, $settings;
	if($settings['adminlist_turnon'])
	{
		$ag = $settings['adminlist_groups'];
		$adminsgroups = explode(",", $ag);

		$desc = '[center][size=15][b]Lista Administracji[/b][/size][/center]\n\n';
		foreach($adminsgroups as $group)
		{
			$group = (int)$group;
			$group_name = getGroupName($group);
			$groupsclients = $query->getElement('data', $query->serverGroupClientList($group, $names = true));
			$clients = $query->getElement('data', $query->clientList("-uid -groups -times -voice"));
			$desc.= '[center][size=12][b]' . $group_name . '[/b][/size][/center]\n';
			if (array_key_exists('client_nickname', $groupsclients[0]))
			{
				foreach($groupsclients as $groupclient)
				{
					foreach($clients as $client)
					{
						if ($client['client_unique_identifier'] == $groupclient['client_unique_identifier'])
						{
							$online = true;
							break;
						}
						else
						{
							$online = false;
						}
					}

					if ($online)
					{
						$user_channel = $query->getElement('data', $query->channelInfo($client['cid']));

						if(	$client['client_input_muted'] != 0 || 
							$client['client_output_muted'] != 0 ||
							$client['client_idle_time'] > 15*60000)
						{
							$time = round($client['client_idle_time'] / 60000);
							$status = '[color=#FFC000][b]AFK (od '.$time.' minut)[/b][/color]';
						}
						else
						{
							$status = '[color=green][b]ONLINE[/b][/color]';
						}

						$desc.= "[size=10][url=client://".$client['clid']."/".$groupclient['client_unique_identifier']."][b]".$groupclient['client_nickname']."[/b][/url] jest aktualnie ".$status." na kanale [B][URL=channelID://".$client['cid']."]".$user_channel['channel_name']."[/URL][/B][/size]\n";
						
					}
					else
					{
						$info = $query->getElement('data', $query->clientDbInfo($groupclient['cldbid']));
						$seconds = time() - $info['client_lastconnected'];

						$days    = floor($seconds / 86400);
						$hours   = floor(($seconds - ($days * 86400)) / 3600);
						$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
						$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
						
						$desc.= '[size=10][url=client://' . $client['clid'] . '/' . $groupclient['client_unique_identifier'] . '][b]' . $groupclient['client_nickname'] . '[/b][/url] jest aktualnie [color=red][b]OFFLINE[/b][/color] od '.$days.' dni, '.$hours.' godzin i '.$minutes.' minut[/size]\n';
					
					}
				}
				$desc.= '[hr]\n';
			}
			else
			{
				$desc.= '[size=10][b]Brak![/b][/size]\n[hr]\n';
			}
		}
		$channel = $query->channelInfo($settings['adminlist_channels']);
		if (strcmp($channel['data']['channel_description'], $desc) != 0)
		{
			$query->channelEdit($settings['adminlist_channels'], array(
				'channel_description' => $desc
			));
		}
	}
}