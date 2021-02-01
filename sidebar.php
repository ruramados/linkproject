<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white p-0 sidebar collapse shadow">
      <div class="position-sticky">	
       <ul class="nav flex-column mb-3">
        <div class="fix shadow mb-4 mx-0"> 
        <a href="#"><img src='./imges/LinkProject-10.png'class="img-fluid wtc_logo mb-4 mt-3" alt="linkproject_logo"></a>
        </div>
        <img src="http://placekitten.com/200/200" class="img-fluid rounded-circle cat_logo px-3" alt="profile_card">
       </ul>
       <ul class="nav flex-column mb-4 info-text">
       <?php
         $userL = $_SESSION['username'];
         $sql1 = "SELECT * from users
         where `username` = '$userL'"; 
         $result1 = $conn->query($sql1) or die($conn->error);

         if ($result1->num_rows > 0) {
          while($row = $result1->fetch_assoc()) {
            echo '<ul class="nav flex-column mb-1 bg-primary text-white">
            <h3 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 ">
            <span>'.$row['first_name'].''.$row['last_name'].'</span>
            </h3>
            <li class="px-3"><span>'.$row['role'].'</span></li></ul>';
            echo '<h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 ">
            <span>ข้อมูลติดต่อ</span>
            </h5>';
            echo '<li class="text-break nav-item px-3">
            <span>ที่อยู่:<br>'.$row["address"].'</span>
             </li>';
            echo '<li class="text-break nav-item px-3">
            <span>เบอร์โทรศัพท์:'.$row["phone_number"].'</span>
             </li>';
            echo '<li class="text-break nav-item px-3 mb-3">
            <span>อีเมล:'.$row["email"].' </span>
            </li>';
          }
        }
        ?>
        <a class="p-2 text-dark" href="engineer.php">ข้อมูลengineer</a>
       </ul>
      <ul class="nav flex-column mb-4 info-text">
        <li class="nav-item px-3">
          <a class="nav-item" href="login_form.html">
              <i data-feather='log-out' class="red-text" aria-hidden="true"></i>
            <span><a href="index.php?logout='1'" class="nav-item" >Log Out</a></span>
          </a>
        </li>
      </ul>
      </div>
</nav>