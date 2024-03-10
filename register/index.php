<?php
  session_start();

  include_once("../login/connection.php");

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
  <form class="login-form" action="./create_user.php", method="POST">
    <h2 class="login-title">Register</h2>
    <input placeholder="Name" type="text" class="login-input" name="name" required/>
    <input placeholder="Email" type="email" class="login-input" name="email" required/>
    <input placeholder="Password" type="password" class="login-input" name="password" required/>
    <button type="submit" class="login-submit">Register</button>
    <span>Already have an account?
      <a href="../login">Login</a>
    </span>
  </form>
</body>
</html>