<?php
  session_start();

  include_once("./config/db.php");

  if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $query = "select * from product limit 5;";
  $result = mysqli_query($con, $query);

  if ($result) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  } else {
    echo "Failed to fetch products!";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Super Shop</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./static/style.css">
</head>
<body>
  <?php require_once 'header.php'; ?>
  <?php
    foreach ($products as $product) {
      echo <<<HEREDOC
        <div class="product">
          <h3>{$product['name']}</h3>
          <p>{$product['description']}</p>
          <p>{$product['price']}</p>
          <img src="/ecommerce/uploads/{$product['photo_name']}" />
        </div>
      HEREDOC;
    }
  ?>
</body>
</html>
