<?php 
    session_start();
    include('dbb.php');
    
    if (isset($_POST['reg_user'])) {
        if (strlen($_POST["password"]) <= '8') {
            $_SESSION['passwordErr'] = "รหัสผ่านจะต้องมีตัวอักษรมากกว่า 8 ตัวขึ้นไป";
            header('location: signup.php');
        }else if(strlen($_POST["password"]) >= '21'){
            $_SESSION['passwordErr'] = "รหัสผ่านจะต้องไม่เกิน 20 ตัว";
            header("location: signup.php");
        }elseif(!preg_match("#[0-9]+#", $_POST["password"])){
            $_SESSION['passwordErr'] = "รหัสผ่านจะต้องมีตัวเลขอย่างน้อย1ตัว";
            header('location: signup.php');
        }else{
        if(str_contains($_POST["email"],'@wtc.co.th')){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // if user exists
            if ($result['username'] === $username) {
                $_SESSION['userErr'] = "ชื่อผู้ใช้นี้ใช้งานไปแล้ว";
                header("location: signup.php");
            }
            if ($result['email'] === $email) {
                $_SESSION['emailErr'] = "อีเมลนี้ใช้งานไปแล้ว";
                header("location: signup.php");
            }
        }else{
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
            $role = mysqli_real_escape_string($conn, $_POST['role']);
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, `password`,first_name,last_name,`address`,phone_number,`role`) 
            VALUES ('$username', '$email', '$hash','$firstname','$lastname','$address','$phone','$role')";
            mysqli_query($conn, $sql);
          //  $_SESSION['hash'] = $hash;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header('location: index.php');
        }
    }else{
        $_SESSION['emailErr'] = "กรุณากรอกอีเมล@wtcด้วย";
        header('location: signup.php');
    }
    }
}
?>