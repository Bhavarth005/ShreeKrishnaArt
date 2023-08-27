<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include ("../globals.php");

        $artwork_name = $_POST["artwork_name"];
        $desc = addslashes($_POST["desc"]);
        $size = $_POST["size"];
        $weight = $_POST["weight"];
        $category = $_POST["category"]
        $img_1 = $_POST["img_1"];
        
        if(isset($_POST["img_2"]))
            $img_2 = $_POST["img_2"];
        if(isset($_POST["img_3"]))
            $img_2 = $_POST["img_2"];
        if(isset($_POST["img_4"]))
            $img_2 = $_POST["img_2"];
        if(isset($_POST["img_5"]))
            $img_2 = $_POST["img_2"];

        
        // Inserting blog data
        $sql = "INSERT INTO $artworks(`artwork_name`, `desc`, `size`, `weight`, `category_id`) VALUES('$artwork_name', '$desc', '$size', '$weight', '$category')";
        mysqli_query($con, $sql);

        // Getting id of last blog
        $select_query = "SELECT * FROM $artworks ORDER BY artwork_id DESC LIMIT 1";
        $result = mysqli_query($con, $select_query);
        $id = mysqli_fetch_assoc($result)["artwork_id"];

        // Uploading thumbnail

        if(mysqli_affected_rows($con) > 0){
            // Blog uploaded
            echo "<!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Document</title>
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
                <h1 class=\"section-heading\" style=\"margin-top: 50px; width: 100vw; text-align: center;\">Blog uploaded!</h1>
            
                <p style=\"margin-top: 50px\">Blog Id: $id</p>
                <p>Title: $blog_title</p>
            
                <a href=\"../\">Admin Panel</a>
            </body>
            </html>";
        }

    }
?>