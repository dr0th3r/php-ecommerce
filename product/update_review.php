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
  
  $id = $_POST['id'];
  $product_id = $_POST['product-id'];
  $comment = $_POST['comment'];
  $rating = $_POST['rating'];

  if (!isset($id) || !isset($comment) || !isset($rating)) {
    echo "Id, comment or rating not provided!";
    die;
  }

  $query = "update review set comment = '$comment', rating = $rating where id = $id and user_id = $user_id;";

  if (mysqli_query($con, $query)) {
    header("Location: /ecommerce/product?id=$product_id");
  } else {
    echo "Failed to update review!";
  }
?>