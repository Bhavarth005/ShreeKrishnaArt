<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Krishna Art</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/categories.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="./js/nav.js" defer></script>
</head>
<body>
    <?php
        require "globals.php";

        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("nav.code", "r");
        $nav_data = str_replace("../", "./", fread($nav_file, filesize("nav.code")));
        
        echo $nav_data;
    ?>
    <script>
        // Adding active class to current page nav
        const page_id = 0;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");
    </script>

    <section class="hero">
        <div class="left">
            <h1><span class="hero-line-1">Shree Krishna Art</span><br><span class="hero-line-2">Divine MasterPieces In Pure Gold</span></h1>
            <div class="btn-container">
                <a class="primary-btn" href="categories">Explore Art</a>
            </div>
        </div>
        <div class="right">
        </div>
        <img class="hero-bg-img" id="hero-bg-img" src="img/homepage-hero.jpg" alt="">
    </section>

    <section class="cat-showcase">
        <h1>Categories</h1>
        <div class="cat-container">
            <?php
                $query = "SELECT c.category_name, p.artwork_name, c.category_id, p.image_1 FROM category_master c INNER JOIN artworks p ON c.category_id = p.category_id WHERE p.artwork_id = ( SELECT MIN(artwork_id) FROM artworks WHERE category_id = c.category_id )";

                $result = mysqli_query($con, $query);

                while(($row = mysqli_fetch_assoc($result)) != null){
                    $cid = $row["category_id"];
                    $name = $row["category_name"];
                    $imageData = base64_encode($row["image_1"]);
                    $html_code = <<<HTMLCODE
                        <a href="./view-category?cid=$cid">
                            <div class="img-box">
                                <h3>$name</h3>
                                <div class="bottom-overlay"></div>
                                <img src="data:image/jpeg;base64,$imageData">
                            </div>
                        </a>
                    HTMLCODE;

                    echo $html_code;
                }
            ?>
        </div>
        <a href="categories" class="see-more-btn">See more</a>
    </section>
    <hr id="artwork-hr">
    <section class="img-showcase">  
        <h1>Popular Works of Art</h1>
        <div class="img-container">
        <?php    
            require "globals.php";    
            $query = "SELECT * FROM `$artworks` ORDER BY `likes` DESC LIMIT 4";
            $result = mysqli_query($con, $query);

            while(($row = mysqli_fetch_assoc($result))){
                $artwork_title = $row["artwork_name"];
                $id = $row["artwork_id"];
                $image = base64_encode($row["image_1"]);

                $artwork_html = <<<ARTWORK_HTML
                <a href="./view-product/?pid=$id">
                    <div class="img-box">
                        <h3>$artwork_title</h3>
                        <div class="bottom-overlay"></div>
                        <img src="data:image/jpeg;base64,$image">
                    </div>
                </a>
                ARTWORK_HTML;
                echo $artwork_html;
            }

        ?>
        </div>
    </section>
    <?php
        // Reading footer html from a common file
        // The active class will be added later with JS
        $footer_file = fopen("footer.code", "r");
        $footer_data = str_replace("../", "./", fread($footer_file, filesize("footer.code")));
        
        echo $footer_data;
    ?>
</body>
</html>