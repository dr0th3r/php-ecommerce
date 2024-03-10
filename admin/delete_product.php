<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $id = $_POST['id'];

  if (!isset($id)) {
    echo "Invalid input";
    die;
  }

  $query = "delete from product where id = $id";

  $result = mysqli_query($con, $query);

  if ($result) {
    header("Location: ../admin/index.php");
    die;
  }
  else {
    echo "Failed to delete product";
  }
?>