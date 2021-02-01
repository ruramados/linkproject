<?php
 session_start();  
 include('dbb.php');
 $company = $_REQUEST['export_pdf'];
 $sql = ("SELECT a.company_name,a.po_number,c.part_number,b.serial_number,b.hostname,b.ip_address,b.start_date,b.end_date,b.os_firmware,d.building,d.room,d.floor,d.rack_number,d.u_number
        FROM company a 
        inner join inventory b on a.serial_number = b.serial_number
        inner join stock c on b.serial_number = c.serial_number
        inner join location d on b.serial_number = d.serial_number
        where company_id = '$company'");
        $result = mysqli_query($conn,$sql);
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
// Write some HTML code:
$content3='<style>body{font-family:"Garuda"}
p {font-size: 17px;}
h2 {text-align: center;}
</style>
<div>
<h2>FIELD SERVICE REPORT</h2>';
while($row = mysqli_fetch_array($result)){
$content4='
<div>
<div style="float: left; width: 37%;">
    <p>Company Name :  "'.$row['company_name'].'"</p>
  </div>
  <div style="float: right; width: 50%;">
    <p>Po Number : "'.$row['po_number'].'"</p>
  </div>
</div>   
<div>
  <div style="float: left; width: 37%;">
    <p>Part Number :"'.$row['part_number'].'"</p>
  </div>
  <div style="float: right; width: 50%;">
    <p>Serial Number :"'.$row['serial_number'].'"</p>
  </div>
</div>   
<div>
<div style="float: left; width: 37%;">
        <p>Host Name : "'.$row['hostname'].'"</p>
</div>
<div style="float: right; width: 50%;">
        <p>IP Address :"'.$row['ip_address'].'"</p>
</div>
</div>    
<div>

<div style="float: left; width: 37%;">
<p>Start date(MA) :'.$row['start_date'].'</p>

  </div>
  <div style="float: right; width: 50%;">
  <p>Expire date(MA) :'.$row['end_date'].'</p>
  </div>
</div>
<div>
<div style="float: left; width: 37%;">
<p>OS Firmware :'.$row['os_firmware'].'</p>
  </div>
  <div style="float: right; width: 50%;">
  <p>Building :'.$row['building'].'</p>
  </div>
</div>
<div>
<div style="float: left; width: 37%;">
<p>Room :'.$row['room'].'</p>
  </div>
  <div style="float: right; width: 50%;">
  <p>Floor :'.$row['floor'].'</p>
  </div>
</div>
<div>
<div style="float: left; width: 37%;">
<p>Rack No. :'.$row['rack_number'].'</p>

  </div>
  <div style="float: right; width: 50%;">
  <p>U No. :'.$row['u_number'].'</p>

  </div>
</div>
<div>
</div>
<div>
</div>';
} 
$content4 .= '</div>';    


// Output a PDF file directly to the browser
$mpdf->WriteHTML($content3);
$mpdf->WriteHTML($content4);

$mpdf->Output();
