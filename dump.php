<?php 
    session_start();
    include('dbb.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
div.static {
  position: static;
  border: 3px solid #73AD21;
}
</style>
</head>
<body>

<div>
<h2>FIELD SERVICE REPORT</h2>
<div  class="static">
<p>Company Name : </p>
<p>Po Number :</p>
</div>   
<div >
<p>Po Number :</p>
</div>
<div >
<p>Part Number </p>
</div>   
<div >
<p>Serial Number </p>
</div> 
<div >
<p>Host Name :"</p>
</div>   
<div >
<p>IP Address </p>
</div>  
<div >
<p>Start date(MA) :</p>
</div>
<div >
<p>Expire date(MA) :</p>
</div>
<div >
<p>OS Firmware :</p>
</div>
<div >
<p>Building :</p>
</div>
<div >
<p>Room :</p>
</div>
<div >
<p>Floor :</p>
</div>
<div >
<p>Rack No. :</p>
</div>
<div >
<p>U No. :</p>
</div>
</div>   
<p class="ex2">Part Number :"'.$row['part_number'].'"</p>
<p class="ex2">Serial Number :"'.$row['serial_number'].'"</p>

    
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-t6I8D5dJmMXjCsRLhSzCltuhNZg6P10kE0m0nAncLUjH6GeYLhRU1zfLoW3QNQDF" crossorigin="anonymous"></script></body>
</body>
</html>