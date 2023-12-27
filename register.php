<?php 
session_start();
if(isset($_SESSION['logged_in'])){
  header("location:account.php");
  exit;
}
include("server/connection.php");
if(isset($_POST['register'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $confirm_password=$_POST['confirmPassword'];

  if($password != $confirm_password){
    header('location:register.php?error= password dont match ');
  }
  else if(strlen($password)<8 && strlen($confirm_password)< 8){
    header('location:register.php?error= password must be at least 8 characters ');
  }

  else{
  $stmt1=$conn->prepare('SELECT COUNT(*) FROM users WHERE user_email= ? ');
  $stmt1->bind_param('s', $email);
  $stmt1->execute();
  $stmt1->bind_result($num_rows);
  $stmt1->store_result();
  $stmt1->fetch();
  if($num_rows !== 0){
    header('location:register.php?error=user with this email already exists');
  }
  else{
    $stmt=$conn->prepare("INSERT INTO users(user_name,user_email,user_password)
                  VALUES (?,?,?)");
    $stmt->bind_param('sss',$name,$email,md5($password));
    if($stmt->execute()){
      $user_id=$stmt->insert_id;
      $_SESSION['user_id']=$user_id;
      $_SESSION['user_email']=$email;
      $_SESSION['user_name']=$name;
      $_SESSION['logged_in']=true;
      header('location:account.php?register_success=You are registered successfully');
    }
    else{
      header('location:register.php?error=could not create an account at this moment');
    }
  }


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
<!-- Register -->
  <section id="registerForm" class="my-5 py-5">
    <div class="container text-center mt-3 pt-3">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>
    <div class="max-auto container">
        <form id="register-form" method="POST" action="register.php">
            <p style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="email" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required>
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" name="register" id="register-btn" value="Register">
            </div>
            <div class="form-group">
                <a id="login-url" href="login.php" class="btn">Do You have an account? Login</a>
            </div>

        </form>
    </div>
  </section>










  <?php include('layouts/footer.php');?>