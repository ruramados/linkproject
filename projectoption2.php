<?php
    include('dbb.php');
    
    if(isset($_REQUEST["inputvalue"])){
    $serial = $_REQUEST["inputvalue"];
    $sql = "SELECT `part_number` FROM `stock`
    where `serial_number` = '$serial' ";
    $result = $conn->query($sql);
    $output = '';
    if ($result->num_rows > 0) {
    $output .= "<select class='form-control'>";
    while($row = $result->fetch_assoc()) {
    $output .="<option>".$row['part_number']."</option>";
    }
    $output .= "</select>";
}
echo $output;
}

?>
