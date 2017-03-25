<?php
global $lang, $mysql, $settings;

$username = '';
$password = '';
if(isset($_POST['addusersubmit']))
{
    if(empty($_POST['username']))
    {
        $error = $lang['add_user_login_none'];
    }
    else if(empty($_POST['password']))
    {
        $error = $lang['add_user_pass_none'];
    }
    else
    {
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);

        $result = $mysql->query("INSERT INTO `ibot_users` (`username`, `password`) VALUES ('".$username."', MD5('".$password."'))");

        $success = $lang['add_user_success'];
    }
}
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['acc_adduser'];?></h3>
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
                <form class="form-horizontal" action="index.php?adduser" method="post" role="form">
                    <tr>
                        <td width="40%">
                            <strong>
                            	<?php echo $lang['add_user_login'];?>
                            </strong><br />
                            <span class="smalltext">
                            	<?php echo $lang['add_user_login_desc'];?>
                            </span>
                        </td>
                        <td width="60%">
                            <input type="text" value="<?php echo $username; ?>" name="username" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['add_user_pass'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['add_user_pass_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="password" value="<?php echo $password; ?>" name="password" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button class="btn btn-success" name="addusersubmit" type="submit"><?php echo $lang['add'];?></button>
                            <a href="index.php" class="btn btn-default" name="addcategorysubmit" type="submit"><?php echo $lang['back'];?></a>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</div>