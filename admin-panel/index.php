<?php
    require "../globals.php";

    // Reading nav html from a common file
    // The active class will be added later with JS
    $nav_file = fopen("../nav.code", "r");
    $nav_data = str_replace("./", "./", fread($nav_file, filesize("../nav.code")));
    
    echo $nav_data;

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
    <script src="../js/nav.js" defer></script>
</head>


<section class="hero category-hero">
    <h1>Admin Panel</h1>
    <img class="hero-bg-img" id="hero-bg-img" src="../img/category_bg.jpg">
</section>

<div class="container">
    <h1>All artworks</h1>
    <form id="filter-form">
        <select name="filter">
            <?php
                $query = "SELECT * FROM `$category_master`";
                $result = mysqli_query($con, $query);

                if(isset($_GET["filter"])){
                    $filter_id = $_GET["filter"];
                }else{
                    $filter_id = 0;
                }

                echo "<option value='0'";
                if($filter_id == 0)
                    echo " selected";
                echo ">All categories</option>";

                while(($row = mysqli_fetch_assoc($result)) != null){
                    $id = (int)$row["category_id"];
                    $name = $row["category_name"];

                    echo "<option value=\"$id\" ";
                    if($id == $filter_id)
                        echo "selected";
                    echo ">$name</option>";
                }
            ?>
        </select>
    </form>

    <div class="artwork-container">
        <?php        
            $query = "SELECT * FROM `$artworks`";

            if($filter_id > 0)
                $query .= " WHERE `category_id` = $filter_id";

            $result = mysqli_query($con, $query);

            while(($row = mysqli_fetch_assoc($result))){
                $id = $row["artwork_id"];
                $artwork_title = $row["artwork_name"];
                $image = base64_encode($row["image_1"]);
                $likes = $row["likes"];
                $shares = $row["shares"];
                
                $artwork_html = <<<ARTWORK_HTML
                <div class="artwork">
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
                        <div class="right">
                            <a target="_blank" href="../view-product?pid=$id"><img src="../img/open.png"></a>
                            <a href="edit-data?pid=$id"><img src="../img/edit.png"></a>
                            <a href="delete-data?pid=$id"><img src="../img/delete.png"></a>
                        </div>
                    </div>
                </div>
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
    anchors[page_id].setAttribute("href", "#");

    document.querySelector("select").onchange = () => {
        document.querySelector("#filter-form").submit();
    }
</script>

<?php
    // Reading footer html from a common file
    // The active class will be added later with JS
    $footer_file = fopen("../footer.code", "r");
    $footer_data = fread($footer_file, filesize("../footer.code"));
    
    echo $footer_data;
?>