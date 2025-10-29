
<?php
include('db.php');

$info = "";

if(isset($_POST['submit'])){
  $Name = $_POST['name'];
  $Email = $_POST['email'];
  $parent = $_POST['parent_number'];
  $another = $_POST['another_number'];
  $Password = $_POST['password'];
  $ConfirmPassword = $_POST['confirm_password'];

  $user_id = $_SESSION['user_id'];

if ($Password !== $ConfirmPassword) {
    $info = "<p style='color:red;'>Passwords do not match. Please try again.</p>";
}
else {
   $check_email = "SELECT * FROM users WHERE email='$Email'";
   $res = mysqli_query($conn, $check_email);
   if (mysqli_num_rows($res) > 0) {
       $info = "<p style='color:red;'>Email already exists. Please use a different email.</p>";
   } else {
    $hashed_password = password_hash($Password, PASSWORD_BCRYPT);
       $insert_query = "INSERT INTO users (username, email, pass, parentnumber, anotherphone) VALUES ('$Name', '$Email', '$hashed_password', '$parent', '$another')";
       if (mysqli_query($conn, $insert_query)) {
           $info = "<p style='color:green;'>Registration successful!</p>";
           header("Location: login.php");
           exit();
       } else {
           $info = "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
       }
   }
}
}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Form Submission</title>
    </head>
    <body>
        <form action="" method="post">
            
            <caption><h2>School Championship Registration Form</h2></caption>
            <label for="name">User Name:</label><br>
            <input type="text" id="name" name="name" required placeholder="Enter your name">
            <br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required placeholder="Enter your email">
            <br><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required placeholder="Enter your password">
            <br><br>
            <label for="Confirm Password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
            <br><br>
            <label for="parent_number">Parent's Phone Number:</label><br>
            <input type="tel" id="parent_number" name="parent_number" required placeholder="Enter parent's phone number">
            <br><br>
            <label for="another_number">Another Contact Number:</label><br>
            <input type="tel" id="another_number" name="another_number" required placeholder="Enter another contact number">
            <br><br>
            <?php echo $info; ?>
            <input type="submit" value="Submit" name="submit">

        </form>
        </body>
        <script src="style.js"></script>
</html>