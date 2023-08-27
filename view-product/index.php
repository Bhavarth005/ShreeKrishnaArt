<?php
    require "../globals.php";

    if(isset($_REQUEST["pid"])){
        global $pid;
        $pid = $_REQUEST["pid"];

        $query = "SELECT * FROM `$artworks` WHERE `artwork_id` = $pid LIMIT 1";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        $artwork_title = $row["artwork_name"];
        $artwork_size = $row["size"];
        $artwork_weight = $row["weight"];
        $artwork_desc = $row["desc"];

        $img1 = $row["image_1"];
        $img2 = $row["image_2"];
        $img3 = $row["image_3"];
        $img4 = $row["image_4"];
        $img5 = $row["image_5"];

        $imgs = Array(
            $row["image_1"],
            $row["image_2"],
            $row["image_3"],
            $row["image_4"],
            $row["image_5"]
        );

        $like_count = $row["likes"];
        $share_count = $row["shares"];
    }else{
        echo "Product ID not provided!";
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Krishna Art</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/homepage-hero.css">
    <link rel="stylesheet" href="../css/categories.css">
    <link rel="stylesheet" href="../css/view-product.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/nav.js" defer></script>
</head>
<body>
    <?php
        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("../nav.code", "r");
        $nav_data = str_replace("./", "./", fread($nav_file, filesize("../nav.code")));
        
        echo $nav_data;
    ?>
    <script>
        // Adding active class to current page nav
        const page_id = 2;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");
    </script>

    <div class="content">
        <div class="left">
            <h1 class="artwork-title"><?php echo $artwork_title; ?></h1>
            <div class="specs">
                <h2 class="size">Size: <span class="text"><?php echo $artwork_size; ?></span></h2>
                <h2 class="size">Weight: <span class="text"><?php echo $artwork_weight; ?> kg</span></h2>
                <h2 class="desc">Description:<br> <p class="text"><?php echo $artwork_desc; ?></p></h2>
            </div>
            <div class="btns">
                <div class="like">
                    <img src="../img/like.svg">
                    <h2><?php echo $like_count; ?></h2>
                </div>
                <div class="like">
                    <img src="../img/share.svg">
                    <h2><?php echo $share_count; ?></h2>
                </div>
            </div>
            <div class="note">
                <p>*For any other details about artwork or prices<a href="../about-us/#contact-us-hr"> Contact Us </a></p>
            </div>
        </div>
        <div class="right">
            <div class="main-preview-container">
                <?php
                    $main_image = base64_encode($imgs[0]);
                    echo "<img src=\"data:image/jpeg;base64,$main_image\" id=\"main-preview\">"
                ?>
            </div>

            <div class="more-imgs">
                <?php
                    foreach ($imgs as $img) {
                        if($img != null){
                            $image_data = base64_encode($img);
                            $image_html = <<<IMG_HTML
                                <div class="img-container"><img onclick="update_image(this)" src="data:image/jpeg;base64,$image_data"></div>
                            IMG_HTML;
                            echo $image_html;
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        let main_preview = document.querySelector("#main-preview");
        let main_preview_container = document.querySelector(".main-preview-container");

        function update_image(element){
            main_preview_container.style.opacity = 0;
            setTimeout(() => {
                main_preview.src = element.src;
                setTimeout(() => {
                    main_preview_container.style.opacity = 1;
                }, 10);
            }, 350);
        }
    </script>

    <?php
        // Reading footer html from a common file
        // The active class will be added later with JS
        $footer_file = fopen("../footer.code", "r");
        $footer_data = fread($footer_file, filesize("../footer.code"));
        
        echo $footer_data;
    ?>
</body>
</html>