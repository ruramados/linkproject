<?php
    session_start();  
    include('dbb.php');

    if($_SESSION['role'] != 'engineer'){
      header('location: index.php');
    }
    
    if(isset($_REQUEST['company_id'])){
        $company_id = $_REQUEST['company_id'];
        $sql = ("SELECT a.company_name,a.po_number,c.part_number,b.serial_number,b.hostname,b.ip_address,b.start_date,b.end_date,b.os_firmware,d.building,d.room,d.floor,d.rack_number,d.u_number
        FROM company a 
        inner join inventory b on a.serial_number = b.serial_number
        inner join stock c on b.serial_number = c.serial_number
        inner join location d on b.serial_number = d.serial_number
        where `company_id` = '$company_id'");
        $result = mysqli_query($conn,$sql);
    }
?>
<?php include('header.php'); ?>
<body>

<?php include('navbar.php') ?>
<div class="container-fluid">
 <div class="row">
  <?php include('sidebar.php') ?>
  <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-md-5 mt-5">
        <div class="row bg-white px-5">
         <h2 class="text-center mt-5">FIELD SERVICE REPORT</h2>
         <?php while($row = mysqli_fetch_array($result)): ?>
         <div class="col-md-6 my-2">
         <p>Company Name :<?php echo $row['company_name'] ?></p>
         </div>   
         <div class="col-md-6 my-2">
         <p>Po Number :<?php echo $row['po_number'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>Part Number :<?php echo $row['part_number'] ?></p>
         </div>   
         <div class="col-md-6 my-2">
         <p>Serial Number :<?php echo $row['serial_number'] ?></p>
         </div> 
         <div class="col-md-6 my-2">
         <p>Host Name :<?php echo $row['hostname'] ?></p>
         </div>   
         <div class="col-md-6 my-2">
         <p>IP Address :<?php echo $row['ip_address'] ?></p>
         </div>  
         <div class="col-md-6 my-2">
         <p>Start date(MA) :<?php echo $row['start_date'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>Expire date(MA) :<?php echo $row['end_date'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>OS Firmware :<?php echo $row['os_firmware'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>Building :<?php echo $row['building'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>Room :<?php echo $row['room'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>Floor :<?php echo $row['floor'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>Rack No. :<?php echo $row['rack_number'] ?></p>
         </div>
         <div class="col-md-6 my-2">
         <p>U No. :<?php echo $row['u_number'] ?></p>
         </div>
         <?php endwhile;?>     
        </div>
        <div class="d-flex justify-content-end">
        <form method="post" action="exportpdf.php">
        <button type="submit" class="btn btn-primary button-circle btn-lg btn-block float-right mx-3 mt-3" name="export_pdf" value="<?php echo $company_id ?>">Export PDF</button>
        </form>
        </div>

        <?php include('searchbox.php') ?>
        <?php
        $stmt=$conn->prepare("SELECT row_number() over(order by serial_number asc) as 'rows',serial_number,part_number
        from stock limit 5");
        $stmt->execute();
        $result2=$stmt->get_result();
        ?>
         <div class="table-responsive">
          <table class="table table-hover table-borderless shadow-sm" id="table2">
            <thead>
              <tr class="text-truncate">
                  <th>No.</th>
                  <th>Serial No.</th>
                  <th>Part No.</th>
              </tr>
            </thead>
            <?php while($row = mysqli_fetch_array($result2)): ?>
              <tbody>
               <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                  <td><?php echo $row['rows'] ?></td>
                  <td><?php echo $row['serial_number'] ?></td>
                  <td><?php echo $row['part_number'] ?></td>
               </tr> 
              </tbody> 
            <?php endwhile;?>
          </table>
          <?php
        if(isset($_SESSION['username'])){
        $company_id = $_REQUEST['company_id'];
        $stmt=$conn->prepare("SELECT concat(c.first_name,c.last_name) as fullname,b.start_date,b.status,b.comment,b.user_id
        from company a
        inner join work b on a.user_id = b.user_id
        inner join users c on a.user_id = c.user_id
        where company_id = ?");
        $stmt->bind_param("s",$company_id);
        $stmt->execute();
        $result3=$stmt->get_result();
        }
        ?>
         </div>
         <div class="bg-white card shadow-sm">
         <?php while($row = mysqli_fetch_array($result3)): ?>
           <div class="card-header pt-3">
           <h2 class="card-title text-center">การปฏิบัติงาน</h2>
           </div>
           <div class="card-body card-pad" id="cardwork">
             <div class="row">
               <div class="label col-12 col-sm-3 col-md-3 col-xl-2">ชื่อ</div>
               <div class="label col-12 col-sm-9 col-md-9 col-xl-10"><?php echo $row['fullname'] ?></div>
             </div>
             <div class="row mt-2">
               <div class="label col-12 col-sm-3 col-md-3 col-xl-2">เวลาที่เข้า</div>
               <div class="label col-12 col-sm-9 col-md-9 col-xl-10"><?php echo $row['start_date'] ?></div>
             </div>
             <div class="row mt-2">
               <div class="label col-12 col-sm-3 col-md-3 col-xl-2">สถานะ</div>
               <div class="label col-12 col-sm-9 col-md-9 col-xl-10"><?php echo $row['status'] ?></div>
             </div>
             <div class="row mt-2">
               <div class="label col-12 col-sm-3 col-md-3 col-xl-2">comment</div>
               <div class="label col-12 col-sm-9 col-md-9 col-xl-10"><?php echo $row['comment'] ?></div>
             </div>
           </div>
         </div>
         <button type="button" class="btn btn-primary edit_data button-circle btn-lg btn-block float-right mx-3 mt-3 mb-5" id="<?php echo $row['user_id'] ?>" data-toggle="modal" data-target="#editwork">Edit</button>
         <?php endwhile;?>
    </main>
 </div>
</div>

<div class="modal fade" id="editwork" tabindex="-1" role="dialog" aria-labelledby="editwork" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">การปฏิบัติงาน</h5>
          <button type="button" class="buttonclose" data-dismiss="modal" aria-label="Close">
            <span class="close" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="projectinfoedit.php" method="post">
          <div class="row">
            <div class="mb-3">
              <label for="start_date">เวลาที่เข้า</label>
              <input type="date" class="form-control" name="start_date" id="start_date" required>  
            </div>
            <div class="mb-3">
              <label for="status">สถานะ</label>
              <select name="status" class="serialnumber form-control" required>
                <option value=""></option>
                <option>ไม่สำเร็จ</option>
                <option>สำเร็จ</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="comment">คอมเม้น</label>
              <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>  
            </div>
          </div>
          <input type="hidden" name="user_id" id="user_id">  
          <hr class="mb-4">
          <button type="submit" class="btn btn-primary button-circle btn-lg btn-block float-right mx-3" name="updatework">Edit</button>
          <button type="button" class="btn btn-secondary button-circle btn-lg btn-block float-right" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
    </div>
  </div>
<script>


$(document).on('click', '.edit_data', function(){  
  var editwork = $(this).attr("id");  
    $.ajax({  
      url:"projectinfoedit.php",  
      method:"POST",  
      data:{editwork:editwork},  
      dataType:"json",  
      success:function(data){    
        $('#comment').val(data.comment);
        $('#start_date').val(data.start_date);
        $('#user_id').val(data.user_id);   
      }  
    });  
});  

$(document).ready(function(){
    $("#search1").keyup(function(){
      var search1 = $(this).val();
      $.ajax({
        url:'projectinfosearch.php',
        method:'post',
        data:{search1:search1},
        success:function(response){
            $("#table2").html(response);
          }
      });
  }); 
});
</script>
</body>     
</html>




