<?php include('dbb.php') ?>
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
      <div class="search-box">
        <div class="d-flex justify-content-center">
        <div class="searchbar mt-3">
        <form action="" method="get">
          <label for="serial">serial number: </label>
          <input class="search_input" id="serial" type="text" name="serial" placeholder="ค้นหา">
          <div class="search_icon"><i data-feather="search"></i></div>
          <input type="submit" name="serial_filter" value="search">
        </form>
        </div>
        </div>
      </div>
      <div class="search-box">
		    <div class="d-flex justify-content-end ">
			    <div class="searchbar mt-3">
              <input class="search_input" id="search1" type="text" name="search1" placeholder="ค้นหา">
              <div class="search_icon"><i data-feather="search"></i></div>
			    </div>
        </div>
      </div>
        <?php
        if(isset($_GET['serial_filter'])){
        $search = $_GET['serial'];
        $stmt=$conn->prepare("SELECT row_number() over(order by stock_id asc) as 'rows',serial_number,part_number
        from stock
        where serial_number LIKE CONCAT('%',?,'%')");
          $stmt->bind_param("s",$search);
        }else{ 
        $stmt=$conn->prepare("SELECT row_number() over(order by stock_id asc) as 'rows',serial_number,part_number
        from stock");
        }
        $stmt->execute();
        $result2=$stmt->get_result();
        ?>
         <div class="table-responsive">
          <table class="table table-hover table-borderless shadow-sm" id="table1">
            <thead>
              <tr class="text-truncate">
                  <th>No.</th>
                  <th>Serial No.</th>
                  <th>Part No.</th>
              </tr>
            </thead>
            <?php while($row = mysqli_fetch_array($result2)): ?>
              <tbody>
                <?php $c;  ?>
               <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                    <td><?php echo $row['rows'] ?></td>
                    <td><?php echo $row['serial_number'] ?></td>
                    <td><?php echo $row['part_number'] ?></td>
                </tr> 
                </tbody> 
            <?php endwhile;?>
          </table>
         </div>
        </main>
    </div>
  </div>      
    <script>
$(document).ready(function(){
    $("#search1").keyup(function(){
      var search1 = $(this).val();
      $.ajax({
        url:'checkstocksearch.php',
        method:'post',
        data:{search1:search1},
        success:function(response){
            $("#table1").html(response);
          }
      });
  }); 
});
    </script>       
</body>
</html>