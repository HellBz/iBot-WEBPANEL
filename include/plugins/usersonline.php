<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function usersonline_info()
{
	return array(
		"name"			=> "Użytkownicy w nazwie kanału",
		"description"	=> "Pokazuje w nazwie wybranego kanału liczbę użytkowników.",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 1,'seconds' => 0)
	);
}

function usersonline_install()
{
	$setting_group = array(
		"name"			=> "usersonline_group",
		"title"			=> "Użytkownicy w nazwie kanału",
		"description"	=> "Ustawienia pluginu do użytkowników online",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "usersonline_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "usersonline_channelname",
		"title" => "Nazwa kanału",
		"description" => "Na co ma zmieniać nazwę kanału, gdzie [online] oznacza aktualną godzinę.",
		"optionscode" => "text",
		"value" => "Online: [online]",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "usersonline_channel",
		"title" => "Kanał",
		"description" => "Na jakim kanale ma działać funkcja.",
		"optionscode" => "channels",
		"value" => "3",
		"gid" => $gid
		);
	createSettings($setting);
}

function usersonline_uninstall()
{
	deleteSettingsCategory("usersonline_group");
	deleteSettings("usersonline_turnon");
	deleteSettings("usersonline_channelname");
	deleteSettings("usersonline_channel");
}

function usersonline_is_installed()
{
	if(getSettingsCategoryID("usersonline_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function usersonline_core()
{
	global $query, $settings;
	if($settings['usersonline_turnon'])
	{
		$serverinfo = $query->getElement('data', $query->serverInfo());
		$bots = $serverinfo['virtualserver_queryclientsonline'];
		$users = $serverinfo['virtualserver_clientsonline'];
		$online = $users - $bots;

		$data = array();
		$data['channel_name'] = str_replace('[online]',$online, $settings['usersonline_channelname']);
		$query->channelEdit($settings['usersonline_channel'], $data);
	}
}