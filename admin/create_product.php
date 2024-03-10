<?php
  session_start();
  include_once("../config/db.php");
  
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['permission']) || $_SESSION['permission'] !== 'admin'){
    header("Location: /ecommerce/login/");
    die;
  }

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $brand_id = $_POST['brand-id'];

  if (!isset($name) || !isset($description) || !isset($price) || !isset($brand_id)) {
    echo "Invalid input";
    die;
  }

  $query = "insert into product (name, description, price, brand_id) values ('$name', '$description', $price, $brand_id)";
  $result = mysqli_query($con, $query);
  if ($result) {
    header("Location: ../admin/index.php");
    die;
  }
  else {
    echo "Failed to create product";
  }
?>