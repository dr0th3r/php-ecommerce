<?php
  session_start();

  include_once("../config/db.php");

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $user_id = $_SESSION['user_id'];

  if (!isset($user_id)) {
    echo "You are not logged in!";
    die();
  }

  $review_id = $_POST['id'];
  $product_id = $_POST['product-id'];

  if (!isset($review_id)) {
    echo "Id not provided!";
    die;
  }

  if (!isset($product_id)) {
    echo "Product id not provided!";
    die;
  }

  $query = "delete from review where id = $review_id and user_id = $user_id;";

  if (mysqli_query($con, $query)) {
    header("Location: /ecommerce/product?id=$product_id");
  } else {
    echo "Failed to delete review!";
  }
?>