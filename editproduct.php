<?php
session_start();
include('db.php');

if (isset($_GET['id'])) {
    $result = "SELECT * FROM products WHERE id=" . $_GET['id'];
    $res = mysqli_query($conn, $result);
    $row = mysqli_fetch_array($res);

    $productname = $row['productName'];
    $productprice = $row['price'];
    $productdesc = $row['description'];
    $productimage = $row['image'];
    $discount = $row['discount'];
}

if (isset($_POST['edit'])) {
    $name = $_POST['productName'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $discount = $_POST['discount'] ?? '';

    // Handle image upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image_name = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $target_file = 'uploads/' . basename($image_name);
        move_uploaded_file($image_tmp, $target_file);

        // ✅ Correct query with image update
        $query = "UPDATE products 
                  SET productName='$name', price='$price', description='$description', discount='$discount', image='$target_file' 
                  WHERE id=" . $_GET['id'];
    } else {
        // ✅ If no new image uploaded
        $query = "UPDATE products 
                  SET productName='$name', price='$price', description='$description', discount='$discount' 
                  WHERE id=" . $_GET['id'];
    }

    $res = mysqli_query($conn, $query);

    if ($res) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="productName" value="<?php echo $productname; ?>" placeholder="Enter product name">
        <br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $productprice; ?>" placeholder="Enter price">
        <br><br>

        <label for="description">Description:</label>
        <input id="description" name="description" value="<?php echo $productdesc; ?>" placeholder="Enter product description">
        <br><br>

        <label for="discount">Discount (%):</label>
        <input type="number" id="discount" name="discount" value="<?php echo $discount; ?>" placeholder="Enter discount percentage">
        <br><br>

        <label for="after_discount">Image:</label>
        <input type="file" id="after_discount" name="image" accept="image/*">
        <img height="100" width="100" src="<?php echo $productimage; ?>" alt="">
        <br><br>

        <input type="submit" value="Update Product" name="edit">
    </form>
</body>
</html>
