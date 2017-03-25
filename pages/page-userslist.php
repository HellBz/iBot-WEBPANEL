<?php
	global $lang, $mysql, $settings;
	if(isset($_GET['delete']) && isset($_GET['userslist']))
	{
		$result = $mysql->query("SELECT * FROM `ibot_users` WHERE `id`='".$_GET['delete']."' LIMIT 1");
		if($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			if($row['username'] != $_SESSION['username'])
			{
				if($row['query'] == 0)
				{
					$result = $mysql->query("DELETE FROM `ibot_users` WHERE `id`='".$_GET['delete']."'");
					$success = $lang['delete_user_success'];
					header('Location: index.php?userslist ');
				}
				else
				{
					$error = $lang['delete_query'];
				}
			}
		}
	}
?>

<br />
<div class="row botsettings-table">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php echo $lang['acc_changepass'];?>
            </h3>
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
            	<?php
            	$result = $mysql->query("SELECT * FROM `ibot_users`");
                if ($result->num_rows != 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                    	echo '
                    		<tr>
			                    <td width="40%">
			                    	'.$row['username'].'
			                    </td>
			                    <td width="10%" align="right">
			                        <a href="index.php?userslist&delete='.$row['id'].'" class="btn btn-danger btn-xs">Usuń</a>
			                    </td>
			                </tr>
                    	';
                    }
                }
            	?>
            </tbody>
        </table>
    </div>
</div>