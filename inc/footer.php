<div class="bottom-footer">
  <p>&copy;CourseLogger <?php echo date("Y"); ?>.
    Development by <a href="http://chrismomdjian.com">Christian Momdjian</a>
  </p>
</div>

<!-- jQuery CDN -->
<script
  src="http://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous">
</script>

<script>
// mobile navigation menu toggle
$(document).ready(function(){
  $("#mobile-nav-btn").on("click", function(){
    $("#mobile-nav").slideToggle();
  });
});
</script>
