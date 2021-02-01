<?php
    session_start();
    include('dbb.php');
    
    if (isset($_SESSION['username'])){
        header('location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"> <!--thai lang-->
    <link rel="stylesheet" href="logsign.css">
</head>
<body>

    <form action="login_db.php" method="post">
    <div class="login-form">
        <img src='./imges/LinkProject-10.png'class="pt-3 mx-auto d-block mb-2" width="260px" alt="linksale_logo">
        <h3 class="text-center  mb-4"><b>เข้าสู่ระบบ</b></h3>
     <div class="login-input">
        <?php if(isset($_SESSION['Err'])) { ?>
            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['Err']; 
                 unset($_SESSION['Err']); ?></div>
        <?php } ?>
        <label for="username" class="visually-hidden">username</label>
        <input type="text" class="mb-3 form-control" name="username" value="<?php if (isset($_COOKIE['username'])) { echo $_COOKIE['username']; } ?>" placeholder="ชื่อผู้ใช้" require>
        <label for="psw" class="visually-hidden">Password</label>
        <input type="password" class="form-control" name="password" value="<?php if (isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" id="inputPassword"  placeholder="รหัสผ่าน" required> 
     </div>
     <div class="remember d-flex mb-4">
        <input type="checkbox" name="remember" <?php if (isset($_COOKIE['user_login'])) { ?> checked <?php } ?> class="form-check-input mr-1" id="remember">
        <label class="form-check-label" for="remember">จดจำรหัส</label>
        <div class="ml-auto"><a class="text-primary text-decoration-none" href="forget.php">ลืมรหัสผ่าน?</a></div>
     </div>
     <div class="login-button">
        <button type="submit" name="login_user" class="logbut btn btn-primary rounded-0 mb-3">เข้าสู่ระบบ<br></button>
    </div>
     <div class="text-center pb-5"><a class="text-decoration-none" href="signup.php"><b>สมัคร</b></a></div>
    </div>
    </form>
</body>
</html>
