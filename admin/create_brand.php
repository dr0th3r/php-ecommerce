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

  if (!isset($name)) {
    echo "Invalid input";
    die;
  }

  $query = "insert into brand (name) values ('$name')";
  $result = mysqli_query($con, $query);
  if ($result) {
    header("Location: ../admin/index.php");
    die;
  }
  else {
    echo "Failed to create brand";
  }
?>