<?php
    session_start();
    include('dbb.php');

    if(isset($_REQUEST['delete_row'])){
    $serial = $_REQUEST['delete_row'];
    $stmt = $conn->prepare("DELETE `inventory`, `location`, `company`,`stock`
    FROM `inventory` 
    inner join `location` on location.serial_number = inventory.serial_number
    inner join `company` on company.serial_number = inventory.serial_number
    inner join `stock` on stock.serial_number = inventory.serial_number
    WHERE inventory.serial_number = ? ");
    $stmt->bind_param("s",$serial);
    $stmt->execute();
    echo ("<script LANGUAGE='JavaScript'>
            window.alert('ลบข้อมูลสำเร็จ');
            window.location.href='checkstock.php';
            </script>");
    }
?>