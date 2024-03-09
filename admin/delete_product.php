<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
  }

  $id = $_POST['id'];
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