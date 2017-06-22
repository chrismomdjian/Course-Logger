<?php
include("inc/header.php");

$course_id = $_GET['id'];
$confirmMessage = $_POST['confirm_message'];
$exitButton = $_POST['exit_button'];

$isValid = true;

// Get course title
$course_title_sql = "SELECT title FROM courses WHERE id={$course_id}";
$course_title_handle = $handler->query($course_title_sql);
$course_title = $course_title_handle->fetch(PDO::FETCH_OBJ);


$error_message = "";
$success_message = "";
$isValid = true;

$delete_course_query = "DELETE FROM courses WHERE id={$course_id}";

if(isset($confirmMessage)) {
  try {
      $delete_course = $handler->query($delete_course_query);
      $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $success_message = $course_title->title . " has been deleted.";
  } catch(PDOException $e) {
      $isValid = False;
      $error_message = "Could not delete requested course: " . $course_title->title;
  }
}

?>

    <div class="wrapper">
      <div class="form-section container-fluid">
        <h1 class="course-title">Delete a Course</h1>
        <div class="confirm-deletion-column">

          <!-- Dont show error messages until form has been submitted -->
          <?php if($_SERVER['REQUEST_METHOD'] == "POST"){
            if($isValid) {
              echo '<div class="success-message" style="text-align: center;">' . $success_message . '</div>';
            } else {
              echo '<div class="error-message" style="text-align: center;">' . $error_message . '</div>';
            }
          } ?>

          <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$course_id"; ?>" method="POST">
            <?php if(!isset($confirmMessage)){ ?>
              <p>Are you sure you would like to delete the course: <strong><?php echo $course_title->title; ?></strong>?</p>

              <button type="submit" name="confirm_message" class="btn btn-default btn-lg">Confirm</button>
              &nbsp;&nbsp;
              <a href="http://chrismomdjian.com/PDO/course.php?id=<?php echo $course_id; ?>">
                <button type="button" class="btn btn-default btn-lg">Cancel</button>
              </a>
            <?php
            } ?>


          </form>


        </div> <!-- end form-contain -->
      </div> <!-- end container -->
    </div> <!-- end wrapper -->

    <?php include("inc/footer.php"); ?>
  </body>
</html>
