<?php
global $lang, $mysql, $settings;

$oldpass = '';
$newpass = '';
$replypass = '';
if(isset($_POST['editpass']))
{
    $oldpass = addslashes($_POST['oldpass']);
    $newpass = addslashes($_POST['newpass']);
    $replypass = addslashes($_POST['replypass']);
    if(empty($_POST['oldpass']))
    {
        $error = $lang['old_pass_none'];
    }
    else if(empty($_POST['newpass']))
    {
        $error = $lang['new_pass_none'];
    }
    else if(empty($_POST['replypass']))
    {
        $error = $lang['new_pass_reply_none'];
    }
    else
    {
        $result = $mysql->query("SELECT * FROM `ibot_users` WHERE `password`=MD5('".$oldpass."') AND `username`='".$_SESSION['username']."'");
        if($result->num_rows == 0)
        {
            $error = $lang['bad_old_pass']."SELECT * FROM `ibot_users` WHERE `password`=MD5('".$oldpass."') AND `username`='".$_SESSION['username']."'";
        }
        else if($newpass != $replypass)
        {
            $error = $lang['bad_reply'];
        }
        else
        {
            $mysql->query("UPDATE `ibot_users` SET `password`=MD5('".$newpass."') WHERE `username`='".$_SESSION['username']."'");
            $success = $lang['change_pass_success'];
        }
    }
}
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['acc_changepass'];?></h3>
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
                <form class="form-horizontal" action="index.php?changepassword" method="post" role="form">
                    <tr>
                        <td width="40%">
                            <strong>
                            	<?php echo $lang['old_pass'];?>
                            </strong><br />
                            <span class="smalltext">
                            	<?php echo $lang['old_pass_desc'];?>
                            </span>
                        </td>
                        <td width="60%">
                            <input type="password" value="<?php echo $oldpass; ?>" name="oldpass" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['new_pass'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['new_pass_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="password" value="<?php echo $newpass; ?>" name="newpass" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $lang['new_pass_reply'];?>
                            </strong><br />
                            <span class="smalltext">
                                <?php echo $lang['new_pass_reply_desc'];?>
                            </span>
                        </td>
                        <td>
                            <input type="password" value="<?php echo $replypass; ?>" name="replypass" class="form-control" aria-describedby="basic-addon1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button class="btn btn-success" name="editpass" type="submit"><?php echo $lang['edit'];?></button>
                            <a href="index.php" class="btn btn-default" name="" type="submit"><?php echo $lang['back'];?></a>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</div>