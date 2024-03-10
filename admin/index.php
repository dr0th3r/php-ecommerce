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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../static/style.css">
  <link rel="stylesheet" href="../static/admin.css">
</head>
<body>
  <ul class="brand-list">
    <?php
      foreach ($brands as $brand) {
        echo <<<HEREDOC
          <li>
            <span>{$brand['name']}</span>
            <form action="./delete_brand.php" method="post">
              <input type="hidden" name="id" value="{$brand['id']}" />
              <button type="submit" class="submit-btn">
                <i class="fa fa-solid fa-trash"></i>
              </button>
            </form>
          </li>
        HEREDOC;
      }
    ?>
  </ul>

  <ul class="product-list">
    <?php
      foreach ($products as $product) {
        echo <<<HEREDOC
          <li>
            <span>{$product['name']}</span>
            <form action="./delete_product.php" method="post">
              <input type="hidden" name="id" value="{$product['id']}" />
              <button type="submit" class="submit-btn">
                <i class="fa fa-solid fa-trash"></i>
              </button>
            </form>
          </li>
        HEREDOC;
      }
    ?>
  </ul>

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

</body>
</html>