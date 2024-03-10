<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $id = $_POST['id'];
  $name = $_POST['name'];
  $query = "update brand set name = '$name' where id = $id";

  if (!isset($id) || !isset($name)) {
    echo "Invalid input";
    die;
  }

  $result = mysqli_query($con, $query);
  if ($result) {
    header("Location: ../admin/index.php");
    die;
  }
  else {
    echo "Failed to update brand";
  }
?>