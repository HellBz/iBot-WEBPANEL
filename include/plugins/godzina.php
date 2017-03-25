<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function godzina_info()
{
	return array(
		"name"			=> "Godzina w nazwie kanału",
		"description"	=> "Pokazuje w nazwie wybranego kanału godzinę.",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 1,'seconds' => 0)
	);
}

function godzina_install()
{
	$setting_group = array(
		"name"			=> "godzina_group",
		"title"			=> "Godzina w nazwie kanału",
		"description"	=> "Ustawienia pluginu do godziny",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "godzina_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "0",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "godzina_channelname",
		"title" => "Nazwa kanału",
		"description" => "Na co ma zmieniać nazwę kanału, gdzie [hour] oznacza aktualną godzinę.",
		"optionscode" => "text",
		"value" => "Godzina: [hour]",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "godzina_channel",
		"title" => "Kanał",
		"description" => "Na jakim kanale ma działać funkcja.",
		"optionscode" => "channels",
		"value" => "3",
		"gid" => $gid
		);
	createSettings($setting);
}

function godzina_uninstall()
{
	deleteSettingsCategory("godzina_group");
	deleteSettings("godzina_turnon");
	deleteSettings("godzina_channelname");
	deleteSettings("godzina_channel");
}

function godzina_is_installed()
{
	if(getSettingsCategoryID("godzina_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function godzina_core()
{
	global $query, $settings;
	if($settings['godzina_turnon'])
	{
		$godzina = array();
		$godzina['channel_name'] = str_replace('[hour]', date('H:i'), $settings['godzina_channelname']);
		$query->channelEdit($settings['godzina_channel'], $godzina);
	}
}