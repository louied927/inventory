<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'inventory';

$conn = new mysqli($servername, $username, $password, $dbname);
$brand = $_GET['brand'];
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$brand=$_GET['brand'];
$item=$_GET['item'];
$quantity=$_GET['quantity'];
$barcode=$_GET['barcode'];

$sql = "INSERT INTO items (brand,item,quantity,barcodeID)
VALUES ('$brand','$item','$quantity','$barcode')";
if (mysqli_query($conn, $sql)) {
  echo"<p>Record Updated Successfully!</p>";
} else {
  echo "Error: " . $sql . ":-" . mysqli_error($conn);
}
  mysqli_close($conn);
?>