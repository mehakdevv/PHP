<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$info = "";

if (isset($_POST['add_product'])) {
    $name = $_POST['productName'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $discount = $_POST['discount'] ?? '';
    $post_id = $_SESSION['user_id'];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image_name = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $target_file = "uploads/" . $image_name;
        move_uploaded_file($image_tmp, $target_file);
    } else {
        $target_file = "";
    }

    $insert_product = "INSERT INTO products (productName, price, description, discount, image,  user_id) VALUES ('$name', '$price', '$description', '$discount', '$target_file', '$post_id')";
    if (mysqli_query($conn, $insert_product)) {
        $info = "<p style='color:green;'>Product added successfully!</p>";
    } else {
        $info = "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
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

    <form action="" method="post" enctype="multipart/form-data">
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
        <input type="file" id="after_discount" name="image" accept="image/*" required placeholder="Enter price after discount">
        <br><br>
        <input type="submit" value="Add Product" name="add_product">
    </form>

    <h2>Users uploaded products</h2>

    <?php $user_id = $_SESSION['user_id'];
$query = "SELECT * FROM products WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($result->num_rows > 0) {
    do {
        //    $price = $row["price"];
        //    $discount = $row["discount"];
        //    $image_name = $row["image"];
        //    $description = $row["description"];
        echo "<div style='border:1px solid black; padding:10px; margin:10px;'>
           <h3>Product Name: " . $row['productName'] . "</h3>
           <p>Price: Rs " . $row['price'] . "</p>
        <p>Description: " . $row['description'] . "</p>
        <p>Discount: " . $row['discount'] . "%</p> 
        <img src='" . $row['image'] . "' alt='Product Image' style='max-width:200px;'><br>
        <a href='editproduct.php?id=" . $row['id'] . "'>Edit</a> |
        </div>";
    } while ($row = $result->fetch_assoc());
} else {
    echo "<p>No products found.</p>";
}?>


    <a href="logout.php">Logout</a>
</body>

</html>