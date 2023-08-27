<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Match password
        if(true){
            $pid = $_POST["pid"];
            // password matched
            require "../../globals.php";
            $query = "DELETE FROM `$artworks` WHERE `artwork_id` = $pid";
            $result = mysqli_query($con, $query);
            echo <<<ALERT_REDIRECT
            <script>
                alert("Artwork deleted");
                window.location.href = "../";
            </script>
            ALERT_REDIRECT;
        }
    }
?>

<head>
    <title>Shree Krishna Art</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/homepage-hero.css">
    <link rel="stylesheet" href="../../css/categories.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/individual-category.css">
    <script src="../../js/nav.js" defer></script>
    <style>
        .container{
            margin-top: 100px;
        }

        .container h1{
            font-size: 45px;
            margin: 0;
        }

        .container input[type="password"]{
            padding: 10px;
            font: inherit;
            outline: none;
            border: 1px solid gold;
            border-radius: 5px;
            width: 250px;
        }

        .container input[type="submit"]{
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #f44;
            color: #fff;
        }

        .container input[type="submit"]:hover{
            cursor: pointer;
            filter: brightness(90%);
        }
    </style>
</head>

<body>
    <?php
        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("../../nav.code", "r");
        $nav_data = str_replace("../", "../../", fread($nav_file, filesize("../../nav.code")));
        
        echo $nav_data;
    ?>
    
    <div class="container">
        <h1>Deleting Artwork</h1>
        <p>Confirm deletion of product by entering your password below:</p>
        
        <form method="POST">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="submit" value="Delete Artwork">
        </form>
    </div>
</body>