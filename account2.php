<?php include 'header.php';
if($_SESSION['loginStatus']!=true){ ?> <script type="text/javascript">
  window.location.href="login.php";
</script> <?php }
?>
  <!-- About section -->
  <div class="w3-container w3-dark-grey w3-center w3-text-light-grey w3-padding-32 w3-greyscale-min" id="about">
    <div >
      <h1 id="about">SNAPDOODLE</h1>
      <h4 id="about">ACCOUNT</h3>
    </div>
  </div>

  <div class="w3-container w3-center">
    <h2>Hi! <?php echo $_SESSION['username']; ?></h2>
  </div>

  <div class="w3-container w3-center">
    <h2 style="color: #dd0000" id="demo2">Hurry! Entries Closes In</h2>
    <h3 id="demo" style="color: #dd0000"></h3>
  </div>

    <script>
    // Set the date we're counting down to
    var countDownDate = new Date("Mar 6, 2018 23:11:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo2").innerHTML="Results on Mar 10, 2018, 17:00 Hrs";
            document.getElementById("demo").innerHTML="Stay Tuned For the Further Infomation";
        }
    }, 1000);
    </script>

  <div class="w3-container w3-center w3-quarter">
    <h4>Your Posts</h4><br>
  </div>

  <script>

    function _(el){    	return document.getElementById(el);    }
    function uploadFile(){
    	var file = _("file1").files[0];
      var title = _("title").value;
      var uploader = _("uploader").value;
      var cat = _("category").value;
      var email = _("email").value;
    	var formdata = new FormData();
    	formdata.append("file1", file);
      formdata.append("uploader",uploader);
      formdata.append("title",title);
      formdata.append("category",cat);
      formdata.append("email",email);
    	var ajax = new XMLHttpRequest();
    	ajax.upload.addEventListener("progress", progressHandler, false);
    	ajax.addEventListener("load", completeHandler, false);
    	ajax.addEventListener("error", errorHandler, false);
    	ajax.addEventListener("abort", abortHandler, false);
    	ajax.open("POST", "upload.php");
    	ajax.send(formdata);
    }
    function progressHandler(event){
    	var percent = (event.loaded / event.total) * 100;
    	_("progressBar").value = Math.round(percent);
    	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
    }
    function completeHandler(event){
    	_("status").display = "none";
    	_("progressBar").display = "none"; window.location.reload(true);
    }
    function errorHandler(event){
    	_("status").innerHTML = "Upload Failed";
    }
    function abortHandler(event){
    	_("status").innerHTML = "Upload Aborted";
    }

  </script>
  <div class="w3-row">
  <?php
    $conn = mysqli_connect($servername, $un, $pd, $dbname);
    $query = "SELECT * from gallery where usermail='".$_SESSION['useremail']."'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0) {
      while ($row=mysqli_fetch_assoc($result)) {
   ?>

    <!-- Photo grid -->

      <div class="w3-third">
        <img src="<?php echo $row['path']; ?>" style="width:100%" onclick="onClick(this)" alt="<?php echo $row['title'];?>">
      </div>
    <!--</div>-->

  <?php
  }}
  else { ?>
    <h3 class="w3-center w3-container">Sorry! You do not have any posts yet.</h3>
  <?php }
  if (mysqli_num_rows($result)<3) {
   ?>

 <?php } ?>
  </div>

  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>


<!-- End page content -->
</div>


<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

</script>


</body>
</html>
