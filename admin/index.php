<?php
  session_start();
  include_once("../config/db.php");
  
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['permission']) || $_SESSION['permission'] !== 'admin'){
    header("Location: /ecommerce/login/");
    die;
  }

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
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
  <div class="list-container">
    <ul class="brand-list">
      <?php
        foreach ($brands as $brand) {
          echo <<<HEREDOC
            <li class="brand-li is-active">
              <span>{$brand['name']}</span>
              <div class="icon-container">
                <button class="submit-btn update-brand-btn">
                  <i class="fa fa-solid fa-pen"></i>
                </button>
                <form action="./delete_brand.php" method="post">
                  <input type="hidden" name="id" value="{$brand['id']}" />
                  <button type="submit" class="submit-btn">
                    <i class="fa fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </li>
            <li class="update-brand-li" id="update-{$brand['id']}">
              <form action="./update_brand.php" method="post">
                <input type="hidden" name="id" value="{$brand['id']}" />
                <input type="text" name="name" placeholder="Brand Name" value="{$brand['name']}">
                <button type="submit">Update Brand</button>
                <button class="cancel-update-brand-btn" type="button">Cancel</button>
              </form>
            </li>
          HEREDOC;
        }
      ?>
      <li>
        <button id="create-brand-btn" class="create-brand-btn is-active">
          Add brand
        </button>
        <form method="post" action="./create_brand.php" id="create-brand-form" class="create-brand-form">
          <input type="text" name="name" placeholder="Brand Name" />
          <button type="submit">Create Brand</button>
          <button id="cancel-create-brand-btn" type="button">Cancel</button>
        </form>
      </li>
    </ul>

    <ul class="product-list">
      <?php
        foreach ($products as $product) {
          echo <<<HEREDOC
            <li>
              <span>{$product['name']}</span>
              <div class="icon-container">
                <button class="submit-btn update-product-btn" id={$product['id']}>
                  <i class="fa fa-solid fa-pen"></i>
                </button>
                <form action="./delete_product.php" method="post">
                  <input type="hidden" name="id" value="{$product['id']}" />
                  <button type="submit" class="submit-btn">
                    <i class="fa fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </li>
          HEREDOC;
        }
      ?>
      <li>
        <button id="create-product-btn">
          Add product
        </button>
      </li>
    </ul>
  </div>

  <dialog id="create-product-dialog">
    <h1>Create Product</h1>
    <form action="./create_product.php" method="post" class="create-product-form" enctype="multipart/form-data">
        <input type="text" placeholder="Product Name" name="name"/>
        <textarea type="text" placeholder="Description" name="description"></textarea>
        <input type="text" placeholder="Price" name="price"/>
        <input type="file" name="image" accept="image/png, image/jpeg"/>
        <select name="brand-id">
          <?php
            foreach ($brands as $brand) {
              echo "<option value='".$brand['id']."'>".$brand['name']."</option>";
            }
          ?>
        </select>
        <button type="submit">Create Product</button>
    </form>
    <form method="dialog">
        <button>Cancel</button>
    </form>
  </dialog>

  <dialog id="update-product-dialog">
    <h1>Update Product</h1>
    <form action="./update_product.php" method="post" class="update-product-form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="update-product-id"/>
        <input type="text" placeholder="Product Name" name="name" id="update-product-name"/>
        <textarea type="text" placeholder="Description" name="description" id="update-product-description"></textarea>
        <input type="text" placeholder="Price" name="price" id="update-product-price"/>
        <input type="file" name="image" accept="image/png, image/jpeg"/>
        <select name="brand-id" id="update-product-brand-id">
          <?php
            foreach ($brands as $brand) {
              echo "<option value='".$brand['id']."'>".$brand['name']."</option>";
            }
          ?>
        </select>
        <button type="submit">Update Product</button>
    </form>
    <form method="dialog">
        <button>Cancel</button>
    </form>
  </dialog>
  <script src="./admin.js"></script>
</body>
</html>