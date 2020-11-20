<?php

session_start();

require_once('includes/DBConnection.php');
require_once('partials/header.php');

?>

<div class="container pt-5 pb-5">

    <?php if (!isset($_GET['view'])):?>
        <a href="?view=manage">Manage</a>
        <a href="?view=start">Start</a>
    <?php else:?>
        <?php if ($_GET['view'] === 'start'):
            require_once('views/Cashier.php');
        elseif ($_GET['view'] === 'manage'):
            require_once('views/Admin.php');
        endif?>
    <?php endif?>

</div>

<?php require_once('partials/footer.php')?>