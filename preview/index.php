<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Krishna Art</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/homepage-hero.css">
    <link rel="stylesheet" href="../css/categories.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/nav.js" defer></script>
    
</head>
<body>
    <?php

        require "../globals.php";

        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("../nav.code", "r");
        $nav_data = str_replace("./", "./", fread($nav_file, filesize("../nav.code")));
        
        echo $nav_data;

        if(isset($_GET["pid"])){
            $pid = $_GET["pid"];

            $query = "SELECT `image_1` FROM `$artworks` WHERE `artwork_id` = '$pid'";
            $result = mysqli_query($con, $query);

            if(!mysqli_num_rows($result)){
                echo "<br><br><br><br>Product not found!";
                die();
            }
            $row = mysqli_fetch_assoc($result);
            $image_data = base64_encode($row['image_1']);

            
        }else{
            header("location: ../");
        }
    ?>
    <style>
        .frame{
            height: 300px;
            position: absolute;
            position: fixed;
            z-index: 9;
            left: 32%;
            top: 13%;
        }
        body{
            height: 100vh;
            overflow: hidden;
        }
        .hall{
            height: 110vh;
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            min-width: 100%;
        }

        @media(max-width: 720px){
            .frame{
                left: 50%;
                transform: translateX(-50%);
                max-width: 80%;
                height: auto;
                max-height: 300px;
            }
        }

        .hall-container{
            display: flex;
            gap: 15px;
            position: fixed;
            z-index: 9;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
        }

        .hall-box{
            height: 60px;
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 5px;
            outline: 3px solid #ccc;
            box-shadow: 0 3px 8px #000a;
        }

        .hall-box.selected{
            outline: 3px solid #007aff;
        }

        .hall-box:hover{
            cursor: pointer;
        }

        .hall-box img{
            height: 100%;
        }
    </style>
    
    <div class="preview-container">
        <img src="../img/hall1.png" class="hall">
        <?php echo "<img class='frame' src=\"data:image/jpeg;base64,$image_data\">"; ?>
    </div>

    <div class="hall-container">
        <div class="hall-box selected"><img src="../img/hall1.png"></div>
        <div class="hall-box"><img src="../img/hall2.png"></div>
        <div class="hall-box"><img src="../img/hall3.png"></div>
        <div class="hall-box"><img src="../img/hall4.png"></div>
    </div>

    <script>
        // Adding active class to current page nav
        const page_id = 0;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");
    </script>

</body>
</html>