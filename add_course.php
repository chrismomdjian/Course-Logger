<?php
include("inc/header.php");

$error_message = "";
$success_message = "";
$isValid = true;

// Validate Form
if(isset($_POST['add-course'])) {
  if(empty($_POST['title']) || empty($_POST['department']) || empty($_POST['number'])
    || empty($_POST['units']) || empty($_POST['grade']) || empty($_POST['status'])) {
      $error_message = "Please fill in all required fields.";
      $isValid = false;
  } elseif(strlen($_POST['title'] > 50)){
      $error_message = "Course Title max value is 50 characters.";
      $isValid = false;
  } elseif(strlen($_POST['department'] > 50)){
      $error_message = "Course Department max value is 50 characters.";
      $isValid = false;
  } else {
      $title = clean_fields($_POST['title']);
      $department = clean_fields($_POST['department']);
      $number = clean_fields($_POST['number']);
      $units = clean_fields($_POST['units']);
      $grade_points = clean_fields($_POST['grade_points']);
      $grade = clean_fields($_POST['grade']);
      $status = clean_fields($_POST['status']);


      $add_course_sql = "INSERT INTO courses (title, department, number, units, grade_points, grade, status)
        VALUES (:title, :department, :number, :units, :grade_points, :grade, :status)";

       $results = $handler->prepare($add_course_sql);

       $results->execute(array(
         ':title' => $title,
         ':department' => $department,
         ':number' => $number,
         ':units' => $units,
         ':grade_points' => $grade_points,
         ':grade' => $grade,
         ':status' => $status
       ));

      $isValid = true;
      $success_message = "Course information has been added.";
  }
}
?>

    <div class="wrapper">
      <div class="form-section container-fluid">
        <h1 class="course-title">Add a Course</h1>
        <div class="form-contain">

          <!-- Dont show error messages until form has been submitted -->
          <?php if($_SERVER['REQUEST_METHOD'] == "POST"){
            if($isValid) {
              echo '<div class="success-message" style="text-align: center;">' . $success_message . '</div>';
            } else {
              echo '<div class="error-message" style="text-align: center;">' . $error_message . '</div>';
            }
          } ?>

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="title">Title</label><br>
            <input type="text" id="title" name="title"><br><br>

            <label for="department">Department</label><br>
            <input type="text" id="department" name="department"><br><br>

            <label for="number">Number</label><br>
            <input type="text" id="number" name="number"><br><br>

            <label for="units">Units</label><br>
            <input type="text" id="units" name="units"><br><br>

            <label for="grade_points">Grade Points</label><br>
            <input type="text" id="grade_points" name="grade_points"><br><br>

            <label for="grade">Grade</label><br>
            <select id="grade" name="grade">
              <option value="">-- select grade --</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="F">F</option>
              <option value="N/A">N/A</option>
            </select>

            <br><br>

            <label for="status">Status</label><br>
            <select id="status" name="status">
              <option value="">-- select status --</option>
              <option value="complete">complete</option>
              <option value="incomplete">incomplete</option>
            </select>

            <br><br>

            <input type="submit" class="btn btn-default btn-lg" value="Add Course" name="add-course">

          </form>
        </div> <!-- end form-contain -->
      </div> <!-- end container -->
    </div> <!-- end wrapper -->

    <?php include("inc/footer.php"); ?>
  </body>
</html>
