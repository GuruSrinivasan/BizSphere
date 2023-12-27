<?php

session_start();  
include("server/connection.php");
if(isset($_SESSION['logged_in'])){
  header("location:account.php");
  exit;
}
if(isset($_POST['login_btn'])){
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $stmt=$conn->prepare('SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1');
  $stmt->bind_param('ss', $email, $password);
  if($stmt->execute()){
    $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
    $stmt->store_result();
    if($stmt->num_rows == 1){
      $stmt->fetch();
      $_SESSION['user_id']=$user_id;
      $_SESSION['user_name']=$user_name;
      $_SESSION['user_email']=$user_email;
      $_SESSION['logged_in']=true;
      header('location:account.php?login_success=Logged in successfully');

    }else{
      header('location:login.php?error=Could not verify your account');
    }
  }else{
    header('location:login.php?error=Something went wrong');
  }
}


?>








<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-white py-3 fixed-top">
    <div class="container">
      <img class="logo" src="assets/imgs/logo.png" alt="">
      <h2 class="brand">Orange</h2>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="cart.php"><i class="fas fa-solid fa-shopping-bag"></i></a>
            <a href="account.php"><i class="fas fa-solid fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


<!-- login -->
  <section id="loginForm" class="my-5 py-5">
    <div class="container text-center mt-3 pt-3">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="max-auto container">
        <form id="login-form" method="POST" action="login.php">
          <p class="text-center" style="color:red;"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login">
            </div>
            <div class="form-group">
                <a id="register-url" class="btn" href="register.php">Don't have an account? Register</a>
            </div>

        </form>
    </div>
  </section>










  <?php include('layouts/footer.php');?>