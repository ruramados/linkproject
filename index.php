<?php 
    session_start();
    include('dbb.php');

    if (!isset($_SESSION['username'])){
        header('location: login.php');
    }

    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == 'admin'){
            header('location: admin.php');
        }
        if($_SESSION['role'] == 'engineer'){
            header('location: project.php');
        }
        if($_SESSION['role'] == 'stockteam'){
            header('location: checkstock.php');
        }
    }
   
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['admin']);
        unset($_SESSION['engineer']);
        unset($_SESSION['stockteam']);
        header('location: login.php');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>error failed to go page</p>
</body>
</html>