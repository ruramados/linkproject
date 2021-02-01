<?php
    session_start();
    include('dbb.php');

    if(isset($_POST["id"]))  
    {  
        $query = "SELECT b.company_name,c.po_number,d.serial_number,d.part_number
        FROM  inventory a
        INNER JOIN company b on a.serial_number = b.serial_number
        INNER JOIN po c on b.po_number = c.po_number
        INNER JOIN stock d ON a.serial_number = d.serial_number
        WHERE a.serial_number = '".$_POST["id"]."'";  
        $result = mysqli_query($conn, $query);  
        $row = mysqli_fetch_array($result);  
        echo json_encode($row);  
    }

    if(isset($_POST['project_edit'])){
        $serial = $_POST['serial_number'];
        $project = $_POST['projectname'];
        $hostname = mysqli_real_escape_string($conn, $_POST['hostname']);
        $ip = mysqli_real_escape_string($conn, $_POST['ip']);
        $os_firmware = mysqli_real_escape_string($conn, $_POST['os_firmware']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $expire_date = mysqli_real_escape_string($conn, $_POST['expire_date']);
        //location
        $building = mysqli_real_escape_string($conn, $_POST['building']);
        $room = mysqli_real_escape_string($conn, $_POST['room']);
        $floor = mysqli_real_escape_string($conn, $_POST['floor']);
        $rack = mysqli_real_escape_string($conn, $_POST['rack']);
        $u = mysqli_real_escape_string($conn, $_POST['u']);
        //config
        $file_name = $_FILES['configFile']['name'];
        $file_tmp = $_FILES['configFile']['tmp_name'];
        $file_size = $_FILES['configFile']['size'];
        $file_seperate = explode('.',$file_name);
        $file_ext = strtolower(end($file_seperate));
        $ext_allow = array('pdf','php','csv');  //condition allow pdf,php and csv file
        $file_noExt = $file_seperate[0]; //name without extension
        $path = "config/" . $file_name; //path to save

        $sql = ("SELECT config from inventory 
        where serial_number = '$serial' ");
        $query = mysqli_query($conn, $sql);
        
    
        if (mysqli_num_rows($query) > 0) { 
            // get path from database
            while($row = mysqli_fetch_assoc($query)) {
              $config = $row['config'];
            }
          } else {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('ไม่พบข้อมูลในระบบ');
                window.location.href='project.php';
                </script>");
          }
         if(!unlink($config)){ // delete path in folder
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('ไม่พบข้อมูลไฟล์ที่เก็บเอาไว้');
            window.location.href='project.php';
            </script>");
         }else{
              if(in_array($file_ext,$ext_allow)){
              if (!file_exists($path)){
                if ($file_size < 500000){ // check lower than 5kb
                $path_folder = move_uploaded_file($file_tmp,$path); //store in folder
                $update = ("UPDATE inventory a 
                INNER JOIN location b ON b.serial_number = a.serial_number
                INNER JOIN company c on c.serial_number = a.serial_number
                SET a.hostname = '$hostname', a.ip_address = '$ip' , a.os_firmware = '$os_firmware', a.start_date = '$start_date', a.end_date = '$expire_date', a.config = '$path',
                b.building = '$building', b.room = '$room' , b.floor = '$floor' , b.rack_number = '$rack' , b.u_number = '$u' , c.project = '$project'
                where a.serial_number = '$serial' ");
                $result = mysqli_query($conn, $update);

                echo ("<script LANGUAGE='JavaScript'>
                    window.alert('แก้ไขข้อมูลสำเร็จ');
                    window.location.href='project.php';
                    </script>");
                }else{
                  $_SESSION['error'] = "ไฟล์ขนาดใหญ่เกินไป";
                  header("location: project.php");
                }
              }else{
                $_SESSION['error'] = "มีข้อมูลชื่อนี้อยู่แล้วในระบบ";
                header("location: project.php");
              }
            }else{
              $_SESSION['error'] = "กรุณาอัพไฟล์ที่เป็นสกุลpdfด้วย";
                header("location: project.php");
            }
        }
    }  
?>

