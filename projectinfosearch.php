<?php
session_start();
include('dbb.php');

if(isset($_POST['search1'])){
  $search=$_POST['search1'];
  $stmt=$conn->prepare("SELECT row_number() over(order by serial_number asc) as 'rows',serial_number,part_number
  from stock
  where serial_number LIKE CONCAT('%',?,'%') or part_number LIKE CONCAT('%',?,'%')");
  $stmt->bind_param("ss",$search,$search);
}
else{
    $stmt=$conn->prepare("SELECT row_number() over(order by serial_number asc) as 'rows',serial_number,part_number
    from stock");
}

$stmt->execute();
$result=$stmt->get_result();

$output="<thead>
<tr class=\"text-truncate\">
<th>No.</th>
<th>Serial No.</th>
<th>Part No.</th>
</tr>
</thead>
<tbody>";
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    $output .="
    <tr class=\"searchcolor\">
    <td>".$row['rows']."</td>
    <td>".$row['serial_number']."</td>
    <td>".$row['part_number']."</td>
    </tr>";
  }
  $output .="</tbody>";
}
else{
  $output .='
    <tr>
    <td colspan="3" align="center">ไม่มีข้อมูล</td>
    </tr>
    </tbody>';
}
  echo $output;
?>




