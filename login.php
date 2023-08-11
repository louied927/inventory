<!DOCTYPE html>
<html>
<style>
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
  </style>
<body>
    <ul>
      <li><a href="/inventory/">Home</a><li></li>
      <li><a href="insert_new.php">Add New Item</a></li>
      <li><a href="data_barcode.php">Add Through Barcode</a></li>
      <li><a href="data_update.php">Edit Quantities/Barcodes</a></li>
      <li><a href="login.php">Delete Data</a></li>
    </ul>
    <br>
    <div id="replaceDiv">
<form id='submit1'>
    <label for="pswd">Enter your password: </label>
    <input type="password" id="pswd">
    <input type="button"  value="Submit" onclick="checkPswd();" />
</form>
</div>
<?php
if(isset($_POST['idelete'])){
   $id=$_POST['idelete'];
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "inventory";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   $sql = "DELETE FROM items WHERE id=$id";
    $conn->query($sql);
    if ( !$conn ) {
        trigger_error('query failed', E_USER_ERROR);
    }
}
?>
<!--Function to check password the already set password is admin-->
<script type="text/javascript">
    function checkPswd() {
        var confirmPassword = "admin";
        var password = document.getElementById("pswd").value;
        
      if (password == confirmPassword) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("replaceDiv").innerHTML = this.responseText
          }
        }
        xhttp.open("GET", "delete.php", true);
        xhttp.send()
        }
        else{
            alert("Incorrect Password");
        }
    }
    function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("invTable");
  tr = table.getElementsByTagName("tr");

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
var input = document.getElementById("submit1");
      input.addEventListener('submit', function(event) {
        event.preventDefault()
        var confirmPassword = "admin";
        var password = document.getElementById("pswd").value;
        
      if (password == confirmPassword) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("replaceDiv").innerHTML = this.responseText
          }
        }
        xhttp.open("GET", "delete.php", true);
        xhttp.send()
        }
        else{
            alert("Incorrect Password");
        }
    }
        
      )
</script>
</body>
</html>