<?php
  require("functions.php");
  // session_start();
?>

<?php
  if(isset($_POST['submit'])){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $correct_user_name_password = "";

    if(does_admin_exist($user_name, $password, $correct_user_name_password)){
      header("location: accept_reject_courses.php?admin=admin");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Courses</title>
  <!-- css files -->
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/login.css">
  <!-- font awesome css files -->
  <link rel="stylesheet" href="css/all.css">
  <!-- js files -->
  <script src="js/fuctions.js"></script>
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>

<style>
</style>

<body>
  
  <header>
    <div class="container">
      <img src="imgs/logo.jpeg" alt="logo">
      <div class="main-buttons">
        <a href="../index.php">Home</a>
        <a href="related_pages/courses.php">Courses</a>
      </div>
      <form>
        <input type="search" placeholder="What do you want to learn?">
        <i class="fa-solid fa-magnifying-glass"></i>
      </form>
      <div class="secondary-buttons">
        <a href="login.php">log in</a>
        <a href="signup.php  ">sign up</a>
      </div>
      <nav  onmouseover="hover_bars()" onmouseout="un_hover_bars()" id="header_nav">
        <i class="fa-duotone fa-solid fa-bars" id="header_bars"></i>
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="courses.php">Courses</a></li>
          <li><a href="login.php">log in</a></li>
          <li><a href="signup.php">sign up</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <form action="admin_log_in.php" method="post">
      <h2>admin login</h2>
      <div class="input-container">
        <label for="user_name">Username</label>
        <input type="text" id="user_name" placeholder="username" required name="user_name" value="<?php if(isset($_POST['submit'])){echo $user_name;}?>">
      </div>
      <div class="input-container">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="type a complex password" required name="password" value="<?php if(isset($_POST['submit'])){echo $password;}?>">
        <?php 
          if(isset($_POST['submit'])){
            echo "<div class ='correct-input'>$correct_user_name_password</div>";
          }
        ?>
      </div>
      <input type="submit" value="Log in" name="submit">
    </form>
  </main>


  <footer>
    <div class="container">
      <hr>
      <div class="copy-right-and-socail-media">
        <div class="copy-right">&copy; 2025 Online Courses</div>
        <ul>
          <li><a href="#"><i class="fa-brands fa-square-github"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-square-instagram"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-square-facebook"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-square-x-twitter"></i></a></li>
          <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
        </ul>
      </div>
    </div>
  </footer>
</body>
</html>