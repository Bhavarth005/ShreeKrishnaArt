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
    ?>

    <div class="container">
        <h1>Add Artwork</h1>
        <form action="upload_artwork.php" method="POST" enctype="multipart/form-data">
            <div class="field">
                <p>Name of artwork</p>
                <input type="text" name="artwork_name" placeholder="Enter Artwork Name" required>
            </div>
            <div class="field">
                <p>Description of artwork</p>
                <textarea name="desc" placeholder="Enter Description" cols="50" rows="10" required></textarea>
            </div>
            <div class="field">
                <p>Size of artwork</p>
                <input type="text" name="size" placeholder="Enter size" required>
            </div>
            <div class="field">
                <p>Weight of artwork</p>
                <input type="text" name="weight" placeholder="Enter weight" required>
            </div>
            <div class="field">
                <p>Select Category</p>
                <select name="category">
                        <?php
                        include ("../../globals.php");
                        $result = mysqli_query($con, "SELECT * FROM $category_master");
                        for($i = 0; $i < mysqli_num_rows($result); $i++)
                        {
                            $row = mysqli_fetch_assoc($result); 
                            echo "
                                <option value=".$row["category_id"].">".$row["category_name"]."</option>";
                        }
                        ?>
                </select>
                <button onclick="add_category()">Create new category</button>
            </div>
            <div class="field"><p>Image 1</p><input type="file" name="img_1" required></div>
            <div class="field"><p>Image 2</p><input type="file" name="img_2"></div>
            <div class="field"><p>Image 3</p><input type="file" name="img_3"></div>
            <div class="field"><p>Image 4</p><input type="file" name="img_4"></div>
            <div class="field"><p>Image 5</p><input type="file" name="img_5"></div>
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