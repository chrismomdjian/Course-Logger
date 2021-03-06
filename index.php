<?php
include("inc/header.php");
?>


    <div class="wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="gpa-column col-xs-12 col-sm-6">
            <div class="widget-border">
              <h2><?php echo "Current GPA <br><span id='gpa'>", $gpa, "</span>"; ?></h2>
            </div>

            <?php if($page_title == "CourseLogger") {
              echo "<div class='widget-border'>";
              echo "<h3><strong>Green</strong> = <span class='complete'>Complete</span></h3>";
              echo "<h3><strong>Red</strong> = <span class='incomplete'>Incomplete</span></h3>";
              echo "</div>";
            }?>
          </div>

          <div class="main-column col-xs-12 col-sm-6">
            <div class="widget-border">
              <h2><?php echo "<h1>" . $page_title . "</h1>"; ?></h2>
              <ul>
                <?php
                $count = 0;
                $query2 = $handler->query("SELECT * FROM courses");
                while($row = $query2->fetch()) {
                  if(isset($_GET['sort'])) {
                    if($_GET['sort'] == $row['status']) {
                      echo "<li>
                      <a href='http://chrismomdjian.com/PDO/course.php?id=" . $row['id'] . "'
                      <p class='" . $row['status'] . "'>" . $row['title'] . "</p>
                      </li></a>";

                      $count++;
                    }
                  } else {
                      echo "<li>
                      <a href='http://chrismomdjian.com/PDO/course.php?id=" . $row['id'] . "'
                      <p class='" . $row['status'] . "'>" . $row['title'] . "</p>
                      </li></a>";
                  }
                }

                // OLD CODE USING ARRAY FOR COURSE IN DATA.PHP
                // foreach($classes as $key => $course) {
                //   if(isset($_GET['sort'])) {
                //     if($_GET['sort'] == $course['status']) {
                //       echo "<li>
                //       <a href='http://chrismomdjian.com/PDO/course.php?id=" . $key . "'
                //       <p class='" . $course['status'] . "'>" . $course['title'] . "</p>
                //       </li></a>";
                //     }
                //   } else {
                //     echo "<li>
                //     <a href='http://chrismomdjian.com/PDO/course.php?id=" . $key . "'
                //     <p class='" . $course['status'] . "'>" . $course['title'] . "</p>
                //     </li></a>";
                //   }
                // }
                ?>

              </ul>
            </div>
            <?php
            // Get total count of sorted courses
            if(isset($_GET['sort'])) { ?>
              <div class="widget-border" style="text-align: center;">
                <h3><strong>Total</strong><?php echo ": " . $count . " courses"; ?></h3>
              </div>
            <?php
            }
            ?>
          </div>
        </div> <!-- end row -->
      </div> <!-- end container -->
    </div> <!-- end wrapper -->

    <?php include("inc/footer.php"); ?>
  </body>
</html>
