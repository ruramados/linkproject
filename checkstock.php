<?php     
  session_start();  
  require('dbb.php'); 

  if($_SESSION['role'] != 'stockteam'){
    header('location: index.php');
  }
?> 
<html lang="en">

<?php require 'header.php'; ?>
<body>
  <?php require 'navbar.php'; ?>   
  <div class="container-fluid">
    <div class="row">
      <?php include('sidebar.php') ?>
      <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-md-5 mt-5">       
        <?php include('searchbox.php') ?>
        <?php
        $stmt=$conn->prepare("SELECT row_number() over(order by serial_number asc) as 'rows',serial_number,part_number
        from stock
        LIMIT 15");
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
                  <th></th>
              </tr>
            </thead>
            <?php while($row = mysqli_fetch_array($result2)): ?>
              <tbody>
              <?php $c;  ?>
               <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                  <td><?php echo $row['rows'] ?></td>
                  <td><?php echo $row['serial_number'] ?></td>
                  <td><?php echo $row['part_number'] ?></td>
                  <td>
                  <button type="button" class="btn btn-primary edit_data button-circle" id="<?php echo $row["serial_number"] ?>" data-toggle="modal" data-target="#editstock"><i class="fa fa-edit"></i></button>
                  <a href="checkstockdelete.php?delete_row=<?php echo $row['serial_number'] ?>" class="btn btn-danger button-circle"><i class="fa fa-trash"></i></a>
                  </td>
               </tr> 
              </tbody> 
            <?php endwhile;?>
          </table>
         </div>
         <button type="button" class="btn btn-primary button-circle" data-toggle="modal" data-target="#addstock">Add Item</button>
        </main>
    </div>
  </div>
  
  <div class="modal fade" id="addstock" tabindex="-1" role="dialog" aria-labelledby="addstock" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addstock">Add Stock</h5>
          <button type="button" class="buttonclose" data-dismiss="modal" aria-label="Close">
            <span class="close" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="" method="post" id="addstock">
          <div class="row">
            <div class="mb-3">
              <label for="serial_no">Serial No.</label>
              <input type="text" class="form-control" name="serial_no" required>  
              <p id="error1" class="text-danger mt-2"></p>
            </div>
            <div class="mb-3">
              <label for="part_no">Part No.</label>
              <input type="text" class="form-control" name="part_no" required>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary button-circle btn-lg btn-block float-right mx-3"  type="submit">Add</button>
          <button type="button" class="btn btn-secondary button-circle btn-lg btn-block float-right" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editstock" tabindex="-1" role="dialog" aria-labelledby="editstock" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Stock</h5>
          <button type="button" class="buttonclose" data-dismiss="modal" aria-label="Close">
            <span class="close" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="checkstockedit.php" method="post">
          <div class="row">
            <div class="mb-3">
              <label for="serial_no">Serial No.</label>
              <input type="text" class="form-control" name="serial_no" id="serial_no" required>  
              <p id="error2" class="text-primary"></p>
            </div>
            <div class="mb-3">
              <label for="part_no">Part No.</label>
              <input type="text" class="form-control" name="part_no" id="part_no" required>
            </div>
          </div>
          <input type="hidden" name="id" id="id">  
          <hr class="mb-4">
          <button type="submit" class="btn btn-primary button-circle btn-lg btn-block float-right mx-3" name="stock_edit">Edit</button>
          <button type="button" class="btn btn-secondary button-circle btn-lg btn-block float-right" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
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

$(document).ready(function(){
    $("#search2").keyup(function(){
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

$(document).ready(function(){
    $("#addstock").submit(function(){
      var serial = $('input[name=serial_no]').val();
      var part = $('input[name=part_no]').val();
      event.preventDefault();
      $.ajax({
        url:'checkstockadd.php',
        method:'post',
        data:{serial:serial,part:part},
        success:function(response){           
            if(response == 'f'){
              $("#error1").html('serial number ซ้ำ');
            }else{
              alert('เพิ่มข้อมูลสำเร็จ');
              location.reload();
            }
          }
      });
  }); 
});

$(document).on('click', '.edit_data', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"checkstockedit.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#serial_no').val(data.serial_number);  
                     $('#part_no').val(data.part_number);
                     $('#id').val(data.serial_number);   
                }  
           });  
      });  



</script>       
</body>
</html>