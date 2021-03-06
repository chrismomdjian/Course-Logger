<?php
include("inc/connect.php");
include("inc/functions.php");

$page_title = "CourseLogger";
$grade_points = 0;
$total_units = 0.0;
$gpa = 0.0;

// Calculate GPA Query
$query = $handler->query("SELECT * FROM courses");
while($row = $query->fetch()) {
  if($row['status'] == "complete") {
    $grade_points += $row['grade_points'];
    $total_units += $row['units'];
  }
}

// OLD METHOD FOR CALCULATING GPA
// foreach($classes as $course){
//   if($course['status'] == "complete"){
//     $grade_points += $course['grade_points'];
//     $total_units += $course['units'];
//   }
// }

$gpa = $grade_points / $total_units;
$gpa = round($gpa, 2); // round to 2 decimal places


if(isset($_GET['sort'])) {
  if($_GET['sort'] == "complete") {
    $page_title = "Completed Courses";
  } elseif($_GET['sort'] == "incomplete") {
    $page_title = "Incomplete Courses";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>
    <div class="main-nav">
      <a href="http://chrismomdjian.com/PDO/index.php"><h4 id="nav-logo">CourseLogger</h4></a>
      <ul id="nav-items">
        <a href="http://chrismomdjian.com/PDO/index.php?sort=complete"><li>Completed Courses</li></a>
        <a href="http://chrismomdjian.com/PDO/index.php?sort=incomplete"><li>Unfinished Courses</li></a>
        <a href="http://chrismomdjian.com/PDO/add_course.php"><li>Add Course</li></a>
        <span id="mobile-nav-btn">MENU</span>
      </ul>
    </div>

    <div id="mobile-nav">
      <ul>
        <a href="http://chrismomdjian.com/PDO/index.php?sort=complete"><li>Completed Courses</li></a>
        <a href="http://chrismomdjian.com/PDO/index.php?sort=incomplete"><li>Unfinished Courses</li></a>
        <a href="http://chrismomdjian.com/PDO/add_course.php"><li>Add Course</li></a>
      </ul>
    </div>
