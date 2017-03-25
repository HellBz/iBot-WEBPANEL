<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

global $lang, $mysql;

$name = '';
$nazwa = '';
$desc = '';
$default = 0;

if(isset($_POST['addcategorysubmit']))
{
    $name = $_POST['name'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
	if(empty($_POST['name']))
	{
		$error = $lang['name_none'];
	}
	else if(empty($_POST['title']))
    {
        $error = $lang['title_none'];
    }
    else if(empty($_POST['desc']))
    {
        $error = $lang['desc_none'];
    }
	if(!isset($error))
	{
		$result = $mysql->query("SELECT * FROM `ibot_settinggroups` WHERE `name` = '".$name."'");
		if ($result->num_rows != 0)
		{
			$error = $lang['nazwasql_multiple'];
		}
		else
		{
			$mysql->query("INSERT INTO `ibot_settinggroups` (`name`, `title`, `description`, `isdefault`) VALUES 
                                    ('".$_POST['name']."', '".$_POST['title']."', '".$_POST['desc']."', '".$_POST['default']."')");
			
            $success = $lang['category_created'];
			$_POST['name'] = '';
			$_POST['title'] = '';
            $_POST['desc'] = '';
            $_POST['default'] = '';
            $nazwasql = '';
            $nazwa = '';
            $desc = '';
            $default = 0;
		}
		$result->close();
	}
}
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['addcategory'];?></h3>
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
                <form class="form-horizontal" action="index.php?addcategory" method="post" role="form">
                    <tr>
                        <td width="40%">
                            <strong>
                            	<?php echo $lang['addcategory_codename'];?>
                            </strong><br />
                            <span class="smalltext">
                            	<?php echo $lang['addcategory_codename_desc'];?>
                            </span>
                        </td>
                        <td width="60%">
                            <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addcategory_name'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addcategory_name_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $nazwa; ?>" name="title" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addcategory_desc'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addcategory_desc_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $desc; ?>" name="desc" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['addcategory_default'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['addcategory_default_desc'];?>
                            </span>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" name="default" id="sel1">
                                    <option value="0"><?php echo $lang['no']; ?></option>
                                    <option value="1"><?php echo $lang['yes']; ?></option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button class="btn btn-success" name="addcategorysubmit" type="submit"><?php echo $lang['add'];?></button>
                            <a href="index.php?settings" class="btn btn-default" name="addcategorysubmit" type="submit"><?php echo $lang['back'];?></a>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</div>