<?php
  require("functions.php");
  session_start();
  // print_r($_SESSION);
?>

<?php
  if(!isset($_GET['teacher_id'])) header("location: index.php");

    $teacher_id = $_GET['teacher_id'];
    $teacher_name = $_GET['teacher_name'];
    $teacher_email = $_GET['teacher_email'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Courses</title>
  <link rel="icon" href="imgs/favicon.ico" type="image/icon">
  <!-- css files -->
  <link rel="stylesheet" href="css/master.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/courses.css?v=<?php echo time(); ?>">
  <?php
    if(isset($_GET['admin'])){
      echo "<link rel='stylesheet' href='css/login.css'>";
    }
  ?>
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
.teacher-name{
  font-size: 30px;
  margin-bottom: 10px;
}
.teacher-email{
  padding: 0px 0 0 10px;
}
</style>

<body>
<header>
  <div class="container">
    <img src="imgs/logo.jpeg" alt="logo">
    <div class="main-buttons">
      <a href="index.php">Home</a>
      <a href="related_pages/courses.php">Courses</a>
    </div>
    <form action="related_pages/courses.php" method="post">
        <input type="search" placeholder="What do you want to learn?" name="search">
      <i class="fa-solid fa-magnifying-glass"></i>
    </form>
    <div class="user-profile" <?php if(isset($_SESSION['user_name'])){ echo "style='display: flex;'"; }else {echo "style='display: none;'";} ?>>
    <!-- <div class="user-profile"> -->
      <div><?php echo $_SESSION['name']; ?></div>
      <a href="profile2.php"><img src="users_photoes/<?php if(isset($_SESSION['photo'])){echo $_SESSION['photo'];}else{echo "null.png";} ?>" alt="img"></a>
    </div>
    <!-- <div class="secondary-buttons"> -->
    <div class="secondary-buttons" <?php if(isset($_SESSION['user_name'])){ echo "style='display: none;'"; } ?>>
      <a href="related_pages/login.php">log in</a>
      <a href="related_pages/signup.php">sign up</a>
    </div>
    <nav  onmouseover="hover_bars()" onmouseout="un_hover_bars()" id="header_nav">
      <i class="fa-duotone fa-solid fa-bars" id="header_bars"></i>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="related_pages/courses.php">Courses</a></li>
        <?php 
          if(!isset($_SESSION['user_name'])){
            echo "<li><a href='related_pages/login.php'>log in</a></li>";
          }
        ?>
        <?php 
          if(!isset($_SESSION['user_name'])){
            echo "<li><a href='related_pages/signup.php'>sign up</a></li>";
          }
        ?>
        <?php 
          if(isset($_SESSION['user_name'])){
            echo "<li><a href='profile2.php'>view profile</a></li>";
          }
        ?>
      </ul>
    </nav>
  </div>
</header>
<main>



  <div class="teacher_info" style="margin: 100px 0;padding: 0 20px;">
    <div class="container">
      <div class="teacher-name">Teacher name : <b><?php echo $teacher_name; ?></b></div>
      <div class="teacher-email">email : <span><?php echo $teacher_email; ?></span></div>
    </div>
  </div>


  <!-- <div class="courses"> -->
      <div class="container">
        <!-- <h3>Your Courses:</h3> -->
        <!-- <div class="main-heading-style">Teacher courses :</div> -->
        <div class="cards-container">
          <?php
            // print_user_courses($_SESSION['user_name']);
            print_teacher_courses($teacher_id);
          ?>
        </div>
      </div>
    <!-- </div> -->

  </main>
  <footer>
    <div class="container">
      <hr <?php if(isset($_GET['admin'])){echo "style='display: none;'";} ?>>
      <div class="logo" <?php if(isset($_GET['admin'])){echo "style='display: none;'";} ?> ><img src="imgs/logo.jpeg" alt="logo"></div>
      <div class="links-container" <?php if(isset($_GET['admin'])){echo "style='display: none;'";} ?>>
        <div class="our-goal">
          <h3>Our Goal</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div class="explore-subjects">
          <h3>Explore Subjects</h3>
          <ul>
            <li><a href="#">Programming</a></li>
            <li><a href="#">Mathematics</a></li>
            <li><a href="#">High School Subjects</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Game Development</a></li>
            <li><a href="#">Machine Learning</a></li>
            <li><a href="#">Mobile Development</a></li>
          </ul>
        </div>
        <div class="company">
          <h3>Company</h3>
          <ul>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">About Us</a></li>
          </ul>
        </div>
      </div>
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