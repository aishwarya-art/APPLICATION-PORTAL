<?php include'connect.php';


?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>  Dashboard  </title>
    <link rel="stylesheet" href="style.css">
   
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <?php
 ?>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name"> Operations</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="display.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Display</span>
          </a>
        </li>
          <li>
          <a href="search.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">search</span>
          </a>
        </li>
        <li>
          <a href="sortfunction.php">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name"> Sort</span>
          </a>
      </li> 
      <li>
          <a href="filter.php">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Filter</span>
          </a>
      </li> 
        </li><li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>   
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      
      <div class="profile-details">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHA9B5TkRVk441MESfnaicjCr9xt6CKdXu0g&usqp=CAU" alt="">
        <span class="admin_name"><?php echo $_SESSION['username'] ?></span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    <div class="cards">
      <?php
        // Fetch total count of users 
        $sql_users = "SELECT COUNT(*) as total_users FROM register where user_type='user'";
        $result_users = mysqli_query($con, $sql_users);
        $row_users = mysqli_fetch_assoc($result_users);
        $total_users = $row_users['total_users'];

        // Fetch total number of rows in 'crud' table
        $sql_rows = "SELECT COUNT(*) as total_rows FROM crud";
        $result_rows = mysqli_query($con, $sql_rows);
        $row_rows = mysqli_fetch_assoc($result_rows);
        $total_rows = $row_rows['total_rows'];

        $sql_admin = "SELECT COUNT(*) as total_admin FROM register where user_type='admin'";
        $result_admin = mysqli_query($con, $sql_admin);
        $row_admin = mysqli_fetch_assoc($result_admin);
        $total_admin = $row_admin['total_admin'];
      ?>
      
    <div class="home-content" style=" margin-left:100px; margin-right:80px;">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class=""></div>
          
            <div class="number"><p><strong>Total Users:</strong></div>
            <span><?php echo $total_users; ?></span>
            <div class="">
              <i class=''></i>
              <span class="text"></span>
            </div>
          </div>
          <i class=''></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic"></div>
            <div class="number"><p><strong>Total Applications:</strong></div>
            <span><?php echo $total_rows; ?></span>
            <div class="">
              <i class=''></i>
              <span class="text"></span>
            </div>
          </div>
          <i class='' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic"></div>
            <div class="number" ><p><strong>Total Admins:</strong></div>
            <span><?php echo $total_admin; ?></span>
            <div class="">
              <i class=''></i>
              <span class="text"></span>
            </div>
          </div>
          <i class='' ></i>
        </div>
        </div>
                <div class="welcome-text"style=" 
                display:flex;
                justify-content: center; margin-top:50px;" >
                    <p>
                    <strong>Welcome </strong>
                        This Platform offers a user-friendly
                        interface that allows applicants to submit their details, while empowering administrators with
                        powerful tools to manage applications efficiently. 
                    <br><br>
                    For Admins:
                    <br><br>
                    <strong>1. View Applications:</strong> With just a few clicks, the admin dashboard offers a comprehensive view of all submitted applications. 
                    <br><br>
                    <strong>2. Delete Applications:</strong> If necessary, administrators have the authority to remove applications that do not meet the desired criteria. <br><br>
                    <strong>3. Search and Filter:</strong> Easily locate specific applications based on keywords or other criteria.
                    <br><br>
                    <strong>4. Sort Applications: </strong>Organize applications based on specific attributes such as qualifications, work experience, or any other relevant factors.
                    <br><br><strong>Created By: Aishwarya MS</strong>
                    </p>  </div>
                    </div>  
                    </div>
                    </div>
            </section>
<!-- TABLE START -->

          <script>
          let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
          sidebar.classList.toggle("active");
          if(sidebar.classList.contains("active")){
          sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
        }else
          sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
        </script>

</body>
</html>
