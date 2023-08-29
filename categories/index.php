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
    ?>

    <section class="hero category-hero">
        <h1>Explore various categories</h1>
        <img class="hero-bg-img" id="hero-bg-img" src="../img/category_bg.jpg" alt="">
    </section>

    <?php
        // Fetching all categories

        $query = "SELECT * FROM `$category_master`";
        $result = mysqli_query($con, $query);

        while(($row = mysqli_fetch_assoc($result)) != null){

            $category_id = $row["category_id"];
            $category_name = $row["category_name"];

            $category_section_header = <<< CSH
            <section class="img-showcase">
            <h1>$category_name</h1>
            <div class="img-container">
            CSH;
            echo $category_section_header;


            // First image will be the image of first artwork in this category
            $first_image_query = "SELECT `artwork_id`, `image_1`, `artwork_name` FROM `$artworks` WHERE `category_id` = $category_id LIMIT 4";
            $image_query_result = mysqli_query($con, $first_image_query);

            if(mysqli_num_rows($image_query_result) > 0){
                
                for($i = 0; $i < mysqli_num_rows($image_query_result); $i++){
                    $image_row = mysqli_fetch_array($image_query_result);
                    $artwork_id = $image_row["artwork_id"];
                    $image_blob = $image_row["image_1"];
                    $image_data = base64_encode($image_blob);
                    $artwork_name = $image_row["artwork_name"];
                    
                    $image = <<< IMG
                    <a href="../view-product/?pid=$artwork_id">
                    <div class="img-box">
                    <h3>$artwork_name</h3>
                    <div class="bottom-overlay"></div>
                    <img src="data:image/jpeg;base64,$image_data">
                    </div>
                    </a>
                    IMG;
                    
                    echo $image;
                }


            }else{
                echo "<p class='no-artwork'>No artwork to show in this category</p>";
            }

            $ending = <<<END
            </div>
            <a href="../view-category?cid=$category_id" class="see-more-btn">See more</a>
            </section>
            END;
            echo $ending;
        }
    ?>

    <script>
        // Adding active class to current page nav
        const page_id = 2;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");
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