<?php
    session_start();  
    include('dbb.php');

if(isset($_POST['search1'])){
    $search=$_POST['search1'];
    $sql = "SELECT a.company_id,a.company_name,a.project, a.po_number,concat(b.first_name,' ',b.last_name) as fullname,c.config
    FROM company a
    inner join users b on a.user_id = b.user_id
    inner join inventory c on a.serial_number = c.serial_number
    where company_name = '$search' or po_number = '$search' ";
  }else{
    $sql = ("SELECT a.company_id,a.company_name,a.project, a.po_number,concat(b.first_name,' ',b.last_name) as fullname,c.config
    FROM company a
    inner join users b on a.user_id = b.user_id
    inner join inventory c on a.serial_number = c.serial_number");
}


$output = "<thead>
<tr class=\"text-truncate\">
<th>Po</th>
<th>ชื่อโครงการ</th>
<th>Config</th>  
<th>ผู้รับผิดชอบ</th>
<th>รายละเอียด</th>
</tr>
</thead>
<tbody>";

foreach ($conn->query($sql) as $row) {
  $test = $row['po_number'];
  $output .="<tr>";
  $output .="<td>$test</td>" ;
}

/*
$output .="<td>$po_number</td>";
$output .="<td><a href='$config' download>ดาวน์โหลด</a></td>";
$output .="<td>$fullname</td>";
$output .="<td><a href='projectinfo.php?company_id=$company_id' class='btn'>ดูข้อมูล</a></td>";
$output .="</tr>";*/

 $output .= "</tbody>"; 


  echo $output;
 ?>