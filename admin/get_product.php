<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  if (!$id = $_GET['id']) {
    echo "No id provided!";
    die();
  }

  $query = "select * from product where id = $id";

  $result = mysqli_query($con, $query);

  if ($result) {
    $product = mysqli_fetch_assoc($result);

    echo json_encode($product);
  }
  else {
    echo "failed to get product";
    die();
  }
?>