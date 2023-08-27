<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include ("../globals.php");

        $artwork_name = $_POST["artwork_name"];
    $desc = addslashes($_POST["desc"]);
    $size = $_POST["size"];
    $weight = $_POST["weight"];
    $category = $_POST["category"];

    // Initialize image variables as null
    $img_1 = null;
    $img_2 = null;
    $img_3 = null;
    $img_4 = null;
    $img_5 = null;

    if (isset($_FILES["img_1"]) && $_FILES["img_1"]["error"] === UPLOAD_ERR_OK) {
        $img_1 = file_get_contents($_FILES["img_1"]["tmp_name"]);
        $img_1 = $con->real_escape_string($img_1);
    }

    if (isset($_FILES["img_2"]) && $_FILES["img_2"]["error"] === UPLOAD_ERR_OK) {
        $img_2 = file_get_contents($_FILES["img_2"]["tmp_name"]);
        $img_2 = $con->real_escape_string($img_2);

    }
    if (isset($_FILES["img_3"]) && $_FILES["img_3"]["error"] === UPLOAD_ERR_OK) {
        $img_3 = file_get_contents($_FILES["img_3"]["tmp_name"]);
        $img_3 = $con->real_escape_string($img_3);

    }
    if (isset($_FILES["img_4"]) && $_FILES["img_4"]["error"] === UPLOAD_ERR_OK) {
        $img_4 = file_get_contents($_FILES["img_4"]["tmp_name"]);
        $img_4 = $con->real_escape_string($img_4);

    }
    if (isset($_FILES["img_5"]) && $_FILES["img_5"]["error"] === UPLOAD_ERR_OK) {
        $img_5 = file_get_contents($_FILES["img_5"]["tmp_name"]);
        $img_5 = $con->real_escape_string($img_5);

    }

    // ... Repeat for img_3, img_4, img_5

    // Inserting artwork data with prepared statement
    $sql = "INSERT INTO $artworks(`artwork_name`, `desc`, `size`, `weight`, `category_id`, `image_1`, `image_2`,`image_3`, `image_4`, `image_5`) VALUES ('$artwork_name', '$desc', '$size', '$weight', $category, '$img_1', '$img_2', '$img_3', '$img_4', '$img_5')";
        mysqli_query($con, $sql);

        // Getting id of last blog
        $select_query = "SELECT * FROM $artworks ORDER BY artwork_id DESC LIMIT 1";
        $result = mysqli_query($con, $select_query);
        $id = mysqli_fetch_assoc($result)["artwork_id"];

        // Uploading thumbnail

        if(mysqli_affected_rows($con) > 0){
            echo "<!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Shree Krishna Art</title>
                <style>
                    *{
                        font-family: \"Quicksand\";
                        margin: 0;
                        padding: 0;
                    }
                    .section-heading{
                        --light-blue: rgb(87, 166, 199);
                        --dark-blue: rgb(59, 94, 170);
                        font-size: 30px;
                        background: linear-gradient(45deg, var(--light-blue), var(--dark-blue));
                        display: inline-block;
                        margin: 0;
                        color: transparent;
                        background-clip: text;
                        -webkit-background-clip: text;
                    }
            
                    p{
                        text-align: center;
                        font-weight: 700;
                        font-size: 20px;
                    }
            
                    a{
                        padding: 15px 30px;
                        background: #ddd;
                        display: inline-block;
                        margin-left: 50%;
                        margin-top: 30px;
                        color: #333;
                        border: 1px solid #bbb;
                        text-decoration: none;
                        font-weight: 700;
                        border-radius: 10px;
                        transform: translateX(-50%);
                    }
            
                    a:hover{
                        background: #e8e8e8;
                    }
                </style>
            </head>
            <body>
                <h1 class=\"section-heading\" style=\"margin-top: 50px; width: 100vw; text-align: center;\">Artwork uploaded!</h1>
            
                <p style=\"margin-top: 50px\">Artwork Id: $id</p>
                <p>Title: $artwork_name</p>
            
                <a href=\"./\">Admin Panel</a>
            </body>
            </html>";
        }
    }
?>