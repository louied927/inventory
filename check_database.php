<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'inventory';
echo'
<style>
table, th, td
{border: 1px solid black;
  border-collapse: collapse;}
  .center {
  text-align: center;
  }
form{
  text-align: center;
  background: #d3d3d3;
  border-style: solid;
</style>';
$conn = new mysqli($servername, $username, $password, $dbname);
$q = $_GET['barcode'];
$sql = "SELECT barcodeID, quantity FROM items";

$result = $conn->query($sql);
$x = [];
if($result->num_rows > 0) {
  for($y =0; $y < $result->num_rows;$y++){
  $row = $result->fetch_assoc();
  array_push($x, $row);
  }
}

for($walk = 0; $walk<sizeOf($x); $walk++){
  if($x[$walk]['barcodeID'] == $q){
    $quantity = $x[$walk]['quantity']+1;
    $sql ="UPDATE items SET quantity=$quantity WHERE barcodeID = $q";
    echo"<p class='center'>Record updated succesfully!</p>";
    
    if ($conn->query($sql) === TRUE) {
      return;
    } else {
      echo "Error updating record: " . $conn->error;
      return;
  }
} elseif ($walk == sizeOf($x)-1) {
  echo"
          <form action='' method='post'>
          <label for='brand'>Brand:</label><br>
          <input type='text' id='cellOne' name='brand' required><br>
          <label for='item'>Item:</label><br>
          <input type='text' id='cellTwo' name='item' required><br>
          <label for='barcode'>Barcode:</label><br>
          <select id='barcode' name='barcode'><br>
            <option value=".$q.">$q</option>
          <input type='submit' name='firstSubmit' value='Submit' >
        </form>
        <br>
        ";
}
}
?>