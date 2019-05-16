<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="./assets/css/form_soal.css" rel="stylesheet"/>
<body>
<?php 
session_start();
include "./includes/Soal_list.php";

//panggil function soal list
$soal = tampil_soal();
$tampil_pilihanGanda = function ($no_soal=1) use ($soal){
    echo "<div class=\"tab\"> ";
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
if (isset($_POST)) {
  # code...
  var_dump($_POST);
}
?>
<form id="regForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <?php 
  for ($i=1; $i <= sizeof($soal); $i++) { 
    # code...
    $tampil_pilihanGanda($i);
  }
  ?>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

// var posisi_soalnya = ;
// document.getElementById("posisi_soal").innerHTML = posisi_soalnya;


function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  //tampilkan info soal ke berapanya
  // var ambil_name = document.getElementsByName("pilihan[pilihan_ganda_]".n);



  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
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
