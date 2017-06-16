<?php
include("inc/data.php");
include("inc/header.php");
?>


    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="gpa-column col-xs-12 col-sm-6">
            <h2><?php echo "Current GPA: <br><span id='gpa'>", $gpa, "</span>"; ?></h2>
          </div>

          <div class="main-column col-xs-12 col-sm-6">
            <h2><?php echo "<h1>" . $page_title . "</h1>"; ?></h2>
            <ul>
              <?php
              foreach($classes as $key => $course) {
                if(isset($_GET['sort'])) {
                  if($_GET['sort'] == $course['status']) {
                    echo "<li>
                    <a href='http://chrismomdjian.com/PDO/course.php?id=" . $key . "'
                    <p class='" . $course['status'] . "'>" . $course['title'] . "</p>
                    </li></a>";
                  }
                } else {
                  echo "<li>
                  <a href='http://chrismomdjian.com/PDO/course.php?id=" . $key . "'
                  <p class='" . $course['status'] . "'>" . $course['title'] . "</p>
                  </li></a>";
                }
              }
              ?>
            </ul>
          </div>
        </div> <!-- end row -->
      </div> <!-- end container -->
    </div> <!-- end wrapper -->

    <?php include("inc/footer.php"); ?>
  </body>
</html>
