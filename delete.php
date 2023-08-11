<HTML>
<BODY>
<style>
    table, th, td
    {border: 1px solid black;
      border-collapse: collapse;
      font-family: "Segoe UI";}

      .center {
        text-align: center;
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
  form{
    text-align: center;
    background: #d3d3d3;
    border-style: solid;
    font-family: "Segoe UI";
  }
  .center{
    margin-left: auto;
    margin-right: auto;
  }
  .align{
      margin-left: 585px;
    }
    </style>
<?php   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventory";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, brand, item, quantity, barcodeID FROM items";
    $result = $conn->query($sql);
    $idRow = [];
    if($result->num_rows > 0) {
      for($y =0; $y < $result->num_rows;$y++){
      $row = $result->fetch_assoc();
      array_push($idRow, $row);
      }
    }
    ?>
<form method="post" id="stinky">
    ID:<input type="number" name='idelete' id="idelete"><br>
    <input type="submit" name='submit' id='submit' value="Delete">
    </form>
    <br>
    <table class='center' id='invTable' <div contenteditable='False' ></div>
    <tr>
      <td><b>ID</b></td>
      <td><b>Brand</b></td>
      <td><b>Item</b></td>
      <td><b>Quantity</b></td>
      <td><b>Barcode</b></td>
      
    </tr>
    <input  class='align' id="myInput" onkeydown="myFunction()" placeholder="Search for brands..">
   <?php
    for($walk = 0; $walk<sizeOf($idRow); $walk++){
      echo'<tr>
      <th>'.$idRow[$walk]['id'].'</th>
      <th>'.$idRow[$walk]['brand'].'</th>
      <th>'.$idRow[$walk]['item'].'</th>
      <th>'.$idRow[$walk]['quantity'].'</th>
      <th>'.$idRow[$walk]['barcodeID'].'</th>
      </tr>';
      
    }
    
    echo"</table><br>";       
?>
</HTML> 