<?php
  session_start();

  include_once("./config/db.php");

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $user_id = $_SESSION['user_id'];

  if (!isset($user_id)) {
    echo "You are not logged in!";
    die();
  }

  $query = "delete from user where id = $user_id;";

  if (mysqli_query($con, $query)) {
    session_destroy();
    header("Location: /ecommerce/index.php");
  } else {
    echo "Failed to delete user!";
  }
?>