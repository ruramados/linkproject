<?php
    include('dbb.php');
    if(isset($_REQUEST["input"])){
    $companyname = $_REQUEST["input"];
    $sql = "SELECT `po_number` FROM `company`
    where `company_name` = '$companyname' and `serial_number` IS NULL";
    $result = $conn->query($sql);
    $output = '';
    if($result->num_rows > 0) {
     $output .= "<select class='form-control'>";
    while($row = $result->fetch_assoc()){
     $output .= "<option>".$row['po_number']."</option>";
    }
    $output .=  "</select>";
}
    echo $output;
 }
?>
