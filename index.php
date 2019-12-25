<?php

/*
 * index page
 */

include 'functions.php';
include 'header.php';

?>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script>
$(document).ready(function(){
    if ("<?php echo $_GET['id'] ?>" != ""){
        $.get("./api/get.php?id=<?php echo $_GET['id'] ?>",function(data,status){
            var ret = JSON.parse(data);
            if (ret.success == false){
                $("#showText").text(ret.info);
            } else {
                // jQuery  https://www.cnblogs.com/woostundy/p/4138173.html
                $("#showText").text($('<div>').html(ret.text).text());
                $("#showUser").addClass("text-info");
                if (<?php echo LOGIN_ENABLE ?> == true && ret.user != ""){
                    if (ret.time != null) $("#showUser").text("Shared by " + ret.user + " at " + ret.time);
                    else $("#showUser").text("Shared by " + ret.user);
                } else {
                    if (ret.time != null) $("#showUser").text("Shared at " + ret.time);
                }
            }
        });
    }
    
    $("#submit").click(function(){
        $.post("./api/push.php",
        {
            <?php if (LOGIN_ENABLE == false || isset($_COOKIE['pb_token']) == false) { ?>
                text: $("#burntext").val(),
                savetime: $("#rcdTime").prop('checked')
            <?php } else {?>
                text: $("#burntext").val(),
                savetime: $("#rcdTime").prop('checked'),
                token: '<?php echo $_COOKIE["pb_token"]?>'
            <?php } ?>
        },
        function(data,status){
            var ret = JSON.parse(data);
            if (ret.success == false){
                $("#hint").removeClass($("#hint").attr("class"));
                $("#hint").addClass("alert alert-danger");
                $("#hint").text("ERROR: " + ret.info);
            } else {
                $("#hint").removeClass($("#hint").attr("class"));
                $("#hint").addClass("alert alert-info");
                $("#hint").text("Please share this URL: <?php echo SITEURL ?>?id=" + ret.info);
            }
        });
    });
});
</script>

<div class="container maincontent">
    <?php if ($_GET["id"] != ""){ ?>
        <div id="showText"></div> <br><br>
        <div id="showUser"></div><?php
    } else { ?>
        <h3>Burn After Reading</h3>
        <p>Leave your secret message in the textbox below and share the generated URL to your friend. The URL will become invalid after first access！</p>

        <form id="main">
            <textarea id="burntext" rows="10" maxlength="65535" class="form-control" placeholder="Worth a thousand words."></textarea><br>
            <div class="custom-control custom-checkbox" >
                <input type="checkbox" class="custom-control-input" id="rcdTime" name="rcdTime">
                <label class="custom-control-label" for="rcdTime" data-toggle="tooltip" data-placement="right" title="If unchecked, the timestamp of this message will not be stored in the database">Record and show sharing time</label>
            </div> <br>
            <button id="submit" type="button" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <div id="hint"></div>
    <?php } ?>
</div>

<?php include 'footer.php' ?>
