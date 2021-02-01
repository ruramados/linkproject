<?php 
    session_start();
    include('dbb.php'); 
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
    
    <form action="forget.php" method="post"> 
      <div  class="login-form" >
        <img src='./imges/LinkSale-10.png'class="pt-3 mx-auto d-block mb-2" width="260px" alt="linksale_logo">
        <div class="login-input">
            <div>กรอกอีเมล</div>
            <label for="inputEmail" class="visually-hidden">Email address</label>
            <input type="email" class="mb-3" name="email" id="inputEmail"   placeholder="อีเมล" required>
        </div>
        <div class="login-button pb-5">
            <button type="submit" name="forget_password" class="sigbut btn btn-primary rounded-0 mr-2">ค้นหา</button>
        </div>
      </div>
    </form>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-t6I8D5dJmMXjCsRLhSzCltuhNZg6P10kE0m0nAncLUjH6GeYLhRU1zfLoW3QNQDF" crossorigin="anonymous"></script></body>
</body>
</html>