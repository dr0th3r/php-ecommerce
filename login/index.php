<?php
  session_start();

  include_once("./connection.php");

  if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $query = "select * from user where id = '$id' limit 1";

    $res = mysqli_query($con, $query);
    if ($res && mysqli_num_rows($res) > 0) {
      header("Location: ../index.php");
      die;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../static/login.css">
  <link rel="stylesheet" href="../static/style.css">
</head>
<body>
  <form class="login-form" action="login.php", method="POST">
    <h2 class="login-title">Login</h2>
    <input placeholder="Email" type="email" class="login-input" name="email"/>
    <input placeholder="Password" type="password" class="login-input" name="password"/>
    <button type="submit" class="login-submit">Login</button>
  </form>
</body>
</html>