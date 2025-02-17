<?php
  require("functions.php");
  session_start();
  // print_r($_SESSION);
?>

<?php
  if(!isset($_GET['course_id'])) header("location: index.php");

    $teacher_id = get_teacher_id_from_temporary_database($_GET['course_id']);
    $teacher_name = get_teacher_name_from_database($teacher_id);
    $teacher_email = get_teacher_email_from_database($teacher_id);

    $course_id[] = $_GET['course_id'];

    $course_info = get_all_info_about_these_temporary_courses($course_id);

    // print_r($course_info);
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
  .course-presenter a{
    color: black;
  }
  .course-presenter a:hover{
    color: red;
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




  <div class="course_info" style="margin: 130px 0;padding: 0 20px;">
    <div class="container">
      <div class="course-title"><b>Course titel : </b><?php echo $course_info[0]['course_title'] ;?></div><br>
      <div class="course-presenter"><b>Presented by : </b><a href="teacher_view.php?teacher_id=<?php echo $teacher_id; ?>&teacher_name=<?php echo $teacher_name; ?>&teacher_email=<?php echo $teacher_email; ?>&admin=admin"><?php echo $teacher_name; ?></a></div><br>
      <div class="number-of-lectures"><b>Lectures : </b><?php echo $course_info[0]['number_of_lectures'] ;?> lecture</div><br>
      <div class="number-of-hours"><b>Hours : </b><?php echo $course_info[0]['number_of_hours'] ;?> hr</div><br>
      <div class="number-of-enrollment"><b>Number of enrollment : </b><?php echo $course_info[0]['number_of_enrollment'] ;?></div><br>
      <div class="course-description"><b>Description : </b><?php echo $course_info[0]['description'] ;?></div><br>
      <div class="course-catigory"><b>Catigory : </b><?php echo $course_info[0]['category'] ;?></div><br>
    </div>
  </div>


  <footer>
    <div class="container">
      <!-- <hr>
      <div class="logo"><img src="imgs/logo.jpeg" alt="logo"></div>
      <div class="links-container">
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
      </div> -->
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