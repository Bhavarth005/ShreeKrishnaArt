<?php
    require "../globals.php";

    if(isset($_GET["search"])){
        $key = $_GET["search"];

        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("../nav.code", "r");
        $nav_data = str_replace("./", "./", fread($nav_file, filesize("../nav.code")));
        
        echo $nav_data;
    }else{
        header("location: index.php");
    }

?>

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
    <link rel="stylesheet" href="../css/individual-category.css">
    <link rel="shortcut icon" href="../img/feather.png" type="image/png">    
    <script src="../js/nav.js" defer></script>
</head>


<section class="hero category-hero">
    <h1>Search results for '<?php echo $key; ?>'</h1>
    <img class="hero-bg-img" id="hero-bg-img" src="../img/category_bg.jpg" alt="">
</section>

<div class="container">

    <div class="artwork-container">
        <?php        
            $query = "SELECT * FROM `$artworks` WHERE `artwork_name` LIKE '%$key%'";
            $result = mysqli_query($con, $query);

            while(($row = mysqli_fetch_assoc($result))){
                $artwork_title = $row["artwork_name"];
                $image = base64_encode($row["image_1"]);
                $likes = $row["likes"];
                $shares = $row["shares"];
                
                $artwork_html = <<<ARTWORK_HTML
                <a href="#" class="artwork">
                    <div class="image">
                        <img src="data:image/jpeg;base64,$image">
                    </div>
                    <div class="title">
                        <div class="left"><p>$artwork_title</p>
                            <div class="score">
                                <img src="../img/like.svg">$likes
                                <img src="../img/share.svg">$shares
                            </div>
                        </div>
                    </div>
                </a>
                ARTWORK_HTML;

                echo $artwork_html;
            }
        ?>
    </div>
</div>

<script>
    // Adding active class to current page nav
    const page_id = 2;
    const anchors = document.querySelectorAll("nav li a");
    anchors[page_id].classList.add("active");

    let images = document.querySelectorAll(".right img");

    window.onblur = () => {
        images.forEach(image => {
            image.style.filter = "blur(30px)";
        });
    }

    window.onfocus = () => {
        images.forEach(image => {
            image.style.filter = "blur(0px)";
        });
    }
</script>

<?php
    // Reading footer html from a common file
    // The active class will be added later with JS
    $footer_file = fopen("../footer.code", "r");
    $footer_data = fread($footer_file, filesize("../footer.code"));
    
    echo $footer_data;
?>