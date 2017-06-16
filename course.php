<?php
include("inc/data.php");
include("inc/header.php");

$class_id = $_GET['id'];
?>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6">

      <?php echo "<h1 class='course-title'>" . $classes[$class_id]['title'] . "</h1>"; ?>

    </div>

    <div class="col-xs-12 col-sm-6">

      <h1>Course Information</h1>

      <?php
      foreach($classes as $key => $course) {
        if($class_id == $key) {
          echo "<strong>Department: </strong>" . $course['department'] . "<br>";
          echo "<strong>Course Title: </strong>" . $course['title'] . "<br>";
          echo "<strong>Course Number: </strong>" . $course['number'] . "<br>";
          echo "<strong>Units: </strong>" . $course['units'] . "<br>";
          echo "<strong>Grade Points Earned: </strong>" . $course['grade_points'] . "<br>";
          echo "<strong>Status: </strong>" . $course['status'];
        }
      }
      ?>

    </div>
  </div>
</div>
