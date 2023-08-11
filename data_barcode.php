<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'inventory';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, brand, item, quantity, barcodeID FROM items";
$result = $conn->query($sql);
$x = [];
if($result->num_rows > 0) {
  for($y =0; $y < $result->num_rows;$y++){
  $row = $result->fetch_assoc();
  array_push($x, $row);
  }
}

if(isset($_POST['firstSubmit']))
  {
      $item = $_POST['item'];
      $brand = $_POST['brand'];
      $barcode = $_POST['barcode'];
      $sql = "INSERT INTO items (brand,item,quantity,barcodeID)
      VALUES ('$brand','$item',1,'$barcode')";
      if (mysqli_query($conn, $sql)) {

     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
      //  echo "<meta http-equiv='refresh' content='0'>";
       mysqli_close($conn);
       
  }
?>
<style>
  table, th, td
    {border: 1px solid black;
      border-collapse: collapse;
      font-family: "Segoe UI";}
      .center {
        text-align: center;
      }
    form{
      text-align: center;
      background: #d3d3d3;
      border-style: solid;
      font-family: "Segoe UI";
    }
    ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  font-family: "Segoe UI";
}

    li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}


li a:hover {
  background-color: #111;
}

</style>
    <ul>
      <li><a href="/inventory/">Home</a><li>
      <li><a href="insert_new.php">Add New Item</a></li>
      <li><a href="data_barcode.php">Add Through Barcode</a></li>
      <li><a href="data_update.php">Edit Quantities/Barcodes</a></li>
      <li><a href="login.php">Delete Data</a></li>
    </ul>

<br>
<form class='center' action="data_barcode.php" method='post' name='first' id='submit1'>
  <label for='barcodeInput'>Scan Barcode:</label><br>
  <input type='text' id='barcodeInput' name='barcodeInput' required><br>
  <input type="submit" id='barcodeSubmit' name='barcodeSubmit' value="Submit">
</form>
<div id='pickle' class="center"></div>

<script>
 var input = document.getElementById("barcodeInput");

input.addEventListener("keydown", function(event) {
  if(event.key == "Tab"){
  // var barcode = document.getElementById('barcodeSubmit')
  // barcode.click()
  var check = document.getElementById("barcodeInput").value
  if(check===""){
    document.getElementById("pickle").innerHTML = "Please fill in the field"
          abort()
  }
  var barcode = input.value
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pickle").innerHTML = this.responseText
    }
  }

  xhttp.open("GET", "check_database.php?barcode="+barcode, true);
  xhttp.send()

  }
})
var input2 = document.getElementById("submit1");
      input2.addEventListener('submit', function(event) {
        event.preventDefault()
        var barcode = input.value
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pickle").innerHTML = this.responseText
    }
  }

  xhttp.open("GET", "check_database.php?barcode="+barcode, true);
  xhttp.send()

  }
      )
</script>