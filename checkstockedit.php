<?php
    session_start();
    include('dbb.php');


    if(isset($_POST["id"]))  
    {  
        $query = "SELECT * FROM `stock` WHERE `serial_number` = '".$_POST["id"]."'";  
        $result = mysqli_query($conn, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }  
 
 

    if(isset($_POST['stock_edit'])){
        $id = $_POST['id'];
        $serial = $_POST['serial_no'];
        $part = $_POST['part_no'];

        $stmt_check = $conn->prepare("SELECT * FROM `stock` where `serial_number` = ? ");
        $stmt_check->bind_param("s",$serial);
        $stmt_check->execute();
        $result=$stmt_check->get_result();
        if($result->num_rows <= 0 || $id == $serial ){      // ซ้ำอันเดิมหรือไม่มีเหมือนกัน
        $stmt= $conn->prepare("UPDATE `stock` SET `serial_number` = ? ,`part_number` = ? WHERE `serial_number` = ?");
        $stmt->bind_param("sss",$serial,$part,$id);
        $stmt->execute();
        
        $stmt1= $conn->prepare("UPDATE inventory a  
        INNER JOIN location b ON b.serial_number = a.serial_number 
        INNER JOIN company c on c.serial_number = a.serial_number 
        SET a.serial_number = ? , b.serial_number = a.serial_number, c.serial_number = a.serial_number 
        where a.serial_number = ? "); //update inventory,company,location
        $stmt1->bind_param("ss",$serial,$id);
        $stmt1->execute();

        header('location:checkstock.php');
            
        }else{     //  ซ้ำอันอื่น          
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('serial_number ซ้ำ');
            window.location.href='checkstock.php';
            </script>");
        }
       
    }
?>