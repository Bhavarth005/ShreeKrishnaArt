<?php
    require "../../globals.php";

    if(isset($_REQUEST["category-name"])){
        $category_name = $_REQUEST["category-name"];
        $query = "INSERT INTO `$category_master`(`category_name`) VALUES('$category_name')";

        if(mysqli_query($con, $query)){
            header("location: index.php");
        }else{
            echo "Could not insert category to database<br><a href=\"index.php\">Go Back</a?";
        }
    }else{
        echo "Category name not given";
    }
?>