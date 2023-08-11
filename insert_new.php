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
    <form class="center" id='insert' action='' method='post ' >
    <label for='brand'>Brand:</label><br>
    <input type='text' id='cellOne' name='brand' required><br>
    <label for='item'>Item:</label><br>
    <input type='text' id='cellTwo' name='item' required><br>
    <label for='quantity'>Quantity:</label><br>
    <input type='number' id='cellThree' name='quantity' required><br>
    <label for='barcode'>Barcode:</label><br>
    <input type='text' id='cellFour' name='barcode'><br>
    <input type='submit' id='turnIn' name='submit' value='Submit' >
    </form>
    <div class='center' id='pickle'></div>
    <script>
      var input = document.getElementById("turnIn");
      input.addEventListener('click', function(event) {
        event.preventDefault()
        var brand = document.getElementById('cellOne').value 
        
        var item = document.getElementById('cellTwo').value
        
        var quantity = document.getElementById('cellThree').value
        
        var barcode = document.getElementById('cellFour').value
        
        if(brand==="" || item==="" || quantity===""){
          document.getElementById("pickle").innerHTML = "Please fill out at least first three fields"
          abort()
        } 
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("pickle").innerHTML = this.responseText
          }
        }
        xhttp.open("GET", "database_entry.php?brand="+brand+"&item="+item+"&quantity="+quantity+"&barcode="+barcode, true);
        xhttp.send()
      })
    </script>
  </body>
</html>