<?php
  session_start();
  include_once("../config/db.php");

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $user_id = $_SESSION['user_id'];

  $id = $_GET['id'];

  if (!isset($id)) {
    echo "Id not provided!";
    die;
  }

  $productQuery = "select product.*, brand.name as brand_name from product join brand on product.brand_id = brand.id where product.id = $id;";
  
  $reviewsQuery = "select 
    review.*, user.name as user_name 
    from review 
    join user on review.user_id = user.id 
    where review.product_id = $id";
  
  if (isset($user_id)) {
    $reviewsQuery .= " order by case when user_id = $user_id then 0 else 1 end;";
  } else {
    $reviewsQuery .= ";";
  }

  $productResult = mysqli_query($con, $productQuery);
  $reviewsResult = mysqli_query($con, $reviewsQuery);

  if ($productResult && $reviewsResult) {
    $product = mysqli_fetch_assoc($productResult);
    $reviews = mysqli_fetch_all($reviewsResult, MYSQLI_ASSOC);
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
  <link rel="stylesheet" href="../static/product.css">
  <link rel="stylesheet" href="../static/style.css">
  <link rel="stylesheet" href="../static/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php require_once '../header.php'?>

  <?php 
    echo <<<HEREDOC
      <h1>{$product['name']}</h1>
      <p>{$product['description']}</p>
      <p>{$product['price']}</p>
      <p>{$product['brand_name']}</p>
    HEREDOC;
  ?>

  <h2>Reviews</h2>
  <ul>
    <?php
      foreach ($reviews as $i=>$review) {
        if ($i == 0 && $review['user_id'] == $user_id) {
          echo <<<HEREDOC
              <li class="user-review is-active">
                <p>{$review['user_name']}</p>
                <p>{$review['comment']}</p>
                <p>{$review['rating']}</p>
                <button id="edit-review-btn">Edit</button>
                <form action="./delete_review.php" method="post">
                  <input type="hidden" name="id" value="{$review['id']}" />
                  <input type="hidden" name="product-id" value="{$product['id']}" />
                  <button type="submit">Delete</button>
                </form>
              </li>
              <li class="update-review">
                <form action="./update_review.php" method="post">
                  <input type="hidden" name="id" value="{$review['id']}" />
                  <input type="hidden" name="product-id" value="{$product['id']}" />
                  <textarea type="text" name="comment" >{$review['comment']}</textarea>
                  <input type="number" name="rating" min="1" max="5" value="{$review['rating']}"/>
                  <button type="submit">Update</button>
                  <button type="button" id="cancel-update-btn">Cancel</button>
                </form>
              </li>
          HEREDOC;
        } else {
          if ($i == 0 && isset($user_id)) {
            echo <<<HEREDOC
              <li>
                <form action="./create_review.php" method="post">
                  <input type="hidden" name="id" value="{$product['id']}" />
                  <textarea type="text" name="comment" ></textarea>
                  <input type="number" name="rating" min="1" max="5"/>
                  <button type="submit">Add</button>
                </form>
              </li>
              <li>
                <p>{$review['user_name']}</p>
                <p>{$review['comment']}</p>
                <p>{$review['rating']}</p>
              </li>
            HEREDOC;
          } elseif ($i == 0) {
            echo <<<HEREDOC
              <li>
                <a href="/ecommerce/login">Login to add a review</a>
              </li>
              <li>
                <p>{$review['user_name']}</p>
                <p>{$review['comment']}</p>
                <p>{$review['rating']}</p>
              </li>
            HEREDOC;
          } else {
            echo <<<HEREDOC
              <li>
                <p>{$review['user_name']}</p>
                <p>{$review['comment']}</p>
                <p>{$review['rating']}</p>
              </li>
            HEREDOC;
          }
        }

      }
    ?>
  </ul>
  <script src="./product.js"></script>
</body>
</html>