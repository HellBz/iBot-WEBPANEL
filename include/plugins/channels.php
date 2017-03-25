<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function channels_info()
{
	return array(
		"name"			=> "Liczba kanałów",
		"description"	=> "Pokazuje w nazwie wybranego kanału liczbę kanałów na serwerze.",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0)
	);
}

function channels_install()
{
	$setting_group = array(
		"name"			=> "channels_group",
		"title"			=> "Liczba kanałów",
		"description"	=> "Ustawienia pluginu do Liczba kanałów",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "reklama_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "channels_channelname",
		"title" => "Nazwa kanału",
		"description" => "Na co ma zmieniać nazwę kanału, gdzie [channels] oznacza liczbę kanałów na serwerze.",
		"optionscode" => "text",
		"value" => "Liczba kanałów: [channels]",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "channels_channel",
		"title" => "Kanał",
		"description" => "Na jakim kanale ma działać funkcja.",
		"optionscode" => "channels",
		"value" => "3",
		"gid" => $gid
		);
	createSettings($setting);
}

function channels_uninstall()
{
	deleteSettingsCategory("channels_group");
	deleteSettings("reklama_turnon");
	deleteSettings("channels_channelname");
	deleteSettings("channels_channel");
}

function channels_is_installed()
{
	if(getSettingsCategoryID("channels_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function channels_core()
{
	global $query, $settings;
	if($settings['reklama_turnon'])
	{
		$serverinfo = $query->getElement('data', $query->serverInfo());

		$kanaly = array();
		$kanaly['channel_name'] = str_replace('[channels]', $serverinfo['virtualserver_channelsonline'], $settings['channels_channelname']);
		$query->channelEdit($settings['channels_channel'], $kanaly);
	}
}