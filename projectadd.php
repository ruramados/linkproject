<?php 
        session_start();  
    include('dbb.php');
    
    if(isset($_POST['project_add'])){
      
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']); //company
        $projectname = mysqli_real_escape_string($conn, $_POST['projectname']);
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

        $po_number = mysqli_real_escape_string($conn, $_POST['po_number']); 
        //inventory
        $hostname = mysqli_real_escape_string($conn, $_POST['hostname']);
        $ip = mysqli_real_escape_string($conn, $_POST['ip']);
        $os_firmware = mysqli_real_escape_string($conn, $_POST['os_firmware']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $expire_date = mysqli_real_escape_string($conn, $_POST['expire_date']);
        //stock
        $serial_number = mysqli_real_escape_string($conn, $_POST['serial_number']);
        $part_number = mysqli_real_escape_string($conn, $_POST['part_number']);
        // location
        $building = mysqli_real_escape_string($conn, $_POST['building']);
        $room = mysqli_real_escape_string($conn, $_POST['room']);
        $floor = mysqli_real_escape_string($conn, $_POST['floor']);
        $rack = mysqli_real_escape_string($conn, $_POST['rack']);
        $u = mysqli_real_escape_string($conn, $_POST['u']);
        //config
        $company = $_POST['configFile'];
        $file_name = $_FILES['configFile']['name'];
        $file_tmp = $_FILES['configFile']['tmp_name'];
        $file_size = $_FILES['configFile']['size'];
        $file_seperate = explode('.',$file_name);
        $file_ext = strtolower(end($file_seperate));
        $ext_allow = array('pdf','php','csv');  //condition allow pdf,php and csv file
        $file_noExt = $file_seperate[0]; //name without extension
        $path = "config/" . $file_name; //path to save

        if(in_array($file_ext,$ext_allow)){
            if (!file_exists($path)){
              if ($file_size < 500000){ // check lower than 5kb
              $path_folder = move_uploaded_file($file_tmp,$path); //store in folder
              $sql1 = ("INSERT INTO inventory (`serial_number`,`hostname`,`ip_address`,`os_firmware`,`start_date`,`end_date`,`config`) 
              values ('$serial_number','$hostname','$ip','$os_firmware','$start_date','$expire_date','$path')");
              $result = mysqli_query($conn, $sql1);
              $sql2 =("INSERT INTO `location` (`building`,`room`,`floor`,`rack_number`,`u_number`,`serial_number`)
              values ('$building','$room','$floor','$rack','$u','$serial_number')");
              $result2 = mysqli_query($conn, $sql2);
              $sql3 = ("UPDATE `company` SET `serial_number` = '$serial_number' , `project` = '$projectname',`user_id` = '$user_id'
              WHERE `company_name` = '$company_name' and `po_number` = '$po_number'");
              $result3 = mysqli_query($conn, $sql3);
              $sql4 =("INSERT INTO `work` (`user_id`,`status`)
              values ('$user_id','ไม่สำเร็จ')");
              $result4 = mysqli_query($conn, $sql4);
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('เพิ่มข้อมูลสำเร็จ');
              window.location.href='project.php';
              </script>");
              }else{
                $_SESSION['error'] = "ไฟล์ขนาดใหญ่เกินไป";
                header("location: project.php");
              }
            }else{
              $_SESSION['error'] = "มีข้อมูลนี้อยู่แล้วในระบบ";
              header("location: project.php");
            }
          }else{
            $_SESSION['error'] = "กรุณาอัพไฟล์ที่เป็นสกุลpdfหรือphpด้วย";
              header("location: project.php");
          }
    }else{
      echo ("<script LANGUAGE='JavaScript'>
              window.alert('ggwp');
              window.location.href='project.php';
              </script>");
    }
?>