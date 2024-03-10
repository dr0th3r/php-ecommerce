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
  $comment = $_POST['comment'];
  $rating = $_POST['rating'];

  if (!isset($id) || !isset($comment) || !isset($rating)) {
    echo "Id, comment or rating not provided!";
    die;
  }

  $query = "insert into review (product_id, user_id, comment, rating) values ($id, $user_id, '$comment', $rating);";

  if (mysqli_query($con, $query)) {
    header("Location: /ecommerce/product?id=$id");
  } else {
    echo "Failed to create review!";
  }
?>