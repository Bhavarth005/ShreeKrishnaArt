<?php
    $server_name = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "shreekrishnaart";
    $category_master = "category_master";
    $artworks = "artworks";
    $users = "users";

    try {
        global $con;
        $con = mysqli_connect($server_name, $db_username, $db_password, $db_name);
    } catch (Exception $e) {
        echo "<br>Error while connecting to database!";
        die();
    }
?>