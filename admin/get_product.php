<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
  }

  if (!$id = $_GET['id']) {
    die("no id provided!");
  }

  $query = "select * from product where id = $id";

  $result = mysqli_query($con, $query);

  if ($result) {
    $product = mysqli_fetch_assoc($result);

    echo json_encode($product);
  }
  else {
    die("failed to get product");
  }
?>