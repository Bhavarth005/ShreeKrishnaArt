<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shree Krishna Art</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/nav.js"></script>
</head>
<body>
    <?php
        // Reading nav html from a common file
        // The active class will be added later with JS
        $nav_file = fopen("../nav.code", "r");
        $nav_data = str_replace("./", "./", fread($nav_file, filesize("../nav.code")));
        
        echo $nav_data;
    ?>
    <h1>Add Artwork</h1>
    <form action="upload_artwork.php" method="POST">
        <input type="text" name="artwork_name" placeholder="Enter Artwork Name" required>
        <textarea name="desc" placeholder="Enter Description" cols="50" rows="20" required></textarea>
        <input type="text" name="size" placeholder="Enter size" required>
        <input type="number" name="weight" placeholder="Enter weight" required>
        <select name="category">
            <?php
                include ("../globals.php");
                $result = mysqli_query($con, "SELECT * FROM $category_master");
                for($i = 0; $i < mysqli_num_rows($result); $i++)
                {
                    echo "
                        <option value=".mysqli_fetch_assoc($result["category_id"]).">". 
                        mysqli_fetch_assoc($result["category_name"])."</option>";
                }
            ?>
        </select>
        <p>Image 1</p><input type="file" name="img_1" required>
        <p>Image 2</p><input type="file" name="img_2">
        <p>Image 3</p><input type="file" name="img_3">
        <p>Image 4</p><input type="file" name="img_4">
        <p>Image 5</p><input type="file" name="img_5">
    </form>
    <?php
    // Reading footer html from a common file
    // The active class will be added later with JS
    $footer_file = fopen("../footer.code", "r");
    $footer_data = str_replace("./", "./", fread($footer_file, filesize("../footer.code")));
    
    echo $footer_data;
    ?>
</body>
</html>