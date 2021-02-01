<?php
    session_start();
    include('dbb.php');

    if(isset($_REQUEST['delete'])){
    $serial = $_REQUEST['delete'];
    $sql = ("SELECT b.po_file,c.config
    FROM company a
	  inner join po b on a.po_number = b.po_number
    inner join inventory c on a.serial_number = c.serial_number
    where a.serial_number = '$serial' ");
    $query = mysqli_query($conn, $sql);
    

    if (mysqli_num_rows($query) > 0) { 
        // get path from database
        while($row = mysqli_fetch_assoc($query)) {
          $config = $row['config'];
          $po_file = $row['po_file'];
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
     }
     if(!unlink($po_file)){ // delete path in folder
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('ไม่พบข้อมูลไฟล์ที่เก็บเอาไว้');
        window.location.href='project.php';
        </script>");
     }
    
    $stmt = $conn->prepare("DELETE `inventory`, `location`, `company`,`stock`,`work`
    FROM `inventory` 
    inner join `location` on location.serial_number = inventory.serial_number 
    inner join `company` on company.serial_number = inventory.serial_number 
    inner join `stock` on stock.serial_number = inventory.serial_number
    inner join `work` on work.user_id = company.user_id
    WHERE inventory.serial_number = ?");
    $stmt->bind_param("s",$serial);
    $stmt->execute();
    echo ("<script LANGUAGE='JavaScript'>
            window.alert('ลบข้อมูลสำเร็จ');
            window.location.href='project.php';
            </script>");
    }
?>