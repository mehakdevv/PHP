<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$info = "";

if (isset($_POST['add_product']))
{
    $name = $_POST['productName'] ?? '';
$price = $_POST['price'] ?? '';
$description = $_POST['description'] ?? '';
$discount = $_POST['discount'] ?? '';
$image = $_POST['image'] ?? '';
$post_id = $_SESSION['user_id'];
 {
    $insert_product = "INSERT INTO products (productName, price, description, discount, image,  user_id) VALUES ('$name', '$price', '$description', '$discount',$image, '$post_id')";
    if (mysqli_query($conn, $insert_product)) {
        $info = "<p style='color:green;'>Product added successfully!</p>";
    } else {
        $info = "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>index.php</h1>
    <h3>Welcome <?php   
    $query = "SELECT * FROM users WHERE id = $_SESSION[user_id]";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result); 
    echo $row['username'];
    ?> </h3>

     <form action="" method="post">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="productName" required placeholder="Enter product name">
        <br><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required placeholder="Enter price">
        <br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" require placeholder="Enter product description"></textarea>
        <br><br>
        <label for="discount">Discount (%):</label>
        <input type="number" id="discount" name="discount" required placeholder="Enter discount percentage">
        <br><br>
        <label for="after_discount">Image:</label>
        <input type="file" id="after_discount" name="image" required placeholder="Enter price after discount">
        <br><br>
        <input type="submit" value="Add Product" name="add_product">
    </form>


    <a href="logout.php">Logout</a>
</body> 
</html>