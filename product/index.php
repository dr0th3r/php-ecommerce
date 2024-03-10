<?php
  include_once("../config/db.php");

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $id = $_GET['id'];

  if (!isset($id)) {
    echo "Id not provided!";
    die;
  }

  $query = "select product.*, brand.name as brand_name from product inner join brand on product.brand_id = brand.id where product.id = $id;";
  $result = mysqli_query($con, $query);
  if ($result) {
    $product = mysqli_fetch_assoc($result);
  }
  else {
    echo "Failed to get product";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
    echo "<title>" . $product['name'] . "</title>";
  ?>
</head>
<body>
  <?php 
    echo <<<HEREDOC
      <h1>{$product['name']}</h1>
      <p>{$product['description']}</p>
      <p>{$product['price']}</p>
      <p>{$product['brand_name']}</p>
    HEREDOC;
  ?>
</body>
</html>