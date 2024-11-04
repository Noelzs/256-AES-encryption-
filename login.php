<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
      body{
        background-image: url("images/bg.png");
      }
      </style>
</head>
<body>
  <div class="wrapper">
    <form method="post" action="login.php">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" placeholder="Username" name="username"required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password"required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <!-- <a href="#">Forgot Password</a> -->
      </div>
      <input type="submit" value="Login" class="loginBtn" name="login_Btn">
      <div class="register-link">
        <p>Dont have an account? <a href="register.php">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","");
if(isset($_POST['login_Btn'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  if($username==="admin" && $password==="admin" ){
    echo "<script>alert('Welcome Administrator!');window.location.href='admin.html';</script>";
  }
  $sql="SELECT * FROM websitelogin.logindetails where username='$username'"; 
  // WHERE username='$username'";
  $result=mysqli_query($conn,$sql);
  while($row= mysqli_fetch_assoc($result)){
    $resultPassword=$row['password'];
    $resultUsername=$row['username'];
    if($username==$resultUsername &&  $password==$resultPassword){
      // header("Location:Home.html");
      echo "<script>alert('Welcome $resultUsername');window.location.href='Home.html';</script>";
    }
    else{
      echo"<script>alert('Username or Password is incorrect! Please try again.');</script>";
      return false;
    }
  }

}
?>