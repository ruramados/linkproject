<?php 
    session_start();
    include('dbb.php');

    if (isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
            if(password_verify($password,$row["password"])){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = $row['role'];
                if(!empty($_POST['remember'])){
                    setcookie("username",$username, strtotime('+20 days'));
                    setcookie("password",$password, strtotime('+20 days'));
                }else{
                    if (isset($_COOKIE['username'])) {
                        setcookie('username','');
                        if (isset($_COOKIE['password'])){
                            setcookie('password','');
                        }
                    }    
                }
                    header("location: index.php");
            }else{
                $_SESSION['Err'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง"; 
                header("location: login.php");
            }
            }
        }elseif(empty($username)){
            $_SESSION['Err'] = "กรุณากรอกชื่อผู้ใช้";
            header("location: login.php");
        }else{
        $_SESSION['Err'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        header("location: login.php");
        }
    }
?>