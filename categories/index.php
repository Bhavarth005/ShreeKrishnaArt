<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Krishna Art</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/categories.css">
    <script src="./js/nav.js" defer></script>
</head>
<body>
    <?php
        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("../nav.code", "r");
        $nav_data = str_replace("./", "./", fread($nav_file, filesize("../nav.code")));
        
        echo $nav_data;
    ?>

    <section class="img-showcase">
        <h1>Categories</h1>
        <div class="img-container">
            <div class="img-box">
                <h3>Image text here</h3>
            </div>
            <div class="img-box">
                <h3>Image text here</h3>
            </div>
            <div class="img-box">
                <h3>Image text here</h3>
            </div>
            <div class="img-box">
                <h3>Image text here</h3>
            </div>
        </div>
    </section>

    <script>
        // Adding active class to current page nav
        const page_id = 2;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");
    </script>

    
</body>
</html>