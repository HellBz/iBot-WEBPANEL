<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

function reklama_info()
{
	return array(
		"name"			=> "Reklama",
		"description"	=> "Wysyła reklamę co X minut",
		"author"		=> "Piotr 'Inferno' Grencel",
		"authorsite"	=> "http://www.github.com/inferno211",
		"version"		=> "1.0",
		"interval"		=> array('days' => 0,'hours' => 0,'minutes' => 30,'seconds' => 0)
	);
}

function reklama_install()
{
	$setting_group = array(
		"name"			=> "reklama_group",
		"title"			=> "Reklama",
		"description"	=> "Ustawienia pluginu do reklamy",
		"isdefault"		=> 0
		);

	$gid = createSettingsCategory($setting_group);

	$setting = array(
		"name" => "reklama_tresc",
		"title" => "Treść reklamy",
		"description" => "Podaj treść reklamy jaka będzie wyświetlana co dany czas",
		"optionscode" => "textarea",
		"value" => "Reklama",
		"gid" => $gid
		);
	createSettings($setting);

	$setting = array(
		"name" => "reklama_turnon",
		"title" => "Włączony",
		"description" => "Czy plugin ma być włączony?",
		"optionscode" => "onoff",
		"value" => "Reklama",
		"gid" => $gid
		);
	createSettings($setting);
}

function reklama_uninstall()
{
	deleteSettingsCategory("reklama_group");
	deleteSettings("reklama_tresc");
	deleteSettings("reklama_turnon");
}

function reklama_is_installed()
{
	if(getSettingsCategoryID("reklama_group") == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function reklama_core()
{
	global $query, $settings;
	if($settings['reklama_turnon'])
	{
		$query->sendMessage(3, 1, $settings['reklama_tresc']);
	}
}