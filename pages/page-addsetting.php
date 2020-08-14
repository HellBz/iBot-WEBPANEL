<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

global $lang, $mysql;

$codename = '';
$category = '';
$type = '';
$name = '';
$desc = '';
$value = '';
$selectlist = '';

if(isset($_POST['addsettingsubmit']))
{
    $codename = $_POST['codename'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $value = $_POST['value'];
    $selectlist = $_POST['selectlist'];

    if(empty($_POST['codename']))
    {
        $error = $lang['codename_none'];
    }
    else if(empty($_POST['category']))
    {
        $error = $lang['category_none'];
    }
    else if(empty($_POST['type']))
    {
        $error = $lang['type_none'];
    }
    else if(empty($_POST['name']))
    {
        $error = $lang['name_none'];
    }
    else if(empty($_POST['desc']))
    {
        $error = $lang['desc_none'];
    }
    else if(empty($_POST['value']))
    {
        $error = $lang['value_none'];
    }
    if(!isset($error))
    {
        $result = $mysql->query("SELECT * FROM `ibot_settings` WHERE `name` = '".$codename."'");
        if ($result->num_rows != 0)
        {
            $error = $lang['settingname_multiple'];
        }
        else
        {
            $mysql->query("INSERT INTO `ibot_settings` (`name`, `title`, `description`, `optionscode`, `gid`, `value`, `selectlist`) 
                        VALUES ('".$codename."', '".$name."', '".$desc."', '".$type."', '".$category."', '".$value."', '".$selectlist."')");
            $success = $lang['addsetting_created'];

            $_POST['codename'] = '';
            $_POST['category'] = '';
            $_POST['type'] = '';
            $_POST['name'] = '';
            $_POST['desc'] = '';
            $_POST['value'] = '';
            $_POST['selectlist'] = '';
            $codename = '';
            $category = '';
            $type = '';
            $name = '';
            $desc = '';
            $value = '';
            $selectlist = '';
        }
        $result->close();
    }
}
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['addsetting'];?></h3>
        </div>
        <?php
            if(isset($success))
            {
                echo '<div class="alert alert-success" style="margin: 5px;" role="alert" align="center">'.$success.'</div>';
            }
            if(isset($error))
            {
                echo '<div class="alert alert-danger" style="margin: 5px;" role="alert" align="center">'.$error.'</div>';
            }
        ?>
        <table class="table">
            <tbody>
                <form class="form-horizontal" action="index.php?addsetting" method="post" role="form">
                    <tr>
                        <td width="40%">
                            <strong>
                            	<?php echo $lang['addsetting_codename'];?>
                            </strong><br />
                            <span class="smalltext">
                            	<?php echo $lang['addsetting_codename_desc'];?>
                            </span>
                        </td>
                        <td width="60%">
                            <input type="text" value="<?php echo $codename;?>" name="codename" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addsetting_name'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addsetting_name_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $name;?>" name="name" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addsetting_desc'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addsetting_desc_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $desc;?>" name="desc" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                            	<?php echo $lang['addsetting_category'];?>
                            </strong><br />
                            <span class="smalltext">
                            	<?php echo $lang['addsetting_category_desc'];?>
                            </span>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" name="category" id="sel1">
                                    <?php
                                        $result = $mysql->query("SELECT * FROM `ibot_settinggroups`");
                                        if ($result->num_rows != 0)
                                        {
                                            while ($row = $result->fetch_assoc())
                                            {
                                                echo '<option value="'.$row["gid"].'">'.$row["title"].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addsetting_type'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addsetting_type_desc'];?>
                            </span>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" name="type" id="sel1">
                                    <option value="text"><?php echo $lang['type_text']; ?></option>
                                    <option value="numeric"><?php echo $lang['type_numeric']; ?></option>
                                    <option value="numericpm"><?php echo $lang['type_numericpm']; ?></option>
                                    <option value="textarea"><?php echo $lang['type_textarea']; ?></option>
                                    <option value="yesno"><?php echo $lang['type_yesno']; ?></option>
                                    <option value="onoff"><?php echo $lang['type_onoff']; ?></option>
                                    <option value="select"><?php echo $lang['type_select']; ?></option>
                                    <option value="channels"><?php echo $lang['type_channels']; ?></option>
                                    <option value="servergroups"><?php echo $lang['type_servergroups']; ?></option>
                                    <option value="channelgroups"><?php echo $lang['type_channelgroups']; ?></option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addsetting_value'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addsetting_value_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $value;?>" name="value" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addsetting_selectlist'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addsetting_selectlist_desc'];?>
                            </span>
                        </td>
                        <td>
                            <textarea name="selectlist" class="form-control"><?php echo $selectlist;?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <font color="red"><strong>*</strong></font> <?php echo $lang['required'];?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button class="btn btn-success" name="addsettingsubmit" type="submit"><?php echo $lang['add'];?></button>
                            <a href="index.php?settings" class="btn btn-default" name="addcategorysubmit" type="submit"><?php echo $lang['back'];?></a>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</div>