 <?php  include('dbb.php'); ?> 
        <!-- Tab panes -->
        <div class="tab-content">
          <div id="admin" class=" tab-pane active"><br>
          <div class="col-md-8 px-4">
            <h4 class="mb-3">Admin</h4>
            <form action="" post="post">
              <div class="row">
                <div class="mb-3">
                  <label for="customer_name">Customer Name</label>
                  <input type="text" class="form-control" name="customer_name">
                </div>
                <div class="mb-4">
                  <label class="form-label" for="customFile">PO File</label>
                  <input type="file" class="form-control" name="customFile">
                </div>
                <hr class="mb-4">
              </div>
              <button class="btn btn-primary btn-lg btn-block float-right" name="admin_add" type="submit">เพิ่มข้อมูล</button>
            </form>
          </div>
          </div>
            <div id="engineer" class="tab-pane fade"><br>
              <div class="col-md-8 px-4">
              <h4 class="">Engineer</h4>
              <form>
                <div class="row">
                <div class="col-md-4 mb-3 text-truncate">
                    <label for="projectname">Project name</label>
                    <input type="text" class="form-control" id="projectname"  required>
                </div>
                <div class="col-md-4 mb-3">
                  <label>Company</label><select name="po" class="mzone zone form-control">
                    <option></option><option>สวนหลวง</option></select>
                </div>
                <div class="col-md-4 mb-3">
                  <label>Po number</label><select name="po" class="mzone zone form-control">
                    <option></option><option>สวนหลวง</option></select>
                </div>
                  <div class="col-md-4 mb-3">
                    <label for="hostname">Hostname</label>
                    <input type="text" class="form-control" id="hostname"  required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="ip">IP Address</label>
                    <input type="text" class="form-control" id="ip" required>
                  </div>
                  <div class="col-md-4 mb-3 text-truncate">
                    <label for="os_firmware">OS firmware</label>
                    <input type="text" class="form-control" id="os_firmware" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="start_date">Start date(MA) </label>
                    <input type="date" class="form-control" id="start_date" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="expire_date">Expire date(MA) </label>
                    <input type="date" class="form-control" id="expire_date" required>
                  </div>
                  <div class="mb-3">
                  <label class="form-label" for="customFile">Upload backup configure</label>
                  <input type="file" class="form-control" id="customFile">
                  </div>
                  <div class="col-lg-6">
                  <label>Serial No.</label><select name="po" class="mzone zone form-control">
                    <option></option><option>สวนหลวง</option></select>
                </div>
                <div class="col-lg-6 col-md-8 mb-3">
                  <label>Part No.</label><select name="po" class="mzone zone form-control">
                    <option></option><option>สวนหลวง</option></select>
                </div>
               
                
                <hr class="mb-4">
                <h4 class="mb-3"> Location</h4>
                <div class="col-md-4 mb-3">
                    <label for="building">Building</label>
                    <input type="type" class="form-control" id="building" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="room">Room</label>
                    <input type="type" class="form-control" id="room" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="floor">Floor</label>
                    <input type="type" class="form-control" id="floor" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rack">Rack No.</label>
                    <input type="type" class="form-control" id="rack" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="u">U No.</label>
                    <input type="type" class="form-control" id="u" required>
                </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block float-right" type="submit">เพิ่มข้อมูล</button>
              </form>
              </div>
            </div>
            <div id="stockteam" class="tab-pane fade"><br>
            <div class="col-md-8 px-4">
            <h4 class="mb-3">Stock Team</h4>
            <form action="" method="post">
              <div class="row">
              <div class="mb-3">
                <label for="serial_no">Serial No.</label>
                <input type="text" class="form-control" name="serial_no" required>
              </div>
               <div class="mb-3">
                <label for="part_no">Part No.</label>
                <input type="text" class="form-control" name="part_no" required>
              </div>
              </div>
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block float-right" name="stock_add" type="submit">เพิ่มข้อมูล</button>
            </form>
            </div>
            </div>
        </div>
<?php
        if (isset($_REQUEST['admin_add'])) {
          $file_name = $_FILES['customFile']['name'];

         echo ("<script LANGUAGE='JavaScript'>
         window.alert(".$file_name.");
         window.location.href='checkstock.php';
         </script>");         
          
        }
 ?>   
 <?php
    if (isset($_POST['stock_add'])) {
        $serial = mysqli_real_escape_string($conn, $_POST['serial_no']);
        $part = mysqli_real_escape_string($conn, $_POST['part_no']);
        
        $stock_check = "SELECT * FROM stock WHERE serial_number = '$serial' OR part_number = '$part' LIMIT 1";
        $query = mysqli_query($conn, $stock_check);
        $result = mysqli_fetch_assoc($query);
  
        if ($result) { // if user exists
            if ($result['serial_number'] === $serial) {
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('ข้อมูลซ้ำกรุณากรอกใหม่');
              window.location.href='devicelist.php';
              </script>");
              }
            if ($result['part_number'] === $part) {
              echo ("<script LANGUAGE='JavaScript'>
              window.alert('ข้อมูลซ้ำกรุณากรอกใหม่');
              window.location.href='devicelist.php';
              </script>");
            }
        }else{
          $sql = "INSERT INTO stock (serial_number,part_number) VALUES ('$serial', '$part')";
          mysqli_query($conn, $sql);
          echo ("<script LANGUAGE='JavaScript'>
          window.alert('เพิ่มข้อมูลสำเร็จ');
          window.location.href='checkstock.php';
          </script>");
        }
    }
 ?> 
 