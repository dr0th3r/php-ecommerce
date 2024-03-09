<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
  }

  $id = $_POST['id'];
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