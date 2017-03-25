<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}
?>

<br />
<div class="login-panel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Logowanie</h3>
        </div>
        <div class="panel-body">
            <?php
            if(isset($error))
            {
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            }
            ?>
            <form class="form-horizontal" action="login.php" method="post" role="form">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Login</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="p_login" name="p_login" placeholder="Login">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Hasło</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="p_haslo" name="p_haslo" placeholder="Hasło">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="p_logowanie">Zaloguj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>