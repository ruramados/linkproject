<?php     
  session_start();  
  include('dbb.php'); ?> 
<html lang="en">
<head>
    <meta charset="UTF-8"> <!--thai lang-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">

</head>
<body>

          <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
              <div class="row">
              <div class="mb-3">
                <label for="serial_no">Serial No.</label>
                <input type="text" class="form-control" name="serial_no" required>
                <p id="error"></p>
              </div>
               <div class="mb-3">
                <label for="part_no">Part No.</label>
                <input type="text" class="form-control" name="part_no" required>
              </div>
              </div>
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block float-right mx-3" name="stock_add" type="submit">Add</button>
              <button type="button" class="btn btn-secondary btn-lg btn-block float-right" data-dismiss="modal">Close</button>
            </form>
            </div>
      </div>
    </div>
  </div>
</div>


<script>

</script>
            
</body>
</html>


<?php
    if (isset($_POST['stock_add'])){
        $serial = mysqli_real_escape_string($conn, $_POST['serial_no']);
        $part = mysqli_real_escape_string($conn, $_POST['part_no']);
        
        $stock_check = "SELECT * FROM stock WHERE serial_number = '$serial' OR part_number = '$part' LIMIT 1";
        $query = mysqli_query($conn, $stock_check);
        $result = mysqli_fetch_assoc($query);
  
        if ($result) { // if user exists
            if ($result['serial_number'] === $serial) {
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('serial number ซ้ำ');
              window.location.href='stockadd.php';
              </script>");
              }
        }else{
          $sql = "INSERT INTO stock (serial_number,part_number) VALUES ('$serial', '$part')";
          mysqli_query($conn, $sql);
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('เพิ่มข้อมูลสำเร็จ');
          window.location.href='checkstock.php';
          </script>");
        }
    }