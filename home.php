<html lang="en">
<head>
<meta charset="UTF-8"> <!--thai lang-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">

</head>
<body>


    <div class="container-fluid">
    <div class="row">
    <?php include('sidebar.php') ?>
    <main class="col-md-9 ml- sm-auto col-lg-10 px-md-4">
    <div class="container">
     <div class="row">
        <div class="col-md-4">
            <a href="devicelist.php"><img src='./imges/addlist.png'class="wtc_logo mb-4 mt-3 rounded-circle img-thumbnail" width="140" height="140" alt="devicelist_logo"></a>
            <h2>DeviceList</h2>
        </div>
        <div class="col-md-4">
            <a href="reportdevice.php"><img src='./imges/report.png'class="wtc_logo mb-4 mt-3 rounded-circle img-thumbnail" width="140" alt="reportdevice_logo"></a>
            <h2>Report Device</h2>
        </div>
        <div class="col-md-4">
            <a href="checkstock.php"><img src='./imges/stock.png'class="wtc_logo mb-4 mt-3 rounded-circle img-thumbnail" width="140" alt="checkstock_logo"></a>
            <h2>Check stock</h2>
        </div>
        <div class="col-md-4">
            <a href="devicelist.php"><img src='./imges/chart.png'class="wtc_logo mb-4 mt-3 rounded-circle img-thumbnail" width="140"  alt="dashboard_logo"></a>
            <h2>Dashboard</h2>
        </div>
     </div>
    </div>
    </main>
    </div>
    </div>
</body>
</html>