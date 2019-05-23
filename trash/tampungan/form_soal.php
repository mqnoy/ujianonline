<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="./assets/css/form_soal.css" rel="stylesheet"/>
<body>
<?php 
session_start();
$_SESSION['data_form_soal'] = array();
include "./includes/Soal_list.php";

//panggil function soal list
$soal = tampil_soal();
$tampil_pilihanGanda = function ($no_soal=1) use ($soal){
    echo "<div class=\"div_pilganda\" id=\"pil_ganda\">";
    echo "<h4>Soal <span id=\"posisi_soal\">$no_soal</span></h4>";
    echo $soal['pilganda_soal_'.$no_soal]['soal'];
    foreach ($soal['pilganda_soal_'.$no_soal]['pilihan_ganda'] as $key => $value) {
        # code...
        echo "
        <p>
            <input type=\"radio\" oninput=\"this.className = ''\" name=\"pilihan[pilihan_ganda_$no_soal]\" value=\"$key\" /> $value
        </p>";
    }
    echo "</div>";
};
if (isset($_POST['submit_soal'])) {
  # code...
  $_SESSION['data_form_soal'] = $_POST;
  header("Location: ./jawaban.php");
}
?>

<div id="regForm" >
<form method="post" id="form_soal" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <?php 
  for ($i=1; $i <= sizeof($soal); $i++) { 
    # code...
    $tampil_pilihanGanda($i);
  }
  ?>
  <div class="footer_form_soal">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div class="title_regForm">
      <?php
        for ($j=1; $j <= sizeof($soal); $j++) { 
          # code...
          echo "<span class=\"step\"></span>";
        }
      ?>
    </div>
  </div>
</form>
</div>
<div id="div_jawaban">


</div>

<script>
  //https://www.w3schools.com/howto/howto_js_form_steps.asp?
  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab

  function showTab(n) {
    // This function will display the specified tab of the form...
    var div_pilganda = document.getElementsByClassName("div_pilganda");
    div_pilganda[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (div_pilganda.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";    
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

  function nextPrev(n) {
    // This function will figure out which tab to display
    var div_pilganda = document.getElementsByClassName("div_pilganda");
    
    // Hide the current tab:
    div_pilganda[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;

    // if you have reached the end of the form...
    var submited_form = false;
    if (currentTab >= div_pilganda.length) {
      var tombol_submit = document.getElementById("nextBtn");
      var att = document.createAttribute("name");
      att.value = "submit_soal";
      tombol_submit.setAttribute("type", "submit"); 

      // var tombol_submit = document.getElementById("nextBtn");
      tombol_submit.setAttribute("type", "submit"); 
      tombol_submit.setAttributeNode(att);
      // submited_form= true;
    }
    if (submited_form) {
      // ... the form gets submitted:
      document.getElementById("form_soal").submit();
        
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

</body>
</html>
