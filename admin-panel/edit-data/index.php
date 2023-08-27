<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Krishna Art</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/insert.css">
    <script src="../../js/nav.js"></script>
</head>
<body>
    <?php
        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("../../nav.code", "r");
        $nav_data = str_replace("../", "../../", fread($nav_file, filesize("../../nav.code")));
        // $nav_data = str_replace("./", "../", $nav_data);
        
        echo $nav_data;

        require "../../globals.php";

        if(isset($_REQUEST["pid"])){
            global $pid;
            $pid = $_REQUEST["pid"];

            $query = "SELECT * FROM `$artworks` WHERE `artwork_id` = $pid LIMIT 1";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);

            $artwork_name = $row["artwork_name"];
            $size = $row["size"];
            $weight = $row["weight"];
            $desc = $row["desc"];
            $category = $row["category_id"];

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
        }else{
            echo "Product ID not provided!";
            die();
        }
    ?>

    <div class="container">
        <h1>Add Artwork</h1>
        <form action="update_artwork.php" method="POST" enctype="multipart/form-data">
            <div class="field">
                <p>Name of artwork</p>
                <input type="text" name="artwork_name" value="<?php echo $artwork_name;?>" required>
            </div>
            <div class="field">
                <p>Description of artwork</p>
                <textarea name="desc" cols="50" rows="10" required><?php echo $desc;?></textarea>
            </div>
            <div class="field">
                <p>Size of artwork</p>
                <input type="text" name="size" value="<?php echo $size;?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $pid;?>">
            <div class="field">
                <p>Weight of artwork</p>
                <input type="text" name="weight" value="<?php echo $weight;?>" required>
            </div>
            <div class="field">
                <p>Select Category</p>
                <select name="category" value="<?php echo $category;?>">
                        <?php
                        include ("../../globals.php");
                        $result = mysqli_query($con, "SELECT * FROM $category_master");
                        for($i = 0; $i < mysqli_num_rows($result); $i++)
                        {
                            $row = mysqli_fetch_assoc($result); 
                            echo "<option value=" . $row["category_id"];
                            if ($row['category_id'] == $category) {
                                echo " selected";
                            }
                            echo ">" . $row["category_name"] . "</option>";
                        }
                        ?>
                </select>
                <button onclick="add_category()">Create new category</button>
            </div>
            <div class="field"><p>Image 1</p><input type="file" name="img_1">
            <?php 
            $img_1 = base64_encode($imgs[0]);
            echo "Old Image : <img src=\"data:image/jpeg;base64,$img_1\" width=20%>"
            ?>
            </div>
            <div class="field"><p>Image 2</p><input type="file" name="img_2">
            <?php 
            if($imgs[1] != NULL)
            {
                $img_2 = base64_encode($imgs[1]);
                echo "Old Image : <img src=\"data:image/jpeg;base64,$img_2\" width=20%>";    
            }
            ?>
            </div>
            <div class="field"><p>Image 3</p><input type="file" name="img_3">
            <?php 
            if($imgs[2] != NULL)
            {
                $img_3 = base64_encode($imgs[2]);
                echo "Old Image : <img src=\"data:image/jpeg;base64,$img_3\" width=20%>";
            }
            ?></div>
            <div class="field"><p>Image 4</p><input type="file" name="img_4">
            <?php 
            if($imgs[3] != NULL)
            {
                $img_4 = base64_encode($imgs[3]);
                echo "Old Image : <img src=\"data:image/jpeg;base64,$img_4\" width=20%>";
            }
            ?></div>
            <div class="field"><p>Image 5</p><input type="file" name="img_5">
            <?php 
            if($imgs[4] != NULL)
            {
                $img_5 = base64_encode($imgs[4]);
                echo "Old Image : <img src=\"data:image/jpeg;base64,$img_5\" width=20%>";
            }
            ?>
            </div>
            <input type="submit" name="sb">
        </form>

    </div>

    <script>
        function add_category(){
            let cat_name = prompt("Enter new category name");
            if(cat_name && cat_name.length > 0){
                window.location.href = `new-category.php?category-name=${cat_name}`;
            }
        }
    </script>
    <?php
    // Reading footer html from a common file
    // The active class will be added later with JS
    $footer_file = fopen("../../footer.code", "r");
    $footer_data = str_replace("../", "../../", fread($footer_file, filesize("../../footer.code")));
    
    echo $footer_data;
    ?>
</body>
</html>