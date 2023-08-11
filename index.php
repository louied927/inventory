<!DOCTYPE html>
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
?>
<html>
<head>
  <style>
    h1{text-align: center;
      font-family: "Segoe UI";}
    table, th, td
    {border: 1px solid black;
      border-collapse: collapse;
      font-family: "Segoe UI";
    }

    .center {
      margin-left: auto;
    margin-right: auto;
  }
    .align{
      margin-left: 555px;
    }
    .alignment{
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

li img {
  display: block;
  text-align: right;
}

li a:hover {
  background-color: #111;
}
  </style>
</head>
   <body>
    <div></div>
    <ul>
      <li><a href="/inventory/">Home</a><li>
      <li><a href="insert_new.php">Add New Item</a></li>
      <li><a href="data_barcode.php">Add Through Barcode</a></li>
      <li><a href="data_update.php">Edit Quantities/Barcodes</a></li>
      <li><a href="login.php">Delete Data</a></li>
    </ul>
    
   <h1><b>Welcome to the IT Inventory List</h1>
   <input  class='align' id="myInput" onkeydown="myFunction()" placeholder="Search for brands.."><button onclick="sortTable()">Sort</button>
    <table class="center" id="invTable" <div contenteditable="False" ></div>
        <tr class='alignment'>
					<td><b>ID</b></td>
          <td><b>Brand</b></td>
          <td><b>Item</b></td>
          <td><b>Quantity</b></td>
          <td><b>Barcode</b></td>
        </tr>
        <?php
        for($walk = 0; $walk<sizeOf($x); $walk++){
          echo'<tr>
					<th>'.$x[$walk]['id'].'</th>
          <th>'.$x[$walk]['brand'].'</th>
          <th>'.$x[$walk]['item'].'</th>
          <th>'.$x[$walk]['quantity'].'</th>
          <th>'.$x[$walk]['barcodeID'].'</th>
          </tr>';
        }
        ?>
    </table>
    <br>
    <script>
function myFunction() {
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
function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("invTable");
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("th")[1];
      y = rows[i + 1].getElementsByTagName("th")[1];
      // Check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        // If so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>
</body>
</html>