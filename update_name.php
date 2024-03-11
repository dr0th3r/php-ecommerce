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
  
  $name = $_POST['name'];

  if (!isset($name)) {
    echo "Name not provided!";
    die;
  }

  $query = "update user set name = '$name' where id = $user_id;";

  if (mysqli_query($con, $query)) {
    $_SESSION['name'] = $name;
    header("Location: /ecommerce/index.php");
  } else {
    echo "Failed to update user's name!";
  }
?>