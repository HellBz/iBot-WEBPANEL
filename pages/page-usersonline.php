<?php
if(!defined("IN_IBOT"))
{
    die("Nie możesz tego wykonać.");
}

global $lang, $error, $success, $mysql;
?>

<br />
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $lang['usersonline'];?></h3>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td><strong><?php echo $lang['usersonline_login'];?></strong></td>
                    <td class="display-none"><strong><?php echo $lang['usersonline_uid'];?></strong></td>
                    <td align="center"><strong><?php echo $lang['usersonline_status'];?></strong></td>
                    <td align="center"><strong><?php echo $lang['usersonline_channel'];?></strong></td>
                    <td align="center" class="display-none"><strong><?php echo $lang['usersonline_created'];?></strong></td>
                    <td align="center"><strong><?php echo $lang['usersonline_functions'];?></strong></td>
                </tr>
            </thead>
            <tbody>
            <?php
                $clients = $query->getElement('data', $query->clientList("-uid -away -voice -times -groups -info -country -icon -ip -badges"));
                foreach ($clients as $client)
                {
                    if($client['client_unique_identifier'] != 'serveradmin')
                    {
                        $channel = $query->getElement('data', $query->channelInfo($client['cid']));
                        if($client['client_input_muted'] != 0)
                        {
                            $status_micro = '<i class="fa fa-microphone-slash" style="color: red;" aria-hidden="true"></i>';
                        }
                        else
                        {
                            $status_micro = '<i class="fa fa-microphone" style="color: green;" aria-hidden="true"></i>';
                        }

                        if($client['client_output_muted'] != 0)
                        {
                            $status_speak = '<i class="fa fa-volume-off" style="color: red;" aria-hidden="true"></i>';
                        }
                        else
                        {
                            $status_speak = '<i class="fa fa-volume-up" style="color: green;" aria-hidden="true"></i>';
                        }

                        if($client['client_away'] != 0)
                        {
                            $status_away = '<i class="fa fa-clock-o" style="color: red;" aria-hidden="true"></i>';
                        }
                        else
                        {
                            $status_away = '<i class="fa fa-clock-o" style="color: green;" aria-hidden="true"></i>';
                        }
                        echo '
                        <tr>
                            <td>'.$client['client_nickname'].' <span class="smalltext">'.$client['connection_client_ip'].'</span></td>
                            <td class="display-none">'.$client['client_unique_identifier'].'</td>
                            <td align="center">'.$status_away.' '.$status_micro.' '.$status_speak.'</td>
                            <td align="center">'.$channel['channel_name'].'</td>
                            <td align="center" class="display-none">'.date("d-m-Y", $client['client_created']).'</td>
                            <td align="center">
                                <div class="btn-group btn-group-xs" role="group">
                                    <a href="#" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-warning"><i class="fa fa-reply" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
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