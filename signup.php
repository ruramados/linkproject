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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logsign.css">
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-md-7 col-lg-8">
      <div  class="login-form" >
        <img src='./imges/LinkProject-10.png'class="pt-3 mx-auto d-block mb-2" width="260px" alt="linksale_logo">
          <h3 class="text-center mb-4"><b>ลงชื่อเข้าใช้</b></h3>
          <form action="signup_db.php" method="post"> 
            <div class="row sign-input px-5">
            <?php if(isset($_SESSION['userErr'])) { ?>
            <div class="alert alert-danger mb-3" role="alert"><?php echo $_SESSION['userErr']; 
                 unset($_SESSION['userErr']); ?></div>
            <?php } ?>
            <?php if(isset($_SESSION['emailErr'])) { ?>
            <div class="alert alert-danger mb-3" role="alert"><?php echo $_SESSION['emailErr']; 
                 unset($_SESSION['emailErr']); ?></div>
            <?php } ?>
            <?php if(isset($_SESSION['passwordErr'])) { ?>
            <div class="alert alert-danger mb-3" role="alert"><?php echo $_SESSION['passwordErr']; 
                 unset($_SESSION['passwordErr']); ?></div>
            <?php } ?>
              <div class="mb-1">
                <label for="username" class="visually-hidden">username</label>
                <input type="text" class="mb-3 form-control font" name="username" placeholder="ชื่อผู้ใช้" required>
              </div>
              <div class="mb-1">
                <label for="inputEmail" class="visually-hidden">Email address</label>
                <input type="text" class="mb-3 form-control" name="email"  placeholder="อีเมล" required>
              </div>
              <div class="mb-1">
                <label for="psw" class="visually-hidden">Password</label>
                <input type="password" class="mb-3 form-control" name="password"   placeholder="รหัสผ่าน" required>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="firstname" class="visually-hidden">ชื่อ</label>
                <input type="text" class="form-control" name="firstname"  placeholder="ชื่อ" required>
              </div>
              <div class="col-sm-6 mb-3">
                  <label for="lastName" class="visually-hidden">Last name</label>
                  <input type="text" class="form-control" name="lastname"  placeholder="นามสกุล" required>
              </div>
              <div class="mb-3">
                  <label for="address" class="visually-hidden">Address</label>
                  <input type="text" class="form-control" name="address"  placeholder="ที่อยู่" required>
              </div>
              <div class="mb-3">
                  <label for="phone_number" class="visually-hidden">Tel.phone</label>
                  <input type="text" class="form-control" name="phone_number"  placeholder="เบอร์โทร" required>
              </div>
              <div class="col-md-4 mb-3">
                <select name="role" class="company_name form-control inputselect" required>
                  <option>- role -</option>
                  <option>admin</option>
                  <option>engineer</option>
                  <option>stockteam</option>
                </select>
              </div>
              </div>
            <div class="login-button pb-5">
                <button type="submit" name="reg_user" class="sigbut btn btn-primary rounded-0 mr-2"> ลงชื่อเข้าใช้ </button>
                <span class="text-muted mr-2">หรือ</span>
                <a class="text-primary text-decoration-none" href="login.php">เข้าสู่ระบบ</a>
            </div>
        </form>
      </div>
      </div>
   </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-t6I8D5dJmMXjCsRLhSzCltuhNZg6P10kE0m0nAncLUjH6GeYLhRU1zfLoW3QNQDF" crossorigin="anonymous"></script></body>
</body>
</html>