<?php
date_default_timezone_set('Europe/Warsaw');
ini_set('default_charset', 'UTF-8');
setlocale(LC_ALL, 'UTF-8');
ini_set('memory_limit', '-1');
define("IN_IBOT", true);

global $lang, $mysql, $query, $settings;

include 'include/config.php';
include 'include/ts3admin.class.php';
include 'include/core.php';
include 'include/functions.php';

$query->setName($settings['bot_name']);
$core = $query->getElement('data',$query->whoAmI());
$query->clientMove($core['client_id'],$settings['bot_channel']);

$plugins = getInstalledPlugins();
foreach ($plugins as $plugin)
{
	$data[$plugin] = '1970-01-01 00:00:00';
}

echo 'iBot' . PHP_EOL;
echo 'Zaladowano '.count($plugins).' funkcji' . PHP_EOL;
echo 'Konsola bota: ' . PHP_EOL;

$last_check = time();

while(true)
{
	if(time() - $last_check > 0)
	{
		$result = $mysql->query("SELECT * FROM `ibot_settings`");
		if ($result->num_rows != 0)
		{
			while ($row = $result->fetch_assoc())
			{
			   	$settings[$row['name']] = $row['value'];
			}
		}
		$result->close();
		
		$last_check = time();
		$date = date('Y-m-d G:i:s');
		for($i=0; $i<count($plugins); $i++)
		{
			include_once 'include/plugins/'.$plugins[$i].'.php';
			$getinfo = $plugins[$i]."_info";

			$info = $getinfo();
            
            if ( is_array( $info['interval'] ) )    $intval = convertinterval($info['interval']);
            else                                    $intval = $settings[$info['interval']];
            
			if(doit($date, $data[$plugins[$i]], $intval ))
			{
				$function = $plugins[$i]."_core";
				$function();
				$data[$plugins[$i]] = $date;
			}
		}
	}
}

function doit($date1, $date2, $interval) 
{
	$time2 = strtotime($date2);
	$time1 = strtotime($date1);
	$sum = $time1 - $time2;
		
	if($sum >= $interval) 
	{
		$ready = true;
	} 
	else 
	{
		$ready  = false;
	}
		
	return $ready;
}

function convertinterval($interval) 
{
	$interval['hours'] = $interval['hours'] + $interval['days']*24;
	$interval['minutes'] = $interval['minutes'] + $interval['hours']*60;
	$interval['seconds'] = $interval['seconds'] + $interval['minutes']*60;

	return $interval['seconds'];
}
?>
