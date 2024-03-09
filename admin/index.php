<?php
  session_start();

  if (!isset($_SESSION['user_id']) || !isset($_SESSION['permission']) || $_SESSION['permission'] !== 'admin'){
    header("Location: /ecommerce/login/");
    die;
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

<!--   <form>
    <input type="text" placeholder="Product Name" />
    <input type="text" placeholder="Description" />
    <input type="text" placeholder="Price" />
    <select name="brand">
      <option value="1">Brand 1</option>
      <option value="2">Brand 2</option>
      <option value="3">Brand 3</option>
    </select>
  </form> -->
</body>
</html>