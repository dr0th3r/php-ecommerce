<?php
  session_start();
  include_once("../config/db.php");
  
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['permission']) || $_SESSION['permission'] !== 'admin'){
    header("Location: /ecommerce/login/");
    die;
  }

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
  }

  $id = $_POST['id'];

  if (!isset($id)) {
    echo "Invalid input";
    die;
  }

  $productQuery = "delete from product where brand_id = $id";
  $brandQuery = "delete from brand where id = $id";

  $productResult = mysqli_query($con, $productQuery);
  $brandResult = mysqli_query($con, $brandQuery);

  if ($productResult && $brandResult) {
    header("Location: ../admin/index.php");
    die;
  }
  elseif ($productResult) {
    echo "Failed to delete brand";
  } else {
    echo "Failed to delete product";
  }
?>