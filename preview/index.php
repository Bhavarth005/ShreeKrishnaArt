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
        .preview-container{
            position: relative;
            background-color: #fff;
            margin-top: 100px;
            margin-inline: auto;
            max-width: calc(100vw - 60px);
            max-height: calc(100vh - 60px - 70px);
            aspect-ratio: 4/3;
            border-radius: 10px;
            overflow: hidden;
            outline: 4px solid #555;
        }

        .preview-container img{
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .preview-container .frame{
            height: 35%;
            width: auto;
            position: absolute;
            left: 34%;
            top: 14%;
            box-shadow: 10px 5px 9px 0px #00000008;
        }

        .hall-container{
            display: flex;
            gap: 15px;
            position: fixed;
            z-index: 9;
            bottom: 45px;
            left: 50%;
            transform: translateX(-50%);
        }

        .hall{
            transition: 0.5s ease;
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
        <div onclick="change_bg(this)" class="hall-box selected"><img src="../img/hall1.png"></div>
        <div onclick="change_bg(this)" class="hall-box"><img src="../img/hall2.png"></div>
        <div onclick="change_bg(this)" class="hall-box"><img src="../img/hall3.png"></div>
        <div onclick="change_bg(this)" class="hall-box"><img src="../img/hall4.png"></div>
    </div>

    <script>
        // Adding active class to current page nav
        const page_id = 0;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");

        let hall_btns = Array.from(document.querySelectorAll(".hall-box"));
        let active = hall_btns[0];
        let hall = document.querySelector(".hall");
        let frame = document.querySelector(".frame");

        let coords = [
            { left: "34%", top: "14%", boxShadow: "10px 5px 9px 0px #00000008" },
            { height: "32%", left: "9%", top: "14%", boxShadow: "0px 5px 6px 2px #00000026" },
            { left: "45%", top: "9%", boxShadow: "-9px 7px 13px 0px #00000029" },
            { left: "17%", top: "9%", boxShadow: "-13px -4px 13px 0px #00000029" }
        ];
        
        function change_bg(obj){
            active.classList.remove("selected");
            obj.classList.add("selected");
            active = obj;
            hall.style.filter = "blur(20px)";
            hall.style.opacity = "0";
            setTimeout(() => {
                hall.src = obj.querySelector("img").src;
                setTimeout(() => {
                    hall.style.filter = "blur(0px)";
                    hall.style.opacity = "1";
                }, 00);
            }, 500);

            frame.animate(coords[hall_btns.indexOf(obj)], {duration: 1000, fill:"forwards", easing:"ease"});
        }
    </script>

</body>
</html>