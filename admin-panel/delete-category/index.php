<?php
    session_start();

    if(!$_SESSION["login"]){
        header("location: ../login.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require "../../globals.php";
        $pass = $_POST["password"];
        $pass_hashed = md5($pass);
        $username = $_SESSION["username"];
        $result = mysqli_query($con, "SELECT * FROM $users WHERE username='$username' AND password='$pass_hashed'");
        if(mysqli_num_rows($result)){
            $cid = $_POST["cid"];
            // password matched
            
            $query = "DELETE FROM `$artworks` WHERE `category_id` = $cid";
            $result = mysqli_query($con, $query);
            
            $query = "DELETE FROM `$category_master` WHERE `category_id` = $cid";
            $result = mysqli_query($con, $query);

            echo <<<ALERT_REDIRECT
            <script>
                alert("Category deleted");
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
        <h1>Deleting Category</h1>
        <p>Select Category to delete:</p>
        
        <form method="POST">
            <select name="cid">
                <?php
                    require "../../globals.php";
                    $query = "SELECT * FROM `$category_master`";
                    $result = mysqli_query($con, $query);

                    while(($row = mysqli_fetch_assoc($result)) != null){
                        $id = $row["category_id"];
                        $name = $row["category_name"];
                        echo <<<OPTION
                            <option value="$id">$name</option>
                        OPTION;
                    }
                ?>
            </select><br>
            <input type="password" name="password" placeholder="Enter your password">
            <input type="submit" value="Delete Category">
        </form>
    </div>
</body>