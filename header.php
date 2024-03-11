<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/ecommerce/static/header.css">
</head>
<body>
  <nav class="header-nav">
    <div class="header-top">
      <h2>Super Shop</h2>
      <div class="search">
        <input type="text" placeholder="Search" class="search-bar">
        <button class="icon-btn"><i class="fas fa-search"></i></button>
      </div>
      <div class="user">
        <button class="icon-btn"><i class="fas fa-shopping-cart"></i></button>
        <?php
          if (isset($_SESSION['user_id'])) {
            echo <<<HEREDOC
              <button class="icon-btn" id="toggle-dropdown-btn"><i class="fas fa-user"></i></button>
              <div class="dropdown">
                <button class="icon-btn change-name-btn is-active">Change Name</button>
                <form action="/ecommerce/update_name.php" method="post" class="change-name-form">
                  <input type="text" name="name" placeholder="New Name" value="{$_SESSION['name']}">
                  <button class="icon-btn">Update</button>
                  <button class="icon-btn cancel-change-name-btn" type="button">Cancel</button> 
                </form>
                <form action="/ecommerce/logout.php" method="post">
                  <button class="icon-btn">Logout</button>
                </form>
                <form action="/ecommerce/delete_user.php" method="post">
                  <button class="icon-btn">Delete Account</button>
                </form>
              </div>
            HEREDOC;
          } else {
            echo '<a href="/ecommerce/login" class="icon-btn">Login</a>';
          }
        ?>
        <button class="icon-btn hamburger"><i class="fa-solid fa-bars"></i></button>
      </div>
    </div>
    <div class="mobile-search">
      <input type="text" placeholder="Search" class="search-bar">
      <button class="icon-btn"><i class="fas fa-search"></i></button>
    </div>
    <ul class="header-links">
      <li class="product">Mobile</li>
      <li class="product">PC, Notebook</li>
      <li class="product">Hardware</li>
      <li class="product">TV, audio, photo</li>
      <li class="product">Gadgets</li>
      <li class="product">Gaming</li>
    </ul>
  </nav>
  <script src="/ecommerce/header.js"></script>
</body>
</html>