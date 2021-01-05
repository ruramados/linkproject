<?php 
    include('dbb.php');
?>

<!DOCTYPE html>
<html >
<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>  <!--icon-->
    <link rel="stylesheet" href="index.css">
</head>
<body>
  
  <?php include('navbar.php') ?>
  <div class="container-fluid">
    <div class="row">
      <?php include('sidebar.php') ?>
      <main class="col-md-9 ml- sm-auto col-lg-10 px-md-4">
    	  <div class="search-box">
			   <div class="d-flex justify-content-end ">
			    <div class="searchbar mt-3">
            <input class="search_input" id="search1" type="text" name="search1" placeholder="ค้นหา">
            <div class="search_icon"><i data-feather="search"></i></div>
			    </div>
         </div>
        </div>
        <?php 
        $stmt=$conn->prepare("SELECT row_number() over(order by company_name asc) as 'rows',d.po_number,a.company_name,c.part_number,c.serial_number
        ,b.hostname,b.ip_address,b.os_firmware,b.start_date,b.end_date,concat(e.building,' ',e.room) as locations,company_id
        from customer_company a
        inner join inventory b on a.inventory_id = b.inventory_id
        inner join stock c on b.stock_id = c.stock_id
        inner join po d on a.po_id = d.po_id
        inner join location e on a.location_id = e.location_id");
         $stmt->execute();
         $result2=$stmt->get_result();
        ?>
         <div class="table-responsive ">
          <table class="table table-hover table-borderless shadow-sm" id="table1">
            <thead>
                <tr class="text-truncate">
                    <th>NO</th>
                    <th>PO. Number</th>
                    <th>Customer</th>
                    <th>Part No.</th>
                    <th>Serial No.</th>
                    <th>Hostname</th>
                    <th>IP Address</th>
                    <th>OS firmware</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php while($row = mysqli_fetch_array($result2)): ?>
              <tbody>
                <?php $c;  ?>
               <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                  <td><?php echo $row['rows'] ?></td>
                  <td><?php echo $row['po_number'] ?></td>
                  <td><?php echo $row['company_name'] ?></td>
                  <td><?php echo $row['part_number'] ?></td>
                  <td><?php echo $row['serial_number'] ?></td>
                  <td><?php echo $row['hostname'] ?></td>
                  <td><?php echo $row['ip_address'] ?></td>
                  <td><?php echo $row['os_firmware'] ?></td>
                  <td><?php echo $row['start_date'] ?></td>
                  <td><?php echo $row['end_date'] ?></td>
                  <td><?php echo $row['locations'] ?></td>
                  <td>
                  <a href="?edit_id=<?php echo $row["company_id"]; ?>"><i data-feather="edit"></i></a>
                  </td>
                </tr> 
                </tbody> 
            <?php endwhile;?>
          </table>
         </div>
      </main>
    </div>
  </div>
 
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p>sdad</p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
  feather.replace()
</script>
<script src="index.js"></script>       
</body>
</html>