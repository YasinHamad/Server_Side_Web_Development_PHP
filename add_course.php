<?php
  require("functions.php");
  session_start();
?>

<?php
  if(isset($_POST['submit'])){
    $course_full_name = $_POST['course_full_name'];
    $number_of_lectures = $_POST['number_of_lectures'];
    $number_of_hours = $_POST['number_of_hours'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $user_file = "";
    
    $correct_course_full_name = "";
    $correct_number_of_lectures = "";
    $correct_number_of_hours = "";
    $correct_category = "";
    $correct_description = "";
    $correct_user_file = "";
    
    if(check_course_full_name($course_full_name, $correct_course_full_name)){
      if(check_number_of_lecuters($number_of_lectures, $correct_number_of_lectures)){
        if(check_number_of_hours($number_of_hours, $correct_number_of_hours)){
          if(check_category($category, $correct_category)){
            if(check_description($description, $correct_description)){
              if(check_course_cover($correct_user_file, $user_file)){
                $teacher_email = $_SESSION['teacher_email'];
                $teacher_id = get_teacher_id($_SESSION['teacher_user_name']);
                add_course_to_database_temporary($course_full_name, $number_of_lectures, $number_of_hours ,$category , $description, $user_file, $teacher_email, $teacher_id);
                header("location: related_pages/courses.php");
              }
            }
          }
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
  <title>Online Courses</title>
  <!-- css files -->
  <link rel="stylesheet" href="css/master.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/login.css">
  <!-- font awesome css files -->
  <link rel="stylesheet" href="css/all.css">
  <!-- js files -->
  <script src="js/fuctions.js?v=<?php echo time(); ?>"></script>
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>

<style>
  textarea {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid var(--main-color);
    width: 100%;
    height: 130px;
  }
  input[type='file'] {
    all: initial;
  }
  form .cancel{
    background-color: var(--main-color);
    color: white;
    width: 100%;
    display: block;
    padding: 15px;
    margin: -20px 0 0px;
    font-size: 18px;
    font-weight: bold;
    border-radius: 25px;
    transition: var(--main-transition);
    text-align: center;
    border: 1px solid var(--main-color);
  }
  form .cancel:hover {
    background-color: black;
    color: white;
    text-decoration: none;
  }
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
    <form action="add_course.php" method="post" enctype="multipart/form-data">
      <h2>add course</h2>
      <div class="input-container">
        <label for="Course_full_name">Course full name</label>
        <input type="text" id="Course_full_name" placeholder="course full name" required name="course_full_name" value="<?php if(isset($_POST['submit'])){echo $_POST['course_full_name'];} ?>">
        <?php 
          if(isset($_POST['submit'])){
            echo "<div class ='correct-input'>$correct_course_full_name</div>";
          }
        ?>
      </div>
      <div class="input-container">
        <label for="number_of_lectures">Number of lectures</label>
        <input type="number" min="0" id="number_of_lectures" placeholder="number of lectures" required name="number_of_lectures" value="<?php if(isset($_POST['submit'])){echo $_POST['number_of_lectures'];} ?>">
        <?php 
          if(isset($_POST['submit'])){
            echo "<div class ='correct-input'>$correct_number_of_lectures</div>";
          }
        ?>
      </div>
      <div class="input-container">
        <label for="number_of_hours">Number of hours</label>
        <input type="number" min="0" id="number_of_hours" placeholder="number of hours" required name="number_of_hours" value="<?php if(isset($_POST['submit'])){echo $_POST['number_of_hours'];} ?>">
        <?php 
          if(isset($_POST['submit'])){
            echo "<div class ='correct-input'>$correct_number_of_hours</div>";
          }
        ?>
      </div>
      <div class="input-container">
        <label for="category">Category</label>
        <input type="text" id="category" placeholder="type here" required name="category" value="<?php if(isset($_POST['submit'])){echo $_POST['category'];} ?>">
        <?php 
          if(isset($_POST['submit'])){
            echo "<div class ='correct-input'>$correct_category</div>";
          }
        ?>
      </div>
      <div class="input-container">
        <label for="description">Description</label>
        <textarea name="description" id="description" placeholder="text should be less than 255 chars"><?php if(isset($_POST['submit'])){echo $_POST['description'];} ?></textarea>
        <?php 
          if(isset($_POST['submit'])){
            echo "<div class ='correct-input'>$correct_description</div>";
          }
          ?>
      </div>
      <div class="input-container">
        <label for="user_file">Course cover</label>
        <input type="file" id="user_file" required name="user_file">
        <?php 
          if(isset($_POST['submit'])){
            echo "<div class ='correct-input'>$correct_user_file</div>";
          }
        ?>
      </div>
      <input type="submit" value="Publish" name="submit">
      <a href="index.php" class="cancel">Cancel</a>
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