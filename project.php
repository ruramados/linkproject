<?php
  session_start();  
  include('dbb.php');

  if($_SESSION['role'] != 'engineer'){
    header('location: index.php');
  }
?>

<?php require 'header.php'; ?>
<body>

  <?php include('navbar.php') ?>
  <div class="container-fluid">
    <div class="row">
      <?php include('sidebar.php') ?>
      <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-md-5 mt-5">
			   <div class="d-flex justify-content-between align-items-center mb-3">
         <button type="button" class="btn btn-primary button-circle" style="height: 38px;" data-toggle="modal" data-target="#addproject">Add Project</button>
         <div class="search-box">
			    <div class="searchbar">
            <input class="search_input" id="search1" type="text" name="search1" placeholder="ค้นหา">
            <div class="search_icon"><i class="fa fa-search fa-lg"></i></div>
			    </div>
         </div>
        </div>
        <?php
        $sql = "SELECT a.company_id,a.company_name, a.project, a.po_number,concat(b.first_name,' ',b.last_name) as fullname,c.config,c.serial_number
        FROM company a
        inner join users b on a.user_id = b.user_id
        inner join inventory c on a.serial_number = c.serial_number";
        $grouped = [];
        foreach ($conn->query($sql) as $row) {
          $grouped[$row['company_name']][] = [
              'company_id' => $row['company_id'],
              'project' => $row['project'],
              'po_number' => $row['po_number'],
              'fullname' => $row['fullname'],
              'config' => $row['config'],
              'serial_number' => $row['serial_number'] 
          ];
        }// now generate markup..
        ?>

    <div class="accordion" id="accordionExample">
      <?php foreach ($grouped as $companyName => $details) { ?>  
        <div class="card">
          <div class="card-header">
            <h2 class="mb-0">
              <a class="btn" type="button" data-toggle="collapse"
                href="#c<?=$companyName?>" role="button" aria-expanded="false">
                <?=$companyName?>
              </a>
            </h2>
          </div>  
          <div id="c<?=$companyName?>" class="collapse">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover " id="table1">
                  <thead>
                    <tr class="text-truncate">
                      <th>Po</th>
                      <th>ชื่อโครงการ</th>
                      <th>Config</th>  
                      <th>ผู้รับผิดชอบ</th>
                      <th>รายละเอียด</th>
                      <th></th>
                    </tr> 
                  </thead>
                  <tbody>
                    <?php foreach ($details as $i => $detail) { ?>
                      <tr>
                        <td><?=$detail['po_number']?></td>
                        <td><?=$detail['project']?></td>
                        <td><a href="<?=$detail['config']?>" download>ดาวน์โหลด</a></td>
                        <td><?=$detail['fullname']?></td>
                        <td><a href="projectinfo.php?company_id=<?=$detail['company_id']?>" class="btn btn-primary button-circle">ดูข้อมูล</a></td>
                        <td>
                        <a type="submit" href="exportpdf.php?export_pdf=<?=$detail['company_id'] ?>" class="btn btn-primary button-circle  btn-block">PDF</a>
                        <button type="button" class="btn btn-primary edit_data button-circle" id="<?=$detail["serial_number"] ?>" data-toggle="modal" data-target="#editproject"><i class="fa fa-edit"></i></button>
                        <a href="projectdelete.php?delete=<?=$detail['serial_number']?>" class="btn btn-danger button-circle"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody> 
                </table>        
              </div>
            </div>
          </div>
        </div>
      <?php  } ?>  
      </div>
    </main>
    </div>
  </div>
  <div class="modal fade" id="addproject" tabindex="-1" role="dialog" aria-labelledby="addproject" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addproject">Add Project</h5>
          <button type="button" class="buttonclose" data-dismiss="modal" aria-label="Close">
            <span class="close" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="projectadd.php" method="POST" enctype="multipart/form-data">  
                <div class="row">
                <div>
                    <?php 
                    $user_id = $_SESSION['username'];
                    $userid = "SELECT `user_id` from users where username = '$user_id' ";
                    $result = mysqli_query($conn,$userid);
                    while ($row = mysqli_fetch_array($result)){
                       echo "<input type='hidden' class='form-control' name='user_id' value=\"".$row['user_id']."\">";
                    }
                     ?>
                </div>
                <div class="col-md-4 mb-3 text-truncate">
                    <label for="projectname">Project name</label>
                    <input type="text" class="form-control" name="projectname" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label>Company</label>
                  <select name="company_name" class="company_name form-control">
                    <option></option>
                    <?php 
                    $sql = "SELECT distinct company_name from company where `serial_number` IS NULL";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_array($result)){
                      echo '<option>'.$row['company_name'].'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                 <label>Po number</label>
                 <select  id="po_number" name="po_number" class=" form-control">
                 </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="hostname">Hostname</label>
                  <input type="text" class="form-control" name="hostname" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="ip">IP Address</label>
                  <input type="text" class="form-control" name="ip" required>
                </div>
                <div class="col-md-4 mb-3 text-truncate">
                  <label for="os_firmware">OS firmware</label>
                  <input type="text" class="form-control" name="os_firmware" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="start_date">Start date(MA) </label>
                  <input type="date" class="form-control" name="start_date" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="expire_date">Expire date(MA) </label>
                  <input type="date" class="form-control" name="expire_date" required>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="configFile">Upload backup configure</label>
                  <input type="file" class="form-control" name="configFile">
                </div>
                <div class="col-lg-6">
                  <label>Serial No.</label>
                  <select name="serial_number" class="serialnumber form-control" required>
                    <option value=""></option>
                    <?php 
                    $sql = "SELECT a.serial_number from stock a
                    where a.serial_number NOT IN(SELECT b.serial_number from inventory b)";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_array($result)){
                      echo '<option>'.$row['serial_number'].'</option>';
                    }
                     ?>
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                  <label>Part No.</label>
                  <select name="part_number" id="part_number" class="form-control" required>
                  </select>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3"> Location</h4>
                <div class="col-md-4 mb-3">
                    <label for="building">Building</label>
                    <input type="type" class="form-control" name="building" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="room">Room</label>
                    <input type="type" class="form-control" name="room" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="floor">Floor</label>
                    <input type="type" class="form-control" name="floor" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rack">Rack No.</label>
                    <input type="type" class="form-control" name="rack"  required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="u">U No.</label>
                    <input type="type" class="form-control" name="u" required>
                </div>
                </div>
                <hr class="mb-4">
                <button type="submit" class="btn btn-primary button-circle btn-lg btn-block float-right mx-3" name="project_add">Add</button>
                <button type="button" class="btn btn-secondary button-circle btn-lg btn-block float-right" data-dismiss="modal">Close</button>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editproject" tabindex="-1" role="dialog" aria-labelledby="editproject" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editproject">Edit Project</h5>
          <button type="button" class="buttonclose" data-dismiss="modal" aria-label="Close">
            <span class="close" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="projectedit.php" method="POST" enctype="multipart/form-data">  
                <div class="row">
                <div class="col-md-4 mb-3 text-truncate">
                    <label for="projectname">Project name</label>
                    <input type="text" class="form-control" name="projectname" id="projectname" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label>Company</label>
                  <input type="text" class="form-control"  id="company_name" required readonly>
                </div>
                <div class="col-md-4 mb-3">
                 <label>Po number</label>
                 <input type="text" class="form-control"  id="po_number_edit" required readonly>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="hostname">Hostname</label>
                  <input type="text" class="form-control" name="hostname" id="hostname" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="ip">IP Address</label>
                  <input type="text" class="form-control" name="ip" id="ip" required>
                </div>
                <div class="col-md-4 mb-3 text-truncate">
                  <label for="os_firmware">OS firmware</label>
                  <input type="text" class="form-control" name="os_firmware" id="os_firmware" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="start_date">Start date(MA) </label>
                  <input type="date" class="form-control" name="start_date" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="expire_date">Expire date(MA) </label>
                  <input type="date" class="form-control" name="expire_date" required>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="configFile">Upload backup configure</label>
                  <input type="file" class="form-control" name="configFile">
                </div>
                <div class="col-lg-6">
                  <label>Serial No.</label>
                  <input type="type" class="form-control" name="serial_number" id="serial_number" required readonly>
                </div>
                <div class="col-lg-6 mb-3">
                  <label>Part No.</label>
                  <input type="type" class="form-control" id="part_number_edit" required readonly>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3"> Location</h4>
                <div class="col-md-4 mb-3">
                    <label for="building">Building</label>
                    <input type="type" class="form-control" name="building" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="room">Room</label>
                    <input type="type" class="form-control" name="room" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="floor">Floor</label>
                    <input type="type" class="form-control" name="floor" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rack">Rack No.</label>
                    <input type="type" class="form-control" name="rack"  required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="u">U No.</label>
                    <input type="type" class="form-control" name="u" required>
                </div>
                </div>
                <hr class="mb-4">
                <button type="submit" class="btn btn-primary button-circle btn-lg btn-block float-right mx-3" name="project_edit">Edit</button>
                <button type="button" class="btn btn-secondary button-circle btn-lg btn-block float-right" data-dismiss="modal">Close</button>
            </form>
        </div>
      </div>
    </div>
  </div>
 

<script>
$(document).ready(function(){
    $("select.company_name").change(function() { //option for customername to po
    var input = $(this).val(); //get the current value's option
    $.ajax({
      url:'projectoption1.php',
      method:'GET',
        data:{input:input},
        success:function(data){
          $("#po_number").html(data);
        }
    });
});
}); 
</script> 
<script> 
$(document).ready(function(){
$('select.serialnumber').change(function() { 
    var inputvalue = $(this).val(); //get the current value's option
    $.ajax({
        type:'GET',
        url:'projectoption2.php',
        data:{inputvalue:inputvalue},
        success:function(data){
          $("#part_number").html(data);
        }
    });
});
}); 
</script>
<script>
$(document).ready(function(){
    $("#search1").keyup(function(){
      var search1 = $(this).val();
      $.ajax({
        url:'projectsearch.php',
        method:'post',
        data:{search1:search1},
        success:function(response){
            $("#table1").html(response);
          }
      });
  }); 
});
</script>
<script>
$(document).on('click', '.edit_data', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"projectedit.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){
                  $('#company_name').val(data.company_name);
                  $('#po_number_edit').val(data.po_number);   
                  $('#serial_number').val(data.serial_number);  
                  $('#part_number_edit').val(data.part_number);
                }  
           });  
      });  
      </script>
</body>
</html>