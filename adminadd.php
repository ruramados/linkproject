<?php
    session_start();
    include('dbb.php');
  
  if (isset($_POST['admin_add'])) {
    $company = $_POST['customer_name'];
    $po_number = $_POST['po_number'];
    $file_name = $_FILES['customFile']['name'];
    $file_tmp = $_FILES['customFile']['tmp_name'];
    $file_size = $_FILES['customFile']['size'];
    $file_seperate = explode('.',$file_name); //แยก . กับชื่อ
    $file_ext = strtolower(end($file_seperate)); //ค่าสกุลไฟล์
    $ext_allow = array('pdf');  //condition allow only pdf file
    $path = "po/" . $file_name; //path to save
    print_r($file_ext);
    if(in_array($file_ext,$ext_allow)){
      if (!file_exists($path)){
        if ($file_size < 500000){ // check lower than 5kb
          $path_folder = move_uploaded_file($file_tmp,$path); //store in folder
          $stmt_po = $conn->prepare("INSERT INTO po (po_number,po_file) values (?,?)");
          $stmt_po->bind_param("ss", $po_number, $path);
          $stmt_po->execute(); 
          $stmt_company = $conn->prepare("INSERT INTO company (company_name,po_number) values (?,?)");
          $stmt_company->bind_param("ss", $company,$po_number);
          $stmt_company->execute();
          echo ("<script LANGUAGE='JavaScript'>
            window.alert('เพิ่มข้อมูลสำเร็จ');
            window.location.href='admin.php';
            </script>");
        }else{
          $_SESSION['error'] = "ไฟล์ขนาดใหญ่เกินไป";
          header("location: admin.php");
        }
      }else{
        $_SESSION['error'] = "มีข้อมูลชื่อนี้อยู่แล้วในระบบ";
        header("location: admin.php");
      }
    }else{
      $_SESSION['error'] = "กรุณาอัพไฟล์ที่เป็นสกุลpdfด้วย";
        header("location: admin.php");
    }
  }
?>