<?php
  session_start();
  include_once("../config/db.php");
  
  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
  }

  if (!isset($_SESSION['user_id']) || !isset($_SESSION['permission']) || $_SESSION['permission'] !== 'admin'){
    header("Location: /ecommerce/login/");
    die;
  }

  $query = "select * from brand";
  $result = mysqli_query($con, $query);

  if ($result) {
    $brands = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  else {
    echo "Failed to fetch brands";
  }

  $query = "select * from product";
  $result = mysqli_query($con, $query);

  if ($result) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  else {
    echo "Failed to fetch products";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="./create_brand.php" method="post">
    <input type="text" name="name" placeholder="Brand Name" />
    <button type="submit">Create Brand</button>
  </form>

  <?php if(count($brands) > 0): ?>
    <form action="./create_product.php" method="post">
      <input type="text" placeholder="Product Name" name="name"/>
      <input type="text" placeholder="Description" name="description"/>
      <input type="text" placeholder="Price" name="price"/>
      <select name="brand-id">
        <?php
          foreach ($brands as $brand) {
            echo "<option value='".$brand['id']."'>".$brand['name']."</option>";
          }
        ?>
      </select>
      <button type="submit">Create Product</button>
    </form> 
  <?php endif; ?>

  <ul>
    <?php
      foreach ($products as $product) {
        echo "<li>".$product['name']."</li>";
      }
    ?>
  </ul>
</body>
</html>