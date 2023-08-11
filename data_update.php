
<html>
<body>
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
      margin-left: 575px;
    }
    </style>
    <ul>
      <li><a href='/inventory/'>Home</a><li>
      <li><a href='insert_new.php'>Add New Item</a></li>
      <li><a href='data_barcode.php'>Add Through Barcode</a></li>
      <li><a href='data_update.php'>Edit Quantities/Barcodes</a></li>
      <li><a href="login.php">Delete Data</a></li>
    </ul>
    <br>

    
    <form method='post'>
    <label for='id'>ID of change:</label><br>
    <select id='id' name='id' required>
      <?php
      for($z=0; $z<sizeOf($idRow);$z++){
        $printVal = $idRow[$z]['id'];
        echo"<option value=".$printVal.">$printVal</option>";
      }
      ?>
    </select>
    <br>
    
    <label for='newQuant'>New Quantity:</label><br>
    <input type='number'  id='quantity' name='newQuant' ><br>
    <label for='newBar'>New Barcode:</label><br>
    <input type='text'  id='barcode' name='newBar' ><br>
    <input type='submit' id='submit' name='submit' value='Submit'>
    </form>
    <div class='center' id='pickle'></div>
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
<script>
  var input = document.getElementById("submit");
      input.addEventListener('click', function(event) {
        event.preventDefault()
        var id = document.getElementById('id').value 
        
        var quantity = document.getElementById('quantity').value
        
        var barcode = document.getElementById('barcode').value

        if(id==="" || quantity==="" || barcode===""){
          document.getElementById("pickle").innerHTML = "Please fill out at least one of the fields"
          abort()
        } 
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("pickle").innerHTML = this.responseText
          }
        }
        xhttp.open("GET", "update_values.php?id="+id+"&quantity="+quantity+"&barcode="+barcode, true);
        xhttp.send()
      })
      function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("invTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("th")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>