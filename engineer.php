<?php    
  session_start();
  include('dbb.php');
  
?> 
<?php require 'header.php'; ?>
<body>
  <?php include('navbar.php') ?>
  <div class="container-fluid">
    <div class="row">
      <?php include('sidebar.php') ?>
      <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-md-5 mt-3">
        <?php
            $sql ="SELECT concat(first_name,last_name) as fullname,`user_id`
            from users
            where role = 'engineer'";
            $query = mysqli_query($conn, $sql);
            
        ?>
      <div class="container mt-5">
        <div class="row">
        <?php while($row = mysqli_fetch_array($query)): ?>
         <div class="col-md-4 mb-3">
    		<div class="card">
                <div class="card-body text-center">
                    <img class="img-fluid rounded-circle mb-3" src="https://images.pexels.com/photos/877695/pexels-photo-877695.jpeg?auto=compress&cs=tinysrgb&h=350" alt="Cardimage" style="width: 150px; height: 150px;" >
                    <p><a href="dashboard?user_id=<?php echo $row['user_id'] ?>" class="stretched-link text-decoration-none"><?php echo $row['fullname'] ?></a></p>
                </div>
            </div>
         </div>
         <?php endwhile;?>
       </div>
      </div>
     </main>
    </div>
   </div>
</body> 
</html>

