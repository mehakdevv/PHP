<?php
session_start();
include('db.php');

$info = "";
if(isset($_POST['login'])){
  $Email = $_POST['email'];
  $Password = $_POST['password'];

   $check_email = "SELECT * FROM users WHERE email='$Email'";
   $res = mysqli_query($conn, $check_email);
   if (mysqli_num_rows($res) > 0) {
       $row = mysqli_fetch_assoc($res);
       if (password_verify($Password, $row['pass'])) {
           $info = "<p style='color:green;'>Login successful!</p>";
           header("Location: index.php");
           $_SESSION['user_id'] = $row['id'];
           exit();
       } else {
           $info = "<p style='color:red;'>Incorrect password. Please try again.</p>";
       }
   } else {
       $info = "<p style='color:red;'>Email not found. Please register first.</p>";
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
     <form action="" method="post">
            
            <caption><h2>School Championship login Form</h2></caption>
           
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required placeholder="Enter your email">
            <br><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required placeholder="Enter your password">
            <br><br>
           
            <?php echo $info; ?>
            <input type="submit" value="Submit" name="login">
            <a href="register.php">Signup</a>

        </form>
</body>
</html>