<?php
define("IN_IBOT", true);
include 'include/config.php';

include 'include/headerinclude.php';
include 'include/header.php';
?>

<br />
<div class="col-lg-12">
    <div class="jumbotron">
        <h1><span class="error-404">Błąd</span>
        </h1>
        <p>
        <?php
        if(isset($_GET['error']))
        {
        	echo $_GET['error'];
        }
        else
        {
        	echo 'Nieznany błąd!';
        }
        ?>
        </p>
    </div>
</div>

<?php
include 'include/footer.php';
?>