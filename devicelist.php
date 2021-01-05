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
    <div class="row">
    <?php include('sidebar.php') ?>

    <div class="container col-md-8 mt-5 ">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#admin">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#engineer">Engineer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#stockteam">Stock Team</a>
          </li>
        </ul>
      <?php include('devicelisttab.php') ?>
      </div>
      </div>
</body>
</html>