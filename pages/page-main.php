<?php
if(!empty($_POST['changestatus']) && !empty($_POST['type']))
{
    echo exec("sudo /home/www/inferno24/ibot/panel/bot.sh ".$_POST['type']." 2>&1");
    return;
}

if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

global $lang, $mysql, $query, $settings;

?>
<br />
<div class="row">
    <div class="col-md-3">
        <div class="small-box" style="background-color: #00c0ef !important;">
            <div class="inner">
                <h3>
                    <?php 
                        $serverinfo = $query->getElement('data', $query->serverInfo());
                        $bots = $serverinfo['virtualserver_queryclientsonline'];
                        $users = $serverinfo['virtualserver_clientsonline'];
                        $online = $users - $bots;
                        echo $online;
                    ?>
                </h3>

                <p><?php echo $lang['main_users'];?></p>
            </div>
            <div class="icon">
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <a href="index.php?usersonline" class="small-box-footer"><?php echo $lang['more_info'];?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box" style="background-color: #00a65a !important;">
            <div class="inner">
                <h3>
                    <?php 
                        $serverinfo = $query->getElement('data', $query->serverInfo());
                        echo $serverinfo['virtualserver_channelsonline'];
                    ?>

                </h3>

                <p><?php echo $lang['main_channels'];?></p>
            </div>
            <div class="icon">
                <i class="fa fa-folder" aria-hidden="true"></i>

            </div>
            <a href="#" class="small-box-footer"><?php echo $lang['more_info'];?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box" style="background-color: #f39c12 !important;">
            <div class="inner">
                <h3>
                    <?php 
                        $fp = fopen('cache/onlinerecord.txt', "r");
                        $tekst = fread($fp, 4);
                        $record = (int)$tekst;
                        fclose($fp);
                        echo $record;
                    ?>
                </h3>

                <p><?php echo $lang['main_rekordonline'];?></p>
            </div>
            <div class="icon">
                <i class="fa fa-signal" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $lang['more_info'];?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box" style="background-color: #dd4b39 !important;">
            <div class="inner">
                <h3>
                    
                    <?php 
                        $serverinfo = $query->getElement('data', $query->serverInfo());
                        echo $serverinfo['virtualserver_maxclients'];
                    ?>

                </h3>

                <p><?php echo $lang['main_slots'];?></p>
            </div>
            <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer"><?php echo $lang['more_info'];?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<?php
$fp = fopen('cache/checkupdate.txt', "r");
$tekst = fread($fp, 4);
$installedversion = (int)$tekst;
fclose($fp);

$strona = getStatus("http://inferno24.eu/update/checkupdatev2.txt");
$gitversion = (int)$strona;

if($installedversion != $gitversion)
{
    echo '
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> '.$lang['update_warning'].'!</h4>
        '.$lang['update_warning_desc'].'
    </div>
    ';
}
else
{
    echo '
    <div class="alert alert-success">
        <h4><i class="fa fa-check-circle" aria-hidden="true"></i> '.$lang['update_success'].'!</h4>
        '.$lang['update_success_desc'].'
    </div>
    ';
}
?>

<script>
function Execute(params)
{
    $("#okienko").html("<img src='images/ajax-loader.gif' />");
    $.ajax({
        type: "POST",
        url: "pages/page-main.php",
        data: {
            changestatus: params.server,
            type: params.type
        },
        success: function(msg) {
            $("#okienko").fadeOut(400, function() {
                $("#okienko").text(msg).fadeIn(400);
            });
        },
        error: function() {
            alert( "Wystąpił błąd w połączeniu :(");
        }
    });
}
</script>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $lang['bot_panel']; ?></h3>
            </div>
            <div class="panel-body" align="center">
                <span id="okienko"><?php echo $lang['select_button']; ?></span><br />
                <div class="btn-group" role="group" aria-label="...">
                    <a href="javascript:Execute({server: '1', type: 'status'});" class="btn btn-primary"><?php echo $lang['bot_panel_status']; ?></a>
                    <a href="javascript:Execute({server: '1', type: 'start'});" class="btn btn-success"><?php echo $lang['bot_panel_start']; ?></a>
                    <a href="javascript:Execute({server: '1', type: 'restart'});" class="btn btn-warning"><?php echo $lang['bot_panel_restart']; ?></a>
                    <a href="javascript:Execute({server: '1', type: 'stop'});" class="btn btn-danger"><?php echo $lang['bot_panel_stop']; ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $lang['installed_plugins']; ?></h3>
            </div>
            <div class="panel-body">
                <?php
                    $plugins = getInstalledPlugins();
                    $first = true;
                    $string = '';
                    foreach ($plugins as $plugin)
                    {
                        $string .= ' <span class="label label-primary">'.$plugin.'</span>';
                        // if($first == true)
                        // {
                        //     $string .= $plugin;
                        //     $first = false;
                        // }
                        // else
                        // {
                        //     $string .= ", ".$plugin;
                        // }
                    }
                    echo $string;
                ?>
            </div>
        </div>
    </div>
</div>