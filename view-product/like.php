<?php
    require "../globals.php";
    header("Content-type: application/json");
    if(isset($_REQUEST["pid"]) && isset($_REQUEST["mode"])){
        $pid = $_REQUEST["pid"];
        $mode = $_REQUEST["mode"];

        $query = "SELECT `likes` FROM `$artworks` WHERE `artwork_id` = $pid";
        $result = mysqli_query($con, $query);
        $likes = (int)mysqli_fetch_assoc($result)["likes"];

        if($mode == "add"){
            $likes += 1;
        }else{
            // Remove
            if($likes > 0)
                $likes -= 1;
        }

        $update_query = "UPDATE `$artworks` SET `likes` = '$likes' WHERE `artwork_id` = $pid";
        mysqli_query($con, $update_query);
    }
?>