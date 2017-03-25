<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function privatechannel_info()
{
	return array(
		"name"			=> "Prywatne kanały",
		"description"	=> "Tworzy i pilnuje daty prywatnych kanałów.",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 5)
	);
}

function privatechannel_install()
{
	global $mysql;
	$setting_group = array(
		"name"			=> "privatechannel_group",
		"title"			=> "Prywatne kanały",
		"description"	=> "Tworzy i pilnuje daty prywatnych kanałów.",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "privatechannel_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_channel",
		"title" => "Kanał do przyznawania prywatnych kanałów",
		"description" => "Na jaki kanał musi wejść użytkownik by otrzymać prywatny kanał?",
		"optionscode" => "channels",
		"value" => "470",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_group",
		"title" => "Wymagana grupa",
		"description" => "Jaką grupę trzeba posiadać by otrzymać prywatny kanał?",
		"optionscode" => "servergroups",
		"value" => "23",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_brakgrupy",
		"title" => "Komunikat o braku grupy",
		"description" => "Jaki komunikat ma wyświetlić użytkownikowi gdy nie posiada grupy?",
		"optionscode" => "textarea",
		"value" => "[B]Niestety, nie posiadasz odpowiednich grup by otrzymać kanał prywatny.[/B]",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_strefa",
		"title" => "Strefa kanałów",
		"description" => "Do jakiego kanału ma być podpięta strefa kanałów?",
		"optionscode" => "channels",
		"value" => "105",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_msgnewchannel",
		"title" => "Wiadomość o otrzymaniu kanału",
		"description" => "Jaką wiadomość ma bot wysłać użytkownikowi gdy ten otrzyma kanał?",
		"optionscode" => "textarea",
		"value" => "Prywatny kanał i jego podkanały zostały utworzone!\nŻyczymy miłych rozmów!",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_time",
		"title" => "Ważność kanału",
		"description" => "Ile dni ma byź ważny kanał po jego utworzeniu?",
		"optionscode" => "numeric",
		"value" => "3",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_ownchannel",
		"title" => "Wiadomość o posiadaniu już kanału",
		"description" => "Jaką wiadomość ma bot wysłać użytkownikowi gdy ten posiada już kanał?",
		"optionscode" => "textarea",
		"value" => "Posiadasz juz u nas kanał prywatny, zostałeś na niego przeniesiony.",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_chdesc",
		"title" => "Opis kanału",
		"description" => "Jaką wiadomość wpisać w opis kanału po utworzeniu?<br/><strong>Dodatkowe dane:</strong><br />[data] - data założenia<br />[owner] - właściciel",
		"optionscode" => "textarea",
		"value" => "[hr][center]Właściciel: [b][owner][/b]\nData założenia: [b][data][/b]\nAdministrator: [b]Bot[/b][/center][hr]",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "privatechannel_subchannel",
		"title" => "Liczba podkanałów",
		"description" => "Ile podkanałów ma utworzyć bot?",
		"optionscode" => "numeric",
		"value" => "2",
		"gid" => $gid
		);
	createSettings($setting);

	$mysql->query("CREATE TABLE `ibot_privatechannels` ( `id` int(11) NOT NULL, `uid` varchar(100) NOT NULL, `cid` int(11) NOT NULL, `time` varchar(255) NOT NULL DEFAULT '1970-01-01 00:00:00' )");
}



function privatechannel_uninstall()
{
	global $mysql;
	deleteSettingsCategory("privatechannel_group");
	deleteSettings("privatechannel_turnon");
	deleteSettings("privatechannel_channel");
	deleteSettings("privatechannel_group");
	deleteSettings("privatechannel_brakgrupy");
	deleteSettings("privatechannel_strefa");
	deleteSettings("privatechannel_msgnewchannel");
	deleteSettings("privatechannel_time");
	deleteSettings("privatechannel_ownchannel");
	deleteSettings("privatechannel_chdesc");
	deleteSettings("privatechannel_subchannel");

	$mysql->query("DROP TABLE `ibot_privatechannels`");
}

function privatechannel_is_installed()
{
	if(getSettingsCategoryID("privatechannel_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function privatechannel_core()
{
	global $query, $settings, $mysql;
	if($settings['privatechannel_turnon'])
	{
		$clients = $query->getElement('data', $query->clientList("-uid -away -voice -times -groups -info -country -icon -ip -badges"));

		foreach($clients as $client)
		{
			if($client['cid'] == $settings['privatechannel_channel'])
			{
				$client_groups = explode(",", $client['client_servergroups']);
				if(in_array($settings['privatechannel_group'], $client_groups))
				{
					$result = $mysql->query("SELECT * FROM `ibot_privatechannels` WHERE `uid` = '".$client['client_unique_identifier']."'");
					if($result->num_rows == 0)
					{
						$time = time() + ($settings['privatechannel_time'] * 86400);
						
						$desc = $settings['privatechannel_chdesc'];
						$desc = str_replace('[owner]', $client['client_nickname'], $desc);
						$desc = str_replace('[data]', date("d.m.y", time()), $desc);
						
						$channelinfo = $query->channelCreate(
								array(
									'channel_flag_permanent' => 1, 
									'cpid' => $settings['privatechannel_strefa'], 
									'channel_name' => 'Kanał '.$client['client_nickname'], 
									'channel_flag_maxclients_unlimited'=>1, 
									'channel_flag_maxfamilyclients_unlimited'=>1,
									'channel_description'=>$desc,
									'channel_topic'=>date("d.m.y H:i", $time))
								);
						$query->sendMessage(1, $client['clid'], $settings['privatechannel_msgnewchannel']);
						$query->clientMove($client['clid'], $channelinfo['data']['cid']);

						for($i = 0; $i < $settings['privatechannel_subchannel']; $i++)
						{
							$numer = $i + 1;
							$query->channelCreate(
								array(
									'channel_flag_permanent' => 1, 
									'cpid' => $channelinfo['data']['cid'], 
									'channel_name' => $numer.'. Podkanał', 
									'channel_flag_maxclients_unlimited'=>1, 
									'channel_flag_maxfamilyclients_unlimited'=>1)
								);
						}

						$uid = $client['client_unique_identifier'];
						$cid = $channelinfo['data']['cid'];
						$mysql->query("INSERT INTO `ibot_privatechannels` (`uid`, `cid`, `time`) VALUES ('{$uid}', '{$cid}', '{$time}')");
					}
					else
					{
						$row = $result->fetch_assoc();
						$query->sendMessage(1, $client['clid'], $settings['privatechannel_ownchannel']);
						$query->clientMove($client['clid'], $row['cid']);
					}
					$result->close();
				}
				else
				{
					$query->sendMessage(1, $client['clid'], $settings['privatechannel_brakgrupy']);
					$query->clientKick($client['clid'], "channel", "No permissions.");
				}
			}
		}
	}
}