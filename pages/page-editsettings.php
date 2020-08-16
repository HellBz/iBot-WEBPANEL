<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

global $lang, $query, $mysql;

if(isset($_POST['settingsubmit']))
{
    $dane = '';
    $first = true;
    foreach($_SESSION['setting'] as $ustawienie)
    {
        $_POST[$ustawienie] = addslashes($_POST[$ustawienie]);
        $result = $mysql->query("UPDATE ibot_settings SET value = '".$_POST[$ustawienie]."' WHERE name = '".$ustawienie."'");
    }
    $success = 'Ustawienia zaktualizowane pomyślnie.';
}
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['edit_settings'].' ['.getSettingsCategoryName($_GET['editsettings']).']';?></h3>
        </div>
        <?php
            if(isset($success))
            {
                echo '<div class="alert alert-success" style="margin: 5px;" role="alert">'.$success.'</div>';
            }
        ?>
        <table class="table">
            <form class="form-horizontal" action="index.php?editsettings=<?php echo $_GET['editsettings'];?>" method="post" role="form"> 
                <?php
                    $result = $mysql->query("SELECT * FROM `ibot_settings` WHERE gid = '".$_GET['editsettings']."'");
                    if ($result->num_rows != 0)
                    {
                        unset($_SESSION['setting']);
                        $_SESSION['setting'] = array();
                        while ($row = $result->fetch_assoc())
                        {
                            if($row['optionscode'] == 'text') $input = generateInputText($row['name'], $row['value']);
                            else if($row['optionscode'] == 'text') $input = generateInputText($row['name'], $row['value']);
                            else if($row['optionscode'] == 'numeric') $input = generateInputNumber($row['name'], $row['value']);
                            else if($row['optionscode'] == 'numericpm') $input = generateInputNumberPlusMinus($row['name'], $row['value']);
                            else if($row['optionscode'] == 'numericdu') $input = generateInputNumberDuration($row['name'], $row['value']);
                            else if($row['optionscode'] == 'textarea') $input = generateInputTextarea($row['name'], $row['value']);
                            else if($row['optionscode'] == 'yesno') $input = generateInputYesno($row['name'], $row['value']);
                            else if($row['optionscode'] == 'onoff') $input = generateInputOnoff($row['name'], $row['value']);
                            else if($row['optionscode'] == 'channels') $input = generateInputChannels($row['name'], $row['value']);
                            else if($row['optionscode'] == 'servergroups') $input = generateInputServerGroups($row['name'], $row['value']);
                            else if($row['optionscode'] == 'channelgroups') $input = generateInputServerGroups($row['name'], $row['value']);
                            else if($row['optionscode'] == 'select')
                            {
                                $input = generateInputSelect($row['name'], $row['selectlist'], $row['value']);
                            }
                            else $input = 'Error';
                            
                            echo '
                            <tr>
                                <td>
                                    <strong>'.$row['title'].'</strong><br />
                                    <span class="smalltext">'.$row['description'].'</span>
                                </td>
                                <td>
                                    '.$input.'
                                </td>
                            </tr>';

                            array_push($_SESSION['setting'], $row['name']);
                        }
                    }
                    else
                    {
                        header('Location: index.php?settings ');
                    }
                ?>
                <tr>
                    <td colspan="2" align="center">
                        <button class="btn btn-success" name="settingsubmit" type="submit"><?php echo $lang['edit'];?></button>
                        <a href="index.php?settings" class="btn btn-default"><?php echo $lang['back'];?></a>
                    </td>
                </tr>
            </form>
        </table>
    </div>
</div>