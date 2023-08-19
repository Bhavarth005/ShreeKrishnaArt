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
                <a class="primary-btn" href="#products">Explore Art</a>
            </div>
        </div>
        <div class="right">
        </div>
        <img class="hero-bg-img" id="hero-bg-img" src="img/homepage-hero.jpg" alt="">
    </section>

    <section class="cat-showcase">
        <h1>Categories</h1>
        <div class="cat-container">
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
        <a href="#">
            <div class="cat-box">
                <h3>Image text here</h3>
            </div>
        </a>    
            
        </div>
        <a href="#" class="see-more-btn">See more</a>
    </section>
    <hr id="artwork-hr">
    <section class="img-showcase">
        <h1>Popular Works of Art</h1>
        <div class="img-container">
            <a href="#">
                <div class="img-box">
                    <h3>Image text here</h3>
                </div>
            </a>
            <a href="#">
                <div class="img-box">
                    <h3>Image text here</h3>
                </div>
            </a>
            <a href="#">
                <div class="img-box">
                    <h3>Image text here</h3>
                </div>
            </a>
            <a href="#">
                <div class="img-box">
                    <h3>Image text here</h3>
                </div>
            </a>
           
        </div>
        <a href="#" class="see-more-btn">See more</a>
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