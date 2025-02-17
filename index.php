<?php
  require("functions.php");
  session_start();
  // print_r($_SESSION);
  // print_r($_POST);
  // echo "here";
  // echo are_there_courses_in_the_database();
  ?>

<?php
  if(isset($_GET['logout'])){
    session_unset();
    // print_r($_SESSION);
    header("location; index.php");
  }
?>

<?php
  if(are_there_courses_in_the_database()){
    $most_eight_popular_courses_ids = get_most_eight_popular_courses_ids_and_put_them_in_a_normal_array();
    $most_eight_popular_courses_ids = get_all_info_about_these_courses($most_eight_popular_courses_ids);
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
  <link rel="stylesheet" href="css/master.css?v=<?php echo time(); ?>">
  <!-- font awesome css files -->
  <link rel="stylesheet" href="css/all.css">
  <!-- js files -->
  <script src="js/fuctions.js"></script>
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>
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
        <!-- <input type="submit" value="submit" name='submit' style='display: none;'> -->
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
    <section class="hello-section">
      <div class="hello-paragraph-container">
        <div class="hello-paragraph">
          <h2>Learn and Grow</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nisi perspiciatis odio totam eligendi, 
            error officiis quae atque hic velit ea nulla doloribus numquam veniam ad tempora. Ratione, ex id.</p>
            <a href="">Explore</a>
        </div>
      </div>
    </section>

    <section class="most-popular-courses-section">
      <div class="container">
        <div class="main-heading-style">Most Popular Courses</div>
        <div class="cards-container">
          <!-- we need to use regular expression -->
          <i class="fa-solid fa-arrow-right" onclick="move_cards_container_to_the_left()" id="move_cards_container_to_the_left"></i>
          <i class="fa-solid fa-arrow-left" onclick="move_cards_container_to_the_right()" id="move_cards_container_to_the_right"></i>
          <div class="moving-container" id="moving-container">
            <?php
              if(are_there_courses_in_the_database()){
                print_the_most_popular_courses($most_eight_popular_courses_ids);
              }
            ?>
          </div>
        </div>
      </div>
    </section>

    <section class="trusted-by-section">
      <div class="container">
        <p>Trusted by over 15,000 companies and millions of learners around the world</p>
        <ul>
          <li><img src="imgs/we_work_with_imgs/ebay-189065_1280.png" alt="img"></li>
          <li><img src="imgs/we_work_with_imgs/facebook-76534_1280.png" alt="img"></li>
          <li><img src="imgs/we_work_with_imgs/google-1015751_1280.png" alt="img"></li>
          <li><img src="imgs/we_work_with_imgs/j1o36h91.png" alt="img"></li>
          <li><img src="imgs/we_work_with_imgs/microsoft-80658_1280.png" alt="img"></li>
          <li><img src="imgs/we_work_with_imgs/v5j6j6jb.png" alt="img"></li>
          <li><img src="imgs/we_work_with_imgs/yahoo-76684_1280.png" alt="img"></li>
        </ul>
        </div>
    </section>

    <section class="who-we-are-section">
      <div class="container">
        <div class="main-heading-style">Who Are We?</div>
        <div class="persons">
          <div class="person">
            <div class="img"><img src="imgs/people-photoes/user-05.png" alt="photo"></div>
            <p class="name">Carlos Rodriguez</p>
            <hr>
            <p class="info">A 28-year-old mobile developer who teaches iOS development at a coding bootcamp in Miami. He loves building engaging and interactive apps using Swift, 
              Firebase, and SwiftUI. He also loves dancing, cooking, and learning new languages.</p>
          </div>
          <div class="person">
            <div class="img"><img src="imgs/people-photoes/user-05.png" alt="photo"></div>
            <p class="name">Carlos Rodriguez</p>
            <hr>
            <p class="info">A 28-year-old mobile developer who teaches iOS development at a coding bootcamp in Miami. He loves building engaging and interactive apps using Swift, 
              Firebase, and SwiftUI. He also loves dancing, cooking, and learning new languages.</p>
          </div>
          <div class="person">
            <div class="img"><img src="imgs/people-photoes/user-05.png" alt="photo"></div>
            <p class="name">Carlos Rodriguez</p>
            <hr>
            <p class="info">A 28-year-old mobile developer who teaches iOS development at a coding bootcamp in Miami. He loves building engaging and interactive apps using Swift, 
              Firebase, and SwiftUI. He also loves dancing, cooking, and learning new languages.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="what-people-said-about-us-section">
      <div class="container">
        <div class="main-heading-style">What People Say About Our Courses</div>
        <div class="comments-container">
          <div class="comment">
            <div class="person">
              <img src="imgs/people-photoes/user.png" alt="comment">
              <div class="name">user name</div>
            </div>
            <p class="comment-info">Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
              Similique nobis numquam est error consequuntur obcaecati corrupti quasi optio.</p>
          </div>
          <div class="comment">
            <div class="person">
              <img src="imgs/people-photoes/user.png" alt="comment">
              <div class="name">user name</div>
            </div>
            <p class="comment-info">Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
              Similique nobis numquam est error consequuntur obcaecati corrupti quasi optio.</p>
          </div>
          <div class="comment">
            <div class="person">
              <img src="imgs/people-photoes/user.png" alt="comment">
              <div class="name">user name</div>
            </div>
            <p class="comment-info">Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
              Similique nobis numquam est error consequuntur obcaecati corrupti quasi optio.</p>
          </div>
          <div class="comment">
            <div class="person">
              <img src="imgs/people-photoes/user.png" alt="comment">
              <div class="name">user name</div>
            </div>
            <p class="comment-info">Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
              Similique nobis numquam est error consequuntur obcaecati corrupti quasi optio.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="quote-section">
      <div class="quote">
        <q> The more that you read,
          the more things you will know.
          The more that you learn,
          the more places you will go.</q>
        <p>-Dr. Seuss</p>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <hr>
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
            <li><a href="log_in_as_teacher.php">Add Course</a></li>
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