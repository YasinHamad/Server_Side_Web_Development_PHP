<?php
  require("functions.php");
  if(!isset($_GET['admin']) && !isset($_GET['publish']) && !isset($_GET['delete'])) header("location: admin_log_in.php");
?>

<?php
  if(isset($_GET['publish'])){
    // echo "publish";
    publish_this_course($_GET['publish']);
    header("location: accept_reject_courses.php?admin=admin");
    // echo $_GET['email'];
    // mail($_GET['email'], 'subject', "message");
  }
  if(isset($_GET['delete'])){
    // echo "delete";
    delete_this_course_from_temporary_table($_GET["delete"]);
    header("location: accept_reject_courses.php?admin=admin");
    // echo $_GET['email'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Courses</title>
  <!-- css files -->
  <link rel="stylesheet" href="css/master.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/courses.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
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
.cards-container .card {
    margin-right: 0;
    margin-bottom: 25px;
}
.teacher-email {
  margin: 5px 0;
}
.accept-or-reject-buttons a{
  background-color: black;
  color: white;
  padding: 5px 10px;
  display: inline-block;
  text-decoration: none;
}
.accept-or-reject-container {
  margin-bottom: 20px;
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
  <div class="container">
      <div class="cards-container">
        <?php
          print_temporary_courses();
        ?>
      </div>
    </div>
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