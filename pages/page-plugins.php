<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

global $lang, $mysql, $query, $settings;

if(isset($_GET['install']))
{
	$filename = 'include/plugins/'.$_GET['install'].'.php';
	include_once $filename;

	$plugin_install_function = $_GET['install']."_install";
	$plugin = $plugin_install_function();
	header('Location: index.php?plugins ');
}

if(isset($_GET['uninstall']))
{
	$filename = 'include/plugins/'.$_GET['uninstall'].'.php';
	include_once $filename;

	$plugin_uninstall_function = $_GET['uninstall']."_uninstall";
	$plugin = $plugin_uninstall_function();
	header('Location: index.php?plugins ');
}
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['plugins'];?></h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <td class="tcat"><strong><?php echo $lang['plugins_name'];?></strong></td>
                    <td class="tcat" align="center" width="20%"><strong><?php echo $lang['plugins_action'];?></strong></td>
                </tr>
            </thead>
            <tbody>
            	<?php
            	foreach (glob("include/plugins/*.php") as $filename)
				{
					include_once $filename;

					$plugin_name = getPluginName($filename);
					$plugin_info_function = $plugin_name."_info";
				    $plugin = $plugin_info_function();

				    $action_link = '<a href="index.php?plugins&install='.$plugin_name.'" class="btn btn-success">'.$lang['plugins_install'].'</a>';
				    $plugin_is_installed_function = $plugin_name."_is_installed";
				    if($plugin_is_installed_function() == true)
				    {
				    	$action_link = '<a href="index.php?plugins&uninstall='.$plugin_name.'" class="btn btn-danger">'.$lang['plugins_uninstall'].'</a>';
				    }

				    if(isset($plugin['authorsite']))
				    {
				    	$autor = '<i>'.$lang['plugins_autor'].': <a href="'.$plugin['authorsite'].'">'.$plugin['author'].'</a></i>';
				    }
				    else
				    {
				    	$autor = '<i>'.$lang['plugins_autor'].': '.$plugin['author'].'</i>';
				    }
				    echo '
				    	<tr>
				    		<td>
				    			<strong>'.switch_lang($plugin,'name').'</strong> <span class="smalltext">'.$plugin['version'].'</span><br />
				    			<span class="smalltext">'.switch_lang($plugin,'description').'</span><br />
				    			<span class="smalltext">'.$autor.'</span>
				    		</td>
				    		<td align="center">
				    			'.$action_link.'
				    		</td>
				    	</tr>
				    ';
				}
            	?>
            </tbody>
        </table>
    </div>
</div>