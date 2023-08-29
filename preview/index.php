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
    <style>
        .frame{
            height: 300px;
            position: absolute;
        }
    </style>
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
            $row = mysqli_fetch_assoc($result);
            $image_data = base64_encode($row['image_1']);

            echo "<img class='frame' src=\"data:image/jpeg;base64,$image_data\">";
        }else{
            header("location: ../");
        }
    ?>

    

    <script>
        // Adding active class to current page nav
        const page_id = 0;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");
    </script>

</body>
</html>