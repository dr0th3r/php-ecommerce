<?php
  session_start();

  include_once("../config/db.php");

  if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    echo "Failed to connect!";
    die();
  }

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!isset($name) || !isset($email) || !isset($password)) {
    echo "Name, email or password not provided!";
    die;
  }

  $query = "insert into user (name, email, password, permission_level) values ('$name', '$email', '$password', 'user')";

  $respone = mysqli_query($con, $query);

  if ($respone && $user_id = mysqli_insert_id($con)) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['permission'] = 'user';
    $_SESSION['name'] = $name;

    header("Location: ../index.php");
  } else {
    echo "Failed to create user!";
  }
?>