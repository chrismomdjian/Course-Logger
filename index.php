<?php
include("data.php");

$pageTitle = "Required Courses";
$grade_points = 0;
$total_units = 0.0;
$gpa = 0.0;

if(isset($_GET['sort'])) {
  if($_GET['sort'] == "complete") {
    $pageTitle = "Completed Courses";
  } elseif($_GET['sort'] == "incomplete") {
    $pageTitle = "Incomplete Courses";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="main-nav">
      <a href="http://chrismomdjian.com/PDO/index.php"><h4 id="nav-logo">Course Logger</h4></a>
      <ul id="nav-items">
        <a href="http://chrismomdjian.com/PDO/index.php?sort=complete"><li>Completed Courses</li></a>
        <a href="http://chrismomdjian.com/PDO/index.php?sort=incomplete"><li>Unfinished Courses</li></a>
      </ul>
    </div>


    <div class="wrapper">
      <h2><?php echo $pageTitle; ?></h2>

      <!-- Current GPA -->
      <?php
        foreach($classes as $course){
          if($course['status'] == "complete"){
            $grade_points += $course['grade_points'];
            $total_units += $course['units'];
          }
        }

        $gpa = $grade_points / $total_units;
      ?>

      <ul>
        <?php
        foreach($classes as $course) {
          if(isset($_GET['sort'])) {
            if($_GET['sort'] == $course['status']) {
              echo "<li><p class='" . $course['status'] . "'>" . $course['title'] . "</p></li>";
            }
          } else {
            echo "<li><p class='" . $course['status'] . "'>" . $course['title'] . "</li>";
          }
        }
        ?>
      </ul>
    </div>
  </body>
</html>
