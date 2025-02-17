<?php
  require("functions.php");
  session_start();
  // print_r($_SESSION);
  // print_user_courses($_SESSION['user_name']);
?>

<?php
  if(isset($_POST['upload'])){

    $correct_user_photo = "";
    $photo_name = "";

    if(check_user_photo($correct_user_photo, $_SESSION['user_name'], $photo_name)){
      if(add_photo_to_database($photo_name, $_SESSION['user_name'])){
        $_SESSION['photo'] = $photo_name;
      }
    }
  }
?>

<?php
  if(isset($_POST['delete'])){
    delete_user_account($_SESSION['user_name']);
    session_destroy();
    header("location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Courses</title>
  <link rel="icon" href="imgs/favicon.ico" type="image/icon">
  <!-- css files -->
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/profile2.css?v=<?php echo time(); ?>">
  <!-- <link rel="stylesheet" href="css/login.css"> -->
  <!-- <link rel="stylesheet" href="css/profile.css"> -->
  <!-- font awesome css files -->
  <link rel="stylesheet" href="css/all.css">
  <!-- js files -->
  <!-- <script src="js/fuctions.js"></script> -->
  <script src="js/fuctions.js?v=<?php echo time(); ?>"></script>
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- start delete the account -->
  <div class="delete-account" id="delete-account">
    <form action="profile2.php" method="post">
      <div>Do you want to delete your account?</div>
      <div>
        <input type="submit" name="delete" value="delete">
        <input type="button" value="no" onclick="hide_delete_account()">
      </div>
    </form>
  </div>
  <!-- end delete the account -->
  <header>
    <div class="container">
      <img src="imgs/logo.jpeg" alt="logo">
      <div class="main-buttons">
        <a href="index.php">Home</a>
        <a href="related_pages/courses.php">Courses</a>
      </div>
      <form>
        <input type="search" placeholder="What do you want to learn?">
        <i class="fa-solid fa-magnifying-glass"></i>
      </form>
      <div class="user-profile" style="display: none;">
        <div><?php echo $_SESSION['name']; ?></div>
        <a href="#"><img src="users_photoes/null.png" alt="img"></a>
      </div>
      <div class="secondary-buttons">
        <a href="index.php">Home</a>
        <a href="index.php?logout=logout">Log out</a>
      </div>
      <nav  onmouseover="hover_bars()" onmouseout="un_hover_bars()" id="header_nav">
        <i class="fa-duotone fa-solid fa-bars" id="header_bars"></i>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="related_pages/courses.php">Courses</a></li>
          <li><a href="index.php?logout=logout">Log out</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="main">

    <!-- color section -->
    <div class="color">
      <div class="imgae-and-name">
        <div class="image"><img src="users_photoes/<?php if(isset($_SESSION['photo'])){echo $_SESSION['photo'];}else{echo "null.png";} ?>" alt="img"><span></span></div>
        <div class="name"><?php echo $_SESSION['full_name'] ?></div>
      </div>
    </div>
    <!-- color section -->
    <!-- detailes section -->
    <div class="courses">
      <div class="container">
        <!-- <h3>Your Courses:</h3> -->
        <div class="main-heading-style">Your Courses :</div>
        <div class="cards-container">
          <?php
            print_user_courses($_SESSION['user_name']);
          ?>
        </div>
      </div>
    </div>
    <!-- detailes section -->
    <!-- footer -->
    <div class="footer">
      <div class="container">
        <div class="email">
          <span>email :&nbsp;</span><span><?php echo $_SESSION['email']; ?></span>
        </div>
        <?php 
          if(isset($_POST['upload'])){
            echo "<div class ='correct-input'>$correct_user_photo</div>";
          }
        ?>
        <form class="profile-picture" action="profile2.php" method="post" enctype="multipart/form-data">
          <label for="file">choose your photo</label>
          <input type="file" id="file" name="user_photo">
          <input type="submit" name="upload" value="upload">
        </form>
        <form class="edit-profile" action="check_password.php" method="post">
          <input type="submit" name="edit_profile" value="edit profile">
        </form>
        <!-- <input type="button" value="delete account" onclick="view_ddddelete_account()"> -->
        <button onclick="view_delete_account()" type="button">delete account</button>
      </div>
    </div>
    <!-- footer -->
  </div>

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