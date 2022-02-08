<?php
ob_start();
session_start();
$title = 'dashboard';
include "init.php";

        echo "<div class='alert alert-success'> the result has been inserted </div> ";
        redirectfunction(5);
 

?>




<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>