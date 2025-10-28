<?php
include('db.php');

if(isset($_POST['submit'])){
  $schoolName = $_POST['name'];
  $scholarFirst = $_POST['scholar_first'];
  $scholarLast = $_POST['scholar_last'];
  $parentFirst = $_POST['parent_first'];
  $parent_last = $_POST['parent_last'];
  $parentNumber = $_POST['phone'];
  $parentEmail = $_POST['email'];
  $sport = $_POST['sport'];

  echo $schoolName;
  echo "<br>";
  echo $scholarFirst;
  echo "<br>";
  echo $scholarLast;
  echo "<br>";
  echo $parentFirst;
  echo "<br>";
  echo $parent_last;
  echo "<br>";
  echo $parentNumber;
  echo "<br>";
  echo $parentEmail;
  echo "<br>";
  echo $sport;
  echo "<br>";
}
?>














<!-- <?php  
include('db.php');

if (isset($_POST['submit'])) {
    $schoolName = $_POST['name'];
    $scholarFirst = $_POST['scholar_first'];
    $scholarLast = $_POST['scholar_last'];
    $parentFirst = $_POST['parent_first'];
    $parentLast = $_POST['parent_last'];
    $parentNumber = $_POST['phone'];
    $parentEmail = $_POST['email'];
    $sport = $_POST['sport'];
  echo $schoolName;
  echo "<br>";
  echo $scholarFirst;
}
?> -->