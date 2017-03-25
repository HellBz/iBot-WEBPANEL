<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

global $lang, $error, $success, $mysql;
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['main_settings'];?></h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <td>
                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                            <a type="button" class="btn btn-default" href="index.php?addcategory"><?php echo $lang['addcategory'];?></a>
                            <a type="button" class="btn btn-default" href="index.php?addsetting"><?php echo $lang['addsetting'];?></a>
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr class="tcat">
                    <td><strong><?php echo $lang['main_settings'];?></strong></td>
                </tr>
                <?php
                $result = $mysql->query("SELECT * FROM `ibot_settinggroups` WHERE isdefault='1'");
                if ($result->num_rows != 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        $result2 = $mysql->query("SELECT * FROM `ibot_settings` WHERE `gid`='".$row['gid']."'");
                        $numsettings = $result2->num_rows;
                        $result2->close();
                        echo '
                            <tr>
                                <td>
                                    <strong><a href="index.php?editsettings='.$row['gid'].'">'.$row['title'].'</a></strong> ('.$numsettings.' '.$lang['inputs'].')<br />
                                    <span class="smalltext">'.$row['description'].'</span>
                                </td>
                            </tr>
                            ';
                    }
                }
                else
                {
                    echo '<tr><td colspan="2">Brak ustawień.</td></tr>';
                }
                $result->close();
                ?>
                <tr class="tcat">
                    <td><strong><?php echo $lang['plugin_settings'];?></strong></td>
                </tr>
                <?php
                $result = $mysql->query("SELECT * FROM `ibot_settinggroups` WHERE isdefault='0'");
                if ($result->num_rows != 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        $result2 = $mysql->query("SELECT * FROM `ibot_settings` WHERE `gid`='".$row['gid']."'");
                        $numsettings = $result2->num_rows;
                        $result2->close();
                        echo '
                            <tr>
                                <td>
                                    <strong><a href="index.php?editsettings='.$row['gid'].'">'.$row['title'].'</a></strong> ('.$numsettings.' '.$lang['inputs'].')<br />
                                    <span class="smalltext">'.$row['description'].'</span>
                                </td>
                            </tr>
                            ';
                    }
                }
                else
                {
                    echo '<tr><td colspan="2">Brak ustawień.</td></tr>';
                }
                $result->close();
                ?>
            </tbody>
        </table>
    </div>
</div>