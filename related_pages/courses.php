<?php
  require("../functions.php");
  session_start();

  // session_unset();
  // print_r($_SESSION);
  // if(!isset($_SESSION['user_name'])) header("location: ../index.php");

  if(are_there_courses_in_the_database()){
    $courses_ids = get_all_courses_ids_from_database();
  
    $courses_ids_array = convert_table_of_ids_to_normal_array($courses_ids);
    $all_info_about_courses = get_all_info_about_these_courses($courses_ids_array);
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Courses</title>
  <!-- css files -->
  <link rel="stylesheet" href="../css/master.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/courses.css">
  <!-- font awesome css files -->
  <link rel="stylesheet" href="../css/all.css">
  <!-- js files -->
  <script src="../js/fuctions.js?v=<?php echo time(); ?>"></script>
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="container">
      <img src="../imgs/logo.jpeg" alt="logo">
      <div class="main-buttons">
        <a href="../index.php">Home</a>
        <a href="courses.php">Courses</a>
      </div>
      <form action="courses.php" method="post">
        <input type="search" placeholder="What do you want to learn?" name="search">
        <i class="fa-solid fa-magnifying-glass"></i>
      </form>
      <div class="user-profile" <?php if(isset($_SESSION['user_name'])){ echo "style='display: flex;'"; }else {echo "style='display: none;'";} ?>>
      <!-- <div class="user-profile"> -->
        <div><?php echo $_SESSION['name']; ?></div>
        <a href="../profile2.php"><img src="../users_photoes/<?php if(isset($_SESSION['photo'])){echo $_SESSION['photo'];}else{echo "null.png";} ?>" alt="img"></a>
      </div>
      <!-- <div class="secondary-buttons"> -->
      <div class="secondary-buttons" <?php if(isset($_SESSION['user_name'])){ echo "style='display: none;'"; } ?>>
        <a href="login.php">log in</a>
        <a href="signup.php">sign up</a>
      </div>
      <nav  onmouseover="hover_bars()" onmouseout="un_hover_bars()" id="header_nav">
        <i class="fa-duotone fa-solid fa-bars" id="header_bars"></i>
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="courses.php">Courses</a></li>
          <?php 
            if(!isset($_SESSION['user_name'])){
              echo "<li><a href='login.php'>log in</a></li>";
            }
          ?>
          <?php 
            if(!isset($_SESSION['user_name'])){
              echo "<li><a href='signup.php'>sign up</a></li>";
            }
          ?>
          <?php 
            if(isset($_SESSION['user_name'])){
              echo "<li><a href='../profile2.php'>view profile</a></li>";
            }
          ?>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <div class="filter-courses">
      <div class="container">
        <div class="filter-courses-moving-container">
          <ul>
            <li class="selected">All</li>
            <li>Mathematics</li>
            <li>High School Subjects</li>
            <li>Machine Learning</li>
            <li>Web Development</li>
            <li>Game Development</li>
            <li>UI/UX</li>
          </ul>
          <select>
            <option value="">All</option>
            <option value="">Mathematics</option>
            <option value="">High School Subjects</option>
            <option value="">Machine Learning</option>
            <option value="">Web Development</option>
            <option value="">Game Development</option>
            <option value="">UI/UX</option>
          </select>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="cards-container">
        <?php
          if(are_there_courses_in_the_database()){
            if(isset($_POST['search'])){
              $search = $_POST['search'];
              // print_r($_POST);
              // print_r(user_sentence_in_separate_words($search)) ;
              // print_r(get_all_words_of_these_courses($courses_ids_array));
              $results = get_search_results(user_sentence_in_separate_words($search), get_all_words_of_these_courses($courses_ids_array));
              if($results != null){
                // print_r($results);
                $all_info_about_search_results = get_all_info_about_these_courses($results);
                // print_r($all_info_about_search_results);
                print_these_courses($all_info_about_search_results);
              }
            }else{
              print_these_courses($all_info_about_courses);
            }
          }
        ?>
      </div>
    </div>
  </main>


  <footer>
    <div class="container">
      <hr>
      <div class="logo"><img src="../imgs/logo.jpeg" alt="logo"></div>
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
            <li><a href="../log_in_as_teacher.php">Add Course</a></li>
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