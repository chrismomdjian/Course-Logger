<?php
include("inc/header.php");

$class_id = $_GET['id'];

// Get course title
$course_title_sql = "SELECT title FROM courses WHERE id={$class_id}";
$course_title_handle = $handler->query($course_title_sql);
$course_title = $course_title_handle->fetch(PDO::FETCH_OBJ);

// Get all information for specific course
$course_information = $handler->query("SELECT * FROM courses");
?>

    <div class="container">
      <div class="row">
        <div class="course-name-column col-xs-12 col-sm-6">

          <?php echo "<h1 class='course-title'>" . $course_title->title  . "</h1>"; ?>

        </div>

        <div class="col-xs-12 col-sm-6">

          <h1>Course Information</h1>

          <?php
          while($row = $course_information->fetch()) {
            if($class_id == $row['id']) {
              echo "<strong>Department: </strong>" . $row['department'] . "<br>";
              echo "<strong>Course Title: </strong>" . $row['title'] . "<br>";
              echo "<strong>Course Number: </strong>" . $row['number'] . "<br>";
              echo "<strong>Units: </strong>" . $row['units'] . "<br>";
              echo "<strong>Grade Points Earned: </strong>" . $row['grade_points'] . "<br>";
              echo "<strong>Letter Grade: </strong>" . $row['grade'] . "<br>";
              echo "<strong>Status: </strong>" . $row['status'] . "<br>";
            }
          }
          // foreach($classes as $key => $course) {
          //   if($class_id == $key) {
          //     echo "<strong>Department: </strong>" . $course['department'] . "<br>";
          //     echo "<strong>Course Title: </strong>" . $course['title'] . "<br>";
          //     echo "<strong>Course Number: </strong>" . $course['number'] . "<br>";
          //     echo "<strong>Units: </strong>" . $course['units'] . "<br>";
          //     echo "<strong>Grade Points Earned: </strong>" . $course['grade_points'] . "<br>";
          //     echo "<strong>Status: </strong>" . $course['status'];
          //   }
          // }
          ?>
          <a href="http://chrismomdjian.com/PDO/edit_course.php?id=<?php echo $class_id; ?>">Edit</a>
          &nbsp;&nbsp;<span><a href="#">Delete</a></span>

        </div>
      </div>
    </div>
    <?php include("inc/footer.php"); ?>
  </body>
</html>
