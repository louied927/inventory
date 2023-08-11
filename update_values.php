<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventory";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
       $id = $_GET['id'];
       $newQuant = $_GET['quantity'];
       $newBar = $_GET['barcode'];
    
    if($newQuant !== null){
      $sql = "UPDATE items SET quantity=$newQuant WHERE id=$id";
      $conn->query($sql);
    }
    if($newBar !== ""){
      $sql = "UPDATE items SET barcodeID=$newBar WHERE id=$id";
      $conn->query($sql);
    }
   echo"<p>Updated Succesfully!</p>";
    
    $conn->close();
    
?>