<?php
    session_start();
    include('dbb.php');


    if(isset($_POST["editwork"]))  
    {  
        $query = "SELECT * FROM `work` WHERE `user_id` = '".$_POST["editwork"]."'";  
        $result = mysqli_query($conn, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }  
 
    if(isset($_POST['updatework'])){
        $id = $_POST['user_id'];
        $status = $_POST['status'];
        $date = $_POST['start_date'];
        $comment = $_POST['comment'];

        $stmt_check = $conn->prepare("SELECT * FROM `work` where `user_id` = ? ");
        $stmt_check->bind_param("i",$id);
        $stmt_check->execute();
        $result1=$stmt_check->get_result();
        if($result1->num_rows > 0){    
        $stmt= $conn->prepare("UPDATE `work` SET `status` = ? ,`start_date` = ?, `comment` = ?  WHERE `user_id` = ?");
        $stmt->bind_param("sssi",$status,$date,$comment,$id);
        $stmt->execute();
        
        header('location:index.php');


        }else{     //  ซ้ำอันอื่น          
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('ไม่มีข้อมูล');
            window.location.href='index.php';
            </script>");
        }
       
    }
?>