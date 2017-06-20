<?php
include("inc/header.php");

$course_id = intval($_GET['id']);

$error_message = "";
$success_message = "";
$isValid = true;

if(isset($_POST['commit-changes'])) {
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

      // If all fields are filled in or edited, update fields in db
      $edit_course_sql = "UPDATE courses
                          SET title = :title, department = :department, number = :number, units = :units,
                            grade_points = :grade_points, grade = :grade, status = :status
                          WHERE id={$course_id}";

      $edited_results = $handler->prepare($edit_course_sql);

      $edited_results->execute(array(
         ':title' => $title,
         ':department' => $department,
         ':number' => $number,
         ':units' => $units,
         ':grade_points' => $grade_points,
         ':grade' => $grade,
         ':status' => $status
       ));

      $isValid = true;
      $success_message = "Course has been updated.";

  }
}

$get_course_to_edit = $handler->query("SELECT * FROM courses WHERE id={$course_id}");
$course_information = $get_course_to_edit->fetch(PDO::FETCH_OBJ);

?>

    <div class="wrapper">
      <div class="form-section container">
        <h1 class="course-title">Edit Course</h1>
        <div class="form-contain">

          <!-- Dont show error messages until form has been submitted -->
          <?php if($_SERVER['REQUEST_METHOD'] == "POST"){
            if($isValid) {
              echo '<div class="success-message" style="text-align: center;">' . $success_message . '</div>';
            } else {
              echo '<div class="error-message" style="text-align: center;">' . $error_message . '</div>';
            }
          } ?>



          <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$course_id"; ?>" method="POST">
            <label for="title">Title</label><br>
            <input type="text" id="title" name="title" value="<?php echo $course_information->title; ?>"><br><br>

            <label for="department">Department</label><br>
            <input type="text" id="department" name="department" value="<?php echo $course_information->department; ?>"><br><br>

            <label for="number">Number</label><br>
            <input type="text" id="number" name="number" value="<?php echo $course_information->number; ?>"><br><br>

            <label for="units">Units</label><br>
            <input type="text" id="units" name="units" value="<?php echo $course_information->units; ?>"><br><br>

            <label for="grade_points">Grade Points</label><br>
            <input type="text" id="grade_points" name="grade_points" value="<?php echo $course_information->grade_points; ?>"><br><br>

            <label for="grade">Grade</label><br>
            <select id="grade" name="grade">
              <option value="">-- select grade --</option>
              <option value="A" <?php if($course_information->grade == 'A'){echo "selected";}?>>A</option>
              <option value="B" <?php if($course_information->grade == 'B'){echo "selected";}?>>B</option>
              <option value="C" <?php if($course_information->grade == 'C'){echo "selected";}?>>C</option>
              <option value="D" <?php if($course_information->grade == 'D'){echo "selected";}?>>D</option>
              <option value="F" <?php if($course_information->grade == 'F'){echo "selected";}?>>F</option>
              <option value="N/A" <?php if($course_information->grade == 'N/A'){echo "selected";}?>>N/A</option>
            </select>

            <br><br>

            <label for="status">Status</label><br>
            <select id="status" name="status">
              <option value="">-- select status --</option>
              <option value="complete" <?php if($course_information->status == 'complete'){echo "selected";}?>>complete</option>
              <option value="incomplete" <?php if($course_information->status == 'incomplete'){echo "selected";}?>>incomplete</option>
            </select>

            <br><br>

            <input type="submit" class="btn btn-default btn-lg" value="Commit Changes" name="commit-changes">

          </form>
        </div> <!-- end form-contain -->
      </div> <!-- end container -->
    </div> <!-- end wrapper -->

    <?php include("inc/footer.php"); ?>
  </body>
</html>
