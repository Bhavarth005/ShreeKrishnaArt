<?php
    require "../globals.php";
    if(isset($_REQUEST["pid"])){
        $pid = $_REQUEST["pid"];

        $query = "SELECT `shares` FROM `$artworks` WHERE `artwork_id` = $pid";
        $result = mysqli_query($con, $query);
        $shares = (int)mysqli_fetch_assoc($result)["shares"];

        $shares += 1;

        $update_query = "UPDATE `$artworks` SET `shares` = '$shares' WHERE `artwork_id` = $pid";
        mysqli_query($con, $update_query);
    }
?>