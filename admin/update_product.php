<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
  }
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $brand_id = $_POST['brand-id'];

  $query = "update product set name = '$name', description = '$description', price = $price, brand_id = $brand_id where id = $id";
  $result = mysqli_query($con, $query);
  if ($result) {
    header("Location: ../admin/index.php");
    die;
  }
  else {
    echo "Failed to create product";
  }
?>