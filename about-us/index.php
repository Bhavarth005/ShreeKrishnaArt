<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Krishna Art</title><link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/homepage-hero.css">
    <link rel="stylesheet" href="../css/about-us.css">
    <link rel="shortcut icon" href="../img/feather.png" type="image/png"> 
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
        const page_id = 1;
        const anchors = document.querySelectorAll("nav li a");
        anchors[page_id].classList.add("active");
        anchors[page_id].setAttribute("href", "#");
    </script>

    
    <section class="hero about-us-hero">
        <img class="hero-bg-img" id="hero-bg-img" src="../img/about-us_bg.jpeg" alt="">
        
        <div class="left">
            <img src="../img/profile.png" alt="">
        </div>
        <div class="right">
            <h1>Full Name</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim consequuntur ad illum perspiciatis tempora laudantium aperiam blanditiis ratione numquam doloremque qui reprehenderit dolor corrupti ipsa, temporibus voluptatem tempore beatae deleniti itaque, culpa voluptas veniam. Ab laudantium at, inventore aperiam aliquam deleniti, dignissimos provident accusantium ipsa soluta ratione aliquid mollitia dolore!</p>
        </div>
    </section>
    <section class="achievements">
        <h1>Achievements</h1>
        <div class="achievements-img">
            <div class="col-1"></div>
            <div class="col-2"></div>
            <div class="col-3">
                <div class="top"></div>
                <div class="bottom"></div>
            </div>
        </div>
    </section>
    <hr id="contact-us-hr">
    <section class="contact-us">
        <h1>Contact Us</h1>
        <p>For more details about the Artwork or the Prices</p>
        <p>Contact us here:</p>
        <div class="contact-container">
                    <a class="contact" href="tel:+919624201001">
                        <img src="../img/phone.svg" alt="Phone">
                        +91 9624201001
                    </a>
                    <a class="contact" href="mailto:mail@google.com.com">
                        <img src="../img/email.svg" alt="Phone">
                        mail@google.com
                    </a>
        </div>
    </section>

    <?php
        // Reading footer html from a common file
        // The active class will be added later with JS
        $footer_file = fopen("../footer.code", "r");
        $footer_data = fread($footer_file, filesize("../footer.code"));
        
        echo $footer_data;
    ?>
</body>
</html>