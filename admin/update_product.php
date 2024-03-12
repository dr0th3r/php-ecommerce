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

  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $brand_id = $_POST['brand-id'];

  $image = $_FILES['image'];
  $image_name = $image['name'];
  $image_path = $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/uploads/' . $image_name;
  $image_format = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

  $old_image_query = "select photo_name from product where id = $id";
  $old_image_result = mysqli_query($con, $old_image_query);
  $old_image_name = mysqli_fetch_assoc($old_image_result)['photo_name'];

  if (!isset($id) || !isset($name) || !isset($description) || !isset($price) || !isset($brand_id)) {
    echo "Invalid input";
    die;
  }

  if (!$old_image_name) {
    echo "Failed to get old image";
    die;
  }

  if (!unlink($_SERVER['DOCUMENT_ROOT'] . '/ecommerce/uploads/' . $old_image_name)) {
    echo "Failed to delete old image";
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
    echo "Failed to upload new image";
    die;
  }

  $query = "update product set name = '$name', description = '$description', price = '$price', brand_id = '$brand_id', photo_name = '$image_name' where id = $id";
  $result = mysqli_query($con, $query);
  if ($result) {
    header("Location: ../admin/index.php");
    die;
  }
  else {
    echo "Failed to create product";
  }
?>