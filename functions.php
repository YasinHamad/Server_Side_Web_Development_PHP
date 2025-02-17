<?php
/* start signup page functions */
//I will put any notes for the user in the variable
function check_full_name(&$full_name, &$correct_full_name){
  $full_name = trim($full_name);

  if(!preg_match("`^[[:alpha:]]+ [[:alpha:]]+( [[:alpha:]]+){0,2}$`", $full_name)){
    $correct_full_name = "*write you full name, example: Yasin Hamad";
    return false;
  }
  return true;
}

//if the username exists in the data base return false
function check_user_name(&$user_name, &$correct_user_name){
  $user_name = trim($user_name);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select users.user_name from users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  if(count($results) != 0){
    $correct_user_name = "*Choose another username please";
    return false;
  }
  return true;
}

function check_email(&$email, &$correct_email){
  $email = trim($email);

  //we took this pattern in our course
  if(!preg_match("`^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-_.]?[[:alnum:]])*\.([a-z]{2,4})$`", $email)){
    $correct_email = "*Type a correct email please";
    return false;
  }
  return true;
}

function check_password(&$password, &$correct_password){
  $password = trim($password);

  if(!preg_match("`.{5,}`", $password)){
    $correct_password = "*the password should be at least 5 characters";
    return false;
  }
  return true;
}

//get the first name from the full name
function get_first_name($full_name){
  $position = strpos($full_name, " ");
  $name = substr($full_name, 0, $position);
  return $name;
}

function add_user_to_database($full_name, $user_name, $user_password, $email){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "INSERT INTO Users (name, user_name, password, email) VALUES (?, ?, ?, ?)";

  $stat = $db->prepare($query);
  $stat->bind_param('ssss', $full_name, $user_name, $user_password, $email);
  $stat->execute();
  $stat->close();
}
/* end signup page functions */

/* start login page functions */
function does_user_exist(&$user_name, $user_password, &$correct_user_name_password){
  $user_name = trim($user_name);
  $user_password = trim($user_password);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select users.user_name from Users where users.user_name = ? && users.password = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('ss', $user_name, $user_password);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  if(count($results) == 0){
    $correct_user_name_password = "*username or password is incorrect";
    return false;
  }
  return true;
}

function get_user_first_name_form_database($user_name){
  $user_name = trim($user_name);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select users.name from Users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return get_first_name(trim($results[0]['name']));
}
function get_user_full_name_form_database($user_name){
  $user_name = trim($user_name);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select users.name from Users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return trim($results[0]['name']);
}
function get_user_photo_from_database($user_name){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "SELECT users.profile_picture_name from users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  $photo = trim($results[0]['profile_picture_name']);

  if($photo == "") return "";
  else return $photo;
}
function prepare_photo_in_session(){
  if($_SESSION['photo'] == "") unset($_SESSION['photo']);
  else {}
}
/* end login page functions */
function get_user_email_form_database($user_name){
  $user_name = trim($user_name);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select users.email from Users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return trim($results[0]['email']);
}
/* start porfile2 page functions */
function delete_prev_photo_if_exist($user_name){
  if(does_photo_exist($user_name)){
    get_photo_from_database_and_delete_it_from_the_folder($user_name);
  }
}
function check_user_photo(&$correct_user_photo, $user_name, &$photo_name){

  if(!isset($_FILES['user_photo'])){
    $correct_user_photo = "*you did not upload the photo";
    return false;
  }

  $image_info = getimagesize($_FILES['user_photo']['tmp_name']);

  if($image_info[0] != $image_info[1]){
    $correct_user_photo = "*the photo should be square";
    return false;
  }

  $target_file = "users_photoes\\".$user_name.".".pathinfo($_FILES['user_photo']['name'], PATHINFO_EXTENSION);
  
  delete_prev_photo_if_exist($user_name);

  if(move_uploaded_file($_FILES['user_photo']['tmp_name'], $target_file)){
    $photo_name = $user_name.".".pathinfo($_FILES['user_photo']['name'], PATHINFO_EXTENSION);
    return true;
  }else {
    $correct_user_photo = "*sorry you cann't upload the photo now";
    return false;
  }
}
function add_photo_to_database($photo_name, $user_name){

  $server = "localhost";
  $server_userName = "root";
  $server_password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $server_userName, $server_password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "UPDATE users set users.profile_picture_name = ? where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('ss', $photo_name, $user_name);
  $stat->execute();
  $stat->close();

  return true;
}
function get_photoes_names_in_a_normal_array(){
  $full_names = scandir("users_photoes");
  
  foreach($full_names as $name){
    if($name != "." && $name != ".."){
      $just_names[] = pathinfo(trim($name), PATHINFO_FILENAME);
    }
  }
  return $just_names;
}
function does_photo_exist($user_name){
  $photoes_names = get_photoes_names_in_a_normal_array();
  // print_r($photoes_names);

  foreach($photoes_names as $name){
    if($name == $user_name) return true;
  }
  return false;
}
function get_photo_from_database_and_delete_it_from_the_folder($user_name){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT users.profile_picture_name from users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  if(trim($results[0]['profile_picture_name']) != null){
    unlink("users_photoes/".trim($results[0]['profile_picture_name']));
  }

}
function delete_user_account($user_name){
  get_photo_from_database_and_delete_it_from_the_folder($user_name);
  // if(does_photo_exist($user_name)){
  //   get_photo_from_database_and_delete_it_from_the_folder($user_name);
  // }
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  $uers_id = get_user_id($user_name);

  $query = "DELETE FROM user_courses where user_courses.user_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $uers_id);
  $stat->execute();
  $stat->close();
  
  $query = "DELETE FROM users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $stat->close();
}
function get_user_courses($user_name){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT user_courses.course_id FROM user_courses where user_courses.user_id = ? ORDER by user_courses.enroll_data DESC";

  $user_id = get_user_id($user_name);

  $stat = $db->prepare($query);
  $stat->bind_param('i', $user_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return $results;
}
function does_user_have_courses($user_name){
  $courses = get_user_courses($user_name);
  if(count($courses) == 0) return false;
  return true;
}
function print_user_courses($user_name){
  if(!does_user_have_courses($user_name)) return;
  $all_info_about_courses = get_all_info_about_these_courses(convert_table_of_ids_to_normal_array(get_user_courses($user_name)));

  foreach($all_info_about_courses as $course){
    $teacher_id = get_teacher_id_from_database($course['course_id']);
    $teacher_name = get_teacher_name_from_database($teacher_id);
    echo "<a href="."course_view.php?course_id=".$course['course_id']." class='card'>";
    // echo "<a class='card'>";
    echo "<div class='card-image' style='background-image: url(imgs/cards_imgs/".$course['cover_picture_name'].");'></div>";
    echo "<div class='card-info'>";
      echo "<span class='course-title'>".$course['course_title']."</span>";
      echo "<div>";
        echo "<span>presented by : <span class='presenter'>$teacher_name</span></span><br>";
        echo "<span class='number-of-lectures'>".$course['number_of_lectures']." Lecture</span><br>";
        echo "<span class='number-of-hours'>".$course['number_of_hours']." Hours</span><br>";
      echo "</div>";
      echo "<span class='course-catigory'>".$course['category']."</span>";
    echo "</div>";
  echo "</a>";
  }
}
/* end porfile2 page functions */
/* start check password page functions */
function check_user_password($user_password, &$correct_password, $user_name){
  $server = "localhost";
  $server_userName = "root";
  $server_password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $server_userName, $server_password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select users.password from Users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  if(trim($results[0]['password']) == $user_password) return true;
  else {
    $correct_password = "*password is wrong";
    return false;
  }
}
/* end check password page functions */
/* start edit account page functions */
function check_new_user_name(&$user_name, &$correct_user_name, $old_user_name){
  $user_name = trim($user_name);
  
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "select users.user_name from users where users.user_name = ?";
  
  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  if(count($results) != 0){
    if(count($results) == 1 && ($results[0]['user_name'] != $old_user_name)){
      $correct_user_name = "*Choose another username please";
      return false;
    }
  }
  return true;
}
function edit_user_info($old_user_name, $full_name, $user_name, $password, $email) {

  $server = "localhost";
  $server_userName = "root";
  $server_password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $server_userName, $server_password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query1 = "UPDATE users set users.name = ? where users.user_name = ?";
  $query2 = "UPDATE users set users.password = ? where users.user_name = ?";
  $query3 = "UPDATE users set users.email = ? where users.user_name = ?";
  $query4 = "UPDATE users set users.user_name = ? where users.user_name = ?";

  $stat = $db->prepare($query1);
  $stat->bind_param('ss', $full_name, $old_user_name);
  $stat->execute();
  $stat->close();
  
  $stat = $db->prepare($query2);
  $stat->bind_param('ss', $password, $old_user_name);
  $stat->execute();
  $stat->close();

  $stat = $db->prepare($query3);
  $stat->bind_param('ss',  $email, $old_user_name);
  $stat->execute();
  $stat->close();

  $stat = $db->prepare($query4);
  $stat->bind_param('ss', $user_name, $old_user_name);
  $stat->execute();
  $stat->close();

}
/* end edit account page functions */
/* start courses page functions */
function get_all_courses_ids_from_database(){
  
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT courses.course_id from courses";
  
  $stat = $db->prepare($query);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return $results;
}
function convert_table_of_ids_to_normal_array($courses_ids){
  foreach($courses_ids as $value){
    $ids[] = $value['course_id'];
  }

  return $ids;
}
function print_these_courses($all_info_about_courses){

  foreach($all_info_about_courses as $course){
    $teacher_id = get_teacher_id_from_database($course['course_id']);
    $teacher_name = get_teacher_name_from_database($teacher_id);
    echo "<a href="."../course_view.php?course_id=".$course['course_id']." class='card'>";
    // echo "<a class='card'>";
    echo "<div class='card-image' style='background-image: url(../imgs/cards_imgs/".$course['cover_picture_name'].");'></div>";
    echo "<div class='card-info'>";
      echo "<span class='course-title'>".$course['course_title']."</span>";
      echo "<div>";
        echo "<span>presented by : <span class='presenter'>$teacher_name</span></span><br>";
        echo "<span class='number-of-lectures'>".$course['number_of_lectures']." Lecture</span><br>";
        echo "<span class='number-of-hours'>".$course['number_of_hours']." Hours</span><br>";
      echo "</div>";
      echo "<span class='course-catigory'>".$course['category']."</span>";
    echo "</div>";
  echo "</a>";
  }

}
function get_all_info_about_these_courses($courses_ids_array){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT * from courses where courses.course_id = ?";
  
  foreach($courses_ids_array as $id){
    $stat = $db->prepare($query);
    $stat->bind_param('i', $id);
    $stat->execute();
    $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    $all_info[] = $results[0];
    $stat->close();
  }
  return $all_info;
}
function user_sentence_in_separate_words(&$sentence){
  $sentence = trim($sentence);
  $sentence = strtolower($sentence);
  return explode(" ",$sentence);
}
function get_all_words_of_these_courses($courses_ids_array){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT courses.course_title, courses.category, courses.description from courses WHERE courses.course_id = ?";
  
  foreach($courses_ids_array as $id){
    $stat = $db->prepare($query);
    $stat->bind_param('i', $id);
    $stat->execute();
    $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    $stat->close();
    foreach(explode(" ", $results[0]['course_title']) as $word) $all_info[$id][] = strtolower(trim(str_replace(",", "", str_replace(".", "", str_replace("-", " ", $word)))));
    foreach(explode(" ", $results[0]['category']) as $word) $all_info[$id][] = strtolower(trim(str_replace(",", "", str_replace(".", "", str_replace("-", " ", $word)))));
    foreach(explode(" ", $results[0]['description']) as $word) $all_info[$id][] = strtolower(trim(str_replace(",", "", str_replace(".", "", str_replace("-", " ", $word)))));
  }
  return $all_info;
}
function get_search_results($user_words, $courses_words){
  foreach($courses_words as $id=>$course){
    $i = 0;
    foreach($course as $cw){
      foreach($user_words as $us){
        if($us == $cw) $i++;
      }
    }
    $results[$id] = $i;
  }
  foreach($results as $k=>$s){
    if($s == 0) unset($results[$k]);
  }
  arsort($results);

  if(count($results) == 0) return null; 

  foreach($results as $k=>$s) $courses[] = $k;

  return $courses;
}
function get_teacher_id_from_database($course_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT course_teachers.teacher_id from course_teachers where course_teachers.course_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $course_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return trim($results[0]['teacher_id']);
}
function get_teacher_name_from_database($teacher_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT teachers.name from teachers where teachers.teacher_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $teacher_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return trim($results[0]['name']);
}
/* end courses page functions */
/* start index page functions */
function get_most_eight_popular_courses_ids_and_put_them_in_a_normal_array(){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT courses.course_id from courses ORDER by courses.number_of_enrollment DESC LIMIT ?";
  
  $number = 8;

  $stat = $db->prepare($query);
  $stat->bind_param('i', $number);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return convert_table_of_ids_to_normal_array($results);
}
//there is a difference between this funcion and  print_these_courses() in url
function print_the_most_popular_courses($most_eight_popular_courses_ids){
  foreach($most_eight_popular_courses_ids as $course){
    $teacher_id = get_teacher_id_from_database($course['course_id']);
    $teacher_name = get_teacher_name_from_database($teacher_id);
    echo "<a href="."course_view.php?course_id=".$course['course_id']." class='card'>";
    // echo "<a class='card'>";
    echo "<div class='card-image' style='background-image: url(imgs/cards_imgs/".$course['cover_picture_name'].");'></div>";
    echo "<div class='card-info'>";
      echo "<span class='course-title'>".$course['course_title']."</span>";
      echo "<div>";
        echo "<span>presented by : <span class='presenter'>$teacher_name</span></span><br>";
        echo "<span class='number-of-lectures'>".$course['number_of_lectures']." Lecture</span><br>";
        echo "<span class='number-of-hours'>".$course['number_of_hours']." Hours</span><br>";
      echo "</div>";
      echo "<span class='course-catigory'>".$course['category']."</span>";
    echo "</div>";
  echo "</a>";
  }
}
/* end index page functions */
/* start course view page functions */
function are_there_courses_in_the_database(){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT courses.course_id from courses";

  $stat = $db->prepare($query);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  if(count($results) == 0) return false;
  else return true;
}
function get_user_id($user_name){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT users.user_id FROM users where users.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return trim($results[0]['user_id']);
}
function does_user_has_this_course_in_his_list($user_name, $course_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT user_courses.user_id from user_courses where user_courses.user_id = ? && user_courses.course_id = ?";

  $user_id = get_user_id($user_name);

  $stat = $db->prepare($query);
  $stat->bind_param('ii', $user_id, $course_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  if(count($results) == 0) return false;
  return true;
}
function put_plus_one_on_number_of_enrollment_on_this_course($course_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "UPDATE courses set courses.number_of_enrollment = courses.number_of_enrollment + 1 where courses.course_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $course_id);
  $stat->execute();
  $stat->close();
}
function add_course_to_user_list($user_name, $course_id){
  if(!does_user_has_this_course_in_his_list($user_name, $course_id)){
    put_plus_one_on_number_of_enrollment_on_this_course($course_id);
    $server = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "online_courses";
  
    $db = new mysqli($server, $userName, $password, $databaseName);
    
    if($db->connect_error) {
      exit("Connection Error. Try Again Later.");
    }
    
    $query = "insert INTO user_courses(user_courses.user_id, user_courses.course_id, user_courses.enroll_data) VALUES (?,?, now())";
  
    $user_id = get_user_id($user_name);
  
    $stat = $db->prepare($query);
    $stat->bind_param('ii', $user_id, $course_id);
    $stat->execute();
    $stat->close();
  }
}
function remove_course_from_user_list($user_name, $course_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "DELETE FROM user_courses where user_courses.user_id = ? && user_courses.course_id = ?";

  $user_id = get_user_id($user_name);

  $stat = $db->prepare($query);
  $stat->bind_param('ii', $user_id, $course_id);
  $stat->execute();
  $stat->close();
}
function get_teacher_id_from_temporary_database($course_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT temporary_courses.teacher_id from temporary_courses WHERE temporary_courses.course_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $course_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return trim($results[0]['teacher_id']);
}
/* end course view page functions */
/* start add course page functions */
function check_course_full_name(&$course_full_name, &$correct_course_full_name){
  $course_full_name = trim($course_full_name);
  //logic to check here;
  return true;
}
function check_number_of_lecuters(&$number_of_lectures, &$correct_number_of_lectures){
  // echo gettype($number_of_lectures);
  $number_of_lectures = trim($number_of_lectures);
  // echo gettype($number_of_lectures);
  // if(is_int($number_of_lectures)) return true;
  if(1) return true;
  else{
    $correct_number_of_lectures = "*data type here should be integer like 9";
    return false;
  }
}
function check_number_of_hours(&$number_of_hours, &$correct_number_of_hours){
  $number_of_hours = trim($number_of_hours);
  // if(is_int($number_of_hours)) return true;
  if(1) return true;
  else {
    $correct_number_of_hours = "*data type here should be integer like 9";
    return false;
  }
}
function check_category(&$category, &$correct_category){
  $category = trim($category);
  //logic to check here;
  return true;
}
function check_description(&$description, &$correct_description){
  $description = trim($description);
  if(strlen($description) > 255){
    $correct_description = "*number of chars should be less that 255";
    return false;
  }
  return true;
}
function check_course_cover(&$correct_user_file, &$user_file){

  if(!isset($_FILES['user_file'])){
    $correct_user_file = "*you did not upload the photo";
    return false;
  }

  $target_file = "imgs/cards_imgs/new_current_file.".pathinfo($_FILES['user_file']['name'], PATHINFO_EXTENSION);

  if(move_uploaded_file($_FILES['user_file']['tmp_name'], $target_file)){
    $user_file = "new_current_file.".pathinfo($_FILES['user_file']['name'], PATHINFO_EXTENSION);
    return true;
  }else {
    $correct_user_file = "*sorry you cann't upload the photo now";
    return false;
  }
}
function add_course_and_teacher_to_database($course_id, $teacher_id){
    $server = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "online_courses";
  
    $db = new mysqli($server, $userName, $password, $databaseName);
    
    if($db->connect_error) {
      exit("Connection Error. Try Again Later.");
    }
    
    $query = "INSERT INTO course_teachers (course_teachers.course_id, course_teachers.teacher_id) VALUES (?,?)";
  
    $stat = $db->prepare($query);
    $stat->bind_param('ii', $course_id, $teacher_id);
    $stat->execute();
    $stat->close();
}
function add_course_to_database($course_full_name, $number_of_lectures, $number_of_hours ,$category , $description, $user_file, $teacher_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "insert into courses(courses.course_title, courses.number_of_lectures, courses.number_of_hours, courses.cover_picture_name, courses.category, courses.description) VALUES(?, ?, ?, ?, ?, ?)";

  $stat = $db->prepare($query);
  $stat->bind_param('siisss', $course_full_name, $number_of_lectures, $number_of_hours, $user_file, $category, $description);
  $stat->execute();
  $stat->close();
  
  $query = "SELECT courses.course_id from courses where courses.cover_picture_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_file);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  add_course_and_teacher_to_database(trim($results[0]['course_id']), $teacher_id);

  $new_name = trim($results[0]['course_id']).".".pathinfo($user_file, PATHINFO_EXTENSION);

  rename("imgs\\cards_imgs\\".$user_file, "imgs\\cards_imgs\\".$new_name);


  $query = "UPDATE courses set courses.cover_picture_name = ? where courses.cover_picture_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('ss',$new_name, $user_file);
  $stat->execute();
  $stat->close();
}
function add_course_to_database_temporary($course_full_name, $number_of_lectures, $number_of_hours ,$category , $description, $user_file, $teacher_email, $teacher_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
    // echo $description;
  $query = "insert into temporary_courses(temporary_courses.course_title, temporary_courses.number_of_lectures, temporary_courses.number_of_hours, temporary_courses.cover_picture_name, temporary_courses.category, temporary_courses.description, temporary_courses.teacher_email, temporary_courses.teacher_id) VALUES(?, ?, ?, ?, ?, ?,?,?)";

  $stat = $db->prepare($query);
  $stat->bind_param('siissssi', $course_full_name, $number_of_lectures, $number_of_hours, $user_file, $category, $description, $teacher_email, $teacher_id);
  $stat->execute();
  $stat->close();
  
  $query = "SELECT temporary_courses.course_id from temporary_courses where temporary_courses.cover_picture_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_file);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  $new_name = "temp_".trim($results[0]['course_id']).".".pathinfo($user_file, PATHINFO_EXTENSION);

  rename("imgs\\cards_imgs\\".$user_file, "imgs\\cards_imgs\\".$new_name);


  $query = "UPDATE temporary_courses set temporary_courses.cover_picture_name = ? where temporary_courses.cover_picture_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('ss',$new_name, $user_file);
  $stat->execute();
  $stat->close();
}
/* end add course page functions */
/* start log_in_as_teacher page functions */
function does_teacher_exist(&$user_name, $user_password, &$correct_user_name_password){
  $user_name = trim($user_name);
  $user_password = trim($user_password);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select teachers.teacher_id from teachers where teachers.user_name = ? && teachers.password = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('ss', $user_name, $user_password);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  if(count($results) == 0){
    $correct_user_name_password = "*username or password is incorrect";
    return false;
  }
  return true;
}
/* end log_in_as_teacher page functions */
/* start teacher_sign_up page functions */
function check_teacher_user_name(&$user_name, &$correct_user_name){
  $user_name = trim($user_name);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "select teachers.teacher_id from teachers where teachers.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  if(count($results) != 0){
    $correct_user_name = "*Choose another username please";
    return false;
  }
  return true;
}
function add_teacher_to_database($full_name, $user_name, $user_password, $email){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "INSERT INTO teachers (teachers.name, teachers.user_name, teachers.password, teachers.email) VALUES (?, ?, ?, ?)";

  $stat = $db->prepare($query);
  $stat->bind_param('ssss', $full_name, $user_name, $user_password, $email);
  $stat->execute();
  $stat->close();
}
function get_teacher_email($user_name){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "SELECT teachers.email from teachers WHERE teachers.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  
  return trim($results[0]['email']);
}
function get_teacher_id($user_name){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "SELECT teachers.teacher_id from teachers WHERE teachers.user_name = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('s', $user_name);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  
  return trim($results[0]['teacher_id']);
}
/* end teacher_sign_up page functions */
/* start accept_reject_courses page functions */
function get_all_info_about_these_temporary_courses($courses_ids_array){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT * from temporary_courses where temporary_courses.course_id = ?";
  
  foreach($courses_ids_array as $id){
    $stat = $db->prepare($query);
    $stat->bind_param('i', $id);
    $stat->execute();
    $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
    $all_info[] = $results[0];
    $stat->close();
  }
  return $all_info;
}
function get_all_temporary_courses_ids_from_database(){
  
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT temporary_courses.course_id from temporary_courses";
  
  $stat = $db->prepare($query);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return $results;
}
function print_temporary_courses(){
  $all_temporary_courses_ids = get_all_temporary_courses_ids_from_database();
  if(count($all_temporary_courses_ids) == 0) return;
  $all_info_about_courses = get_all_info_about_these_temporary_courses(convert_table_of_ids_to_normal_array($all_temporary_courses_ids)) ;
  foreach($all_info_about_courses as $course){
    $teacher_name = get_teacher_name_from_database($course['teacher_id']);
    echo "<div>";
      echo "<a href="."temporary_course_view.php?course_id=".$course['course_id']." class='card'>";
      // echo "<a class='card'>";
        echo "<div class='card-image' style='background-image: url(imgs/cards_imgs/".$course['cover_picture_name'].");'></div>";
        echo "<div class='card-info'>";
        echo "<span class='course-title'>".$course['course_title']."</span>";
        echo "<div>";
        echo "<span>presented by : <span class='presenter'>".$teacher_name."</span></span><br>";
        echo "<span class='number-of-lectures'>".$course['number_of_lectures']." Lecture</span><br>";
        echo "<span class='number-of-hours'>".$course['number_of_hours']." Hours</span><br>";
        echo "</div>";
        echo "<span class='course-catigory'>".$course['category']."</span>";
        echo "</div>";
      echo "</a>";
      echo "<div class='accept-or-reject-container'>";
        echo "<div class='teacher-id'>id : ".$course['teacher_id']."</div>";
        echo "<div class='teacher-email'>email : <span>".$course['teacher_email']."</span></div>";
        echo "<div class='accept-or-reject-buttons'>";
          echo "<a href='accept_reject_courses.php?publish=".$course['course_id']."&email=".$course['teacher_email']."'>Publish</a>";
          echo "<a href='accept_reject_courses.php?delete=".$course['course_id']."&email=".$course['teacher_email']."' style='margin-left: 10px;'>Delete</a>";
        echo "</div>";
      echo "</div>";
    echo "</div>";
}
}
function delete_course_cover_from_folder($course_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "SELECT temporary_courses.cover_picture_name from temporary_courses where temporary_courses.course_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $course_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  
  $name = trim($results[0]['cover_picture_name']);

  if(file_exists("imgs/cards_imgs/".$name)) unlink("imgs/cards_imgs/".$name);
}
function delete_this_course_from_temporary_table($course_id){
  delete_course_cover_from_folder($course_id);
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "DELETE FROM temporary_courses where temporary_courses.course_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $course_id);
  $stat->execute();
  $stat->close();
}
function publish_this_course($course_id){
  $course_id_array[] = $course_id;
  $course_info = get_all_info_about_these_temporary_courses($course_id_array);
  // print_r($course_info);

  // print_r($course_info);
  add_course_to_database($course_info[0]['course_title'], $course_info[0]['number_of_lectures'], $course_info[0]['number_of_hours'] ,$course_info[0]['category'] , $course_info[0]['description'], $course_info[0]['cover_picture_name'], $course_info[0]['teacher_id']);
  delete_this_course_from_temporary_table($course_id);
  // add_course_to_database($course_full_name, $number_of_lectures, $number_of_hours ,$category , $description, $user_file);
}
/* end accept_reject_courses page functions */
/* start admin_log_in page functions */
function does_admin_exist(&$user_name, $user_password, &$correct_user_name_password){
  $user_name = trim($user_name);
  $user_password = trim($user_password);

  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);

  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }

  $query = "SELECT admin.admin_id from admin WHERE admin.user_name = ? && admin.password = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('ss', $user_name, $user_password);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();
  if(count($results) == 0){
    $correct_user_name_password = "*username or password is incorrect";
    return false;
  }
  return true;
}
/* end admin_log_in page functions */
/* start teacher_view page functions */
function get_teacher_email_from_database($teacher_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT teachers.email from teachers WHERE teachers.teacher_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $teacher_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return trim($results[0]['email']);
}
function get_teacher_courses($teacher_id){
  $server = "localhost";
  $userName = "root";
  $password = "";
  $databaseName = "online_courses";

  $db = new mysqli($server, $userName, $password, $databaseName);
  
  if($db->connect_error) {
    exit("Connection Error. Try Again Later.");
  }
  
  $query = "SELECT course_teachers.course_id from course_teachers where course_teachers.teacher_id = ?";

  $stat = $db->prepare($query);
  $stat->bind_param('i', $teacher_id);
  $stat->execute();
  $results = $stat->get_result()->fetch_all(MYSQLI_ASSOC);
  $stat->close();

  return $results;
}
  function print_teacher_courses($teacher_id){

    $results = get_teacher_courses($teacher_id);
    if(count($results) == 0) return;
    $all_info_about_courses = get_all_info_about_these_courses(convert_table_of_ids_to_normal_array($results));
    $teacher_name = get_teacher_name_from_database($teacher_id);

    foreach($all_info_about_courses as $course){
      echo "<a href="."course_view.php?course_id=".$course['course_id']." class='card'>";
      // echo "<a class='card'>";
      echo "<div class='card-image' style='background-image: url(imgs/cards_imgs/".$course['cover_picture_name'].");'></div>";
      echo "<div class='card-info'>";
        echo "<span class='course-title'>".$course['course_title']."</span>";
        echo "<div>";
          echo "<span>presented by : <span class='presenter'>$teacher_name</span></span><br>";
          echo "<span class='number-of-lectures'>".$course['number_of_lectures']." Lecture</span><br>";
          echo "<span class='number-of-hours'>".$course['number_of_hours']." Hours</span><br>";
        echo "</div>";
        echo "<span class='course-catigory'>".$course['category']."</span>";
      echo "</div>";
    echo "</a>";
    }
  }
/* end teacher_view page functions */
?>