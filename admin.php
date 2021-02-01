<?php    
  session_start();
  include('dbb.php');
  
  if($_SESSION['role'] != 'admin'){
    header('location: index.php');
  }
?> 
<?php require 'header.php'; ?>
<body>
  <?php include('navbar.php') ?>
  <div class="container-fluid">
    <div class="row">
      <?php include('sidebar.php') ?>
      <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-md-5 mt-3">
       <div class="card d-flex container">
       <h2 class="mt-4 mb-4 px-3">Admin</h2>
        <form action="adminadd.php" method="post" enctype="multipart/form-data">
          <div class="container">
            <div class="mb-3">
              <label for="customer_name">Customer Name</label>
              <input type="text" class="form-control" name="customer_name" required>
            </div>
            <div class="mb-3">
              <label for="po_number">Po number</label>
              <input type="text" class="form-control" name="po_number" required>
            </div>
            <div class="mb-4">
              <label class="form-label" for="customFile">PO File</label>
              <input type="file" class="form-control" name="customFile" required>
              <?php if(isset($_SESSION['error'])) { ?>
            <p class="mt-2 text-danger" ><?php echo $_SESSION['error']; 
                 unset($_SESSION['error']); ?></p>
            <?php } ?>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block float-right button-circle mb-4" name="admin_add" type="submit">เพิ่มข้อมูล</button>
          </div>
        </form>
       </div>
     </main>
    </div>
   </div>
</body> 
</html>

