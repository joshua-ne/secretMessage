<?php

/*
 * Logout page
 */

include 'functions.php';
if (LOGIN_ENABLE == false) header("location: index.php");

setcookie("pb_user", "", time()-3600);
setcookie("pb_token", "", time()-3600);
header ( "location:index.php" );
?>