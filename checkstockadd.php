<?php
    session_start();  
    include('dbb.php');


  if(isset($_POST['serial']) && isset($_POST['part'])){
    $serial = mysqli_real_escape_string($conn, $_POST['serial']);
    $part = mysqli_real_escape_string($conn, $_POST['part']);
    
    $stock_check = "SELECT * FROM stock WHERE serial_number = '$serial' LIMIT 1";
    $query = mysqli_query($conn, $stock_check);
    $result = mysqli_fetch_assoc($query);

    if ($result) { // if user exists
        if ($result['serial_number'] === $serial) {
          $status =  'f';
          }
    }else{
      $sql = "INSERT INTO stock (serial_number,part_number) VALUES ('$serial', '$part')";
      mysqli_query($conn, $sql);
      $status =  'p';
    }
    echo $status;
  }
 ?>