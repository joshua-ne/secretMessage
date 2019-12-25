<?php

/*
 * User page
 */

include 'functions.php';
if (LOGIN_ENABLE == false) header("location: index.php");
include 'header.php';
?>

<div class="container maincontent">
    <?php if (isset($_COOKIE['pb_token']) == false){
        header ( "location: login.php?from=logout" );
    } else if (Jwt::verifyToken($_COOKIE['pb_token']) == false){
        setcookie("pb_user", "", time()-3600);
        setcookie("pb_token", "", time()-3600);
        header ( "location: login.php?from=logout" );
    } else { ?>
        <p>Welcome back, <?php echo $_COOKIE['pb_user']; ?>.</p>
        
    <?php } ?>
</div>

<?php include 'footer.php' ?>
