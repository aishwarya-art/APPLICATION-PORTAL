<?php
 
require "connect.php";
if(isset($_POST["submit"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $user_type = $_POST['user_type'];
    $result=mysqli_query($con,"SELECT * from register WHERE username='$username' ");
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($row['user_type'] == 'admin'){

            $_SESSION['username'] = $row['username'];
            
            echo "<script>alert('logged in successfully.');window.location.href='dashboard.php';</script>";
   
         }elseif($row['user_type'] == 'user'){
   
            $_SESSION['username'] = $row['username'];
            
            echo "<script>alert('logged in successfully.');window.location.href='userlogin.php';</script>";
   
         }
  
    }
    else{
        echo "<script> alert('user not registered');</script>";
    }
}

?>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>User Login</title>
    <style>
        body{
        display:flex;
  justify-content: center;
       }
        .box{
           display: flex;
           justify-content: center;   
        }
    </style>
    
</head>
<body style="background-color:lightblue;">
<div>
<br>
<br>
<br>
<br>
    <div class="box" style="border:2px solid white;border-radius:20px; width:500px;height:500px;display: flex;
            background-color:white;">
           <div style="display: flex;justify-content:center; align-items:center;">
    <form  method="post" action='' autocomplete="off">
     <br>
        <h3 text-align="center">LOGIN</h3>
        <br>
        User Name:<br>
        <br>
        <input type="text" name="username" id="username"required>
        <?php if (isset($errors['username'])) echo '<p>' . $errors['username'] . '</p>'; ?>
        <br>
        <br>
        Password:<br><br>
        <input type="password" name="password" id="myInput" required>
        <input type="checkbox" onclick="myFunction()">Show 
        <?php if (isset($errors['password'])) echo '<p>' . $errors['password'] . '</p>'; ?>
        <?php if (isset($errors['login'])) echo '<p>' . $errors['login'] . '</p>'; ?>
        <br><br>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <input type="submit" name="submit" class="btn btn-primary"value="Login">
        <input type="reset"class="btn btn-primary">
        <br><br>
        <p>
            Not yet a member? <a href="register.php">Sign up</a>
        </p>
        <br>
    </form>
        <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
        }
        </script>
   
    </div>
    </div>
    <div>
</body>
</html>

