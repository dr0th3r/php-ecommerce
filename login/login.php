<?php
  session_start();
  include_once("./connection.php");
  
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (!empty($email) && !empty($password)) {
    $query = "select * from user where email = '$email' limit 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      if ($user_data['password'] === $password) {
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['permission'] = $user_data['permission_level'];

        header("Location: index.php");
        die;
      }
    }
  }
?>