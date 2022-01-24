<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');


 session_start();
session_destroy();
header('location: connection.php');
exit;


include('../templates/footer.php');
?>
