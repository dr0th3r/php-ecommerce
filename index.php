<?php
  session_start();

  include_once("./config/db.php");

  if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $query = "select 
              product.id, product.name, product.price, product.photo_name, AVG(review.rating) as avg_rating
            from 
              product
            left join
              review on review.product_id = product.id
            group by
              product.id
            limit 20;";

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
  <link rel="stylesheet" href="./static/mainpage.css">
</head>
<body>
  <?php require_once 'header.php'; ?>
  <main class="products">
    <?php
      foreach ($products as $product) {
        $product['avg_rating'] = round($product['avg_rating'] ?? 0, 1);
        echo <<<HEREDOC
          <div class="product">
            <img src="/ecommerce/uploads/{$product['photo_name']}" />
            <h3>
              <a href="/ecommerce/product/?id={$product['id']}">
                {$product['name']}</h3>
              </a>
            <p>{$product['avg_rating']} / 5</p>
            <p>\${$product['price']}</p>
          </div>
        HEREDOC;
      }
    ?>
  </main>
</body>
</html>
