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

/*   $productQuery = "select 
              product.*, 
              brand.name as brand_name,
              review.id as review_id, review.comment as review_comment, review.rating as review_rating, review.user_id as user_id,
              user.email as user_email
            from product 
            left join brand on product.brand_id = brand.id 
            left join review on product.id = review.product_id
            left join user on review.user_id = user.id
            where product.id = $id
            order by user_id,
              case when user_id = $user_id then 0 else 1 end;
            "; */

  $productQuery = "select product.*, brand.name as brand_name from product join brand on product.brand_id = brand.id where product.id = $id;";
  
  $reviewsQuery = "select 
    review.*, user.name as user_name 
    from review 
    join user on review.user_id = user.id 
    where review.product_id = $id
    order by user_id,
      case when user_id = $user_id then 0 else 1 end;
    ";

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

  <h2>Reviews</h2>
  <ul>
    <?php
      foreach ($reviews as $review) {
        echo "<li>";
        echo "<p>{$review['user_name']}</p>";
        echo "<p>{$review['comment']}</p>";
        echo "<p>{$review['rating']}</p>";
        echo "</li>";
      }
    ?>
</body>
</html>