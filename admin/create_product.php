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

  $image = $_FILES['image'];
  $image_name = $image['name'];
  $image_path = $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/uploads/' . $image_name;
  $image_format = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

  if (!isset($name) || !isset($description) || !isset($price) || !isset($brand_id)) {
    echo "Invalid input";
    die;
  }

  if ($image['size'] <= 0 || $image['size'] > 1000000 || !getimagesize($image['tmp_name']) || file_exists($image_path)) {
    echo "Invalid image";
    die;
  }

  if ($image_format !== 'jpg' && $image_format !== 'png' && $image_format !== 'jpeg') {
    echo "Invalid image format";
    die;
  }

  if (!move_uploaded_file($image['tmp_name'], $image_path)) {
    echo "Failed to upload image";
    die;
  }

  $query = "insert into product (name, description, price, brand_id, photo_name) values ('$name', '$description', '$price', '$brand_id', '$image_name')";
  $result = mysqli_query($con, $query);
  if ($result) {
    header("Location: ../admin/index.php");
    die;
  }
  else {
    echo "Failed to create product";
  }
?>