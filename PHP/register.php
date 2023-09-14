<?php

include 'connect.php';

$errors = array();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    $user_type = $_POST['user_type'];

    // Validation for Name (Only alphabets, spaces, and underscores)
    if (!preg_match('/^[A-Za-z _]+$/', $username)) {
        $errors['username'] = "Please enter a valid  user name (only alphabets, spaces, and underscores).";
    }

    // Validation for Password 
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $errors['password'] = "Please enter minimum eight characters, at least one letter and one number";
    }

    // Validation for Email (Valid email format)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if ($password != $confirmpassword) {
        $errors['confirmpassword'] ="The two passwords do not match.";
      }

      $user_check_query = "SELECT * FROM register WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($con, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      
      if ($user) { // if user exists
        if ($user['username'] === $username) {
          $errors['username']="Username already exists";
        }
    
        if ($user['email'] === $email) {
          $errors['email']="email already exists";
        }
      }

    if (empty($errors)) {
        $sql = "INSERT INTO `register` (username,email,password,confirmpassword,user_type) VALUES ('$username', '$email','$password','$confirmpassword','$user_type')";
        $result = mysqli_query($con, $sql);
        
        if ($result) {
            // echo "data inserted successfully";
            
            echo "<script>alert('Registered successfully.');window.location.href='login.php';</script>";
            exit;
        } else {
            die(mysqli_error($con));
        }
    }
}
session_destroy();
?>

<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title>register</title>
</head>
<body style="background-color:lightblue;">
<div>
    <br>
    <br><br>
<div class="box" style="border:2px solid white;border-radius:20px; width:600px;height:600px;display: flex;
            background-color:white;">
           <div style="display: flex;justify-content:center; align-items:center;">
    <form method="post">
    <h2 class="">Register</h2>
    <form>
 <div>
            <label>Name</label><br>
            <input type="text" class="form-control" placeholder="enter user name" name="username"  autocomplete="off" required value="<?php echo isset($username) ? $username : ''; ?>">
            <?php if (isset($errors['username'])) echo '<p>' . $errors['username'] . '</p>'; ?>
    </div>

        <br>
        <div>
            <label>Email</label><br>
            <input type="text" class="form-control" placeholder="enter your email ID" name="email"  required value="<?php echo isset($email) ? $email : ''; ?>">
            <?php if (isset($errors['email'])) echo '<p>' . $errors['email'] . '</p>'; ?>
        </div>
        <br>
        
        <div>
            <label>Password</label><br>
            <input  type="password" class="form-control" placeholder="enter your password" name="password" required  value=" " id="myInput" <?php echo isset($password) ? $password : ''; ?>">
            <input type="checkbox" onclick="myFunction()">Show Password 
            <?php if (isset($errors['password'])) echo '<p>' . $errors['password'] . '</p>'; ?>
        </div>
        <br>
        <div>
            <label>Confirm Password</label><br>
            <input type="password" class="form-control" placeholder="Renter your password" name="confirmpassword" required value=" " id="confirm"<?php echo isset($confirmpassword) ? $confirmpassword : ''; ?>">
            <input type="checkbox" onclick="myFunctionconfirm()">Show Password 
            <?php if (isset($errors['confirmpassword'])) echo '<p>' . $errors['confirmpassword'] . '</p>'; ?>
        </div>
        <br>
        <div>
          <label>select user</label>
        <select name="user_type">
      
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      </div>
        <tr class="tablerow">
	    <td align="right"></td>
	    <td><input type="checkbox" name="terms" required> I accept Terms and Conditions</td>
      </tr>
      <br>
        <button type="submit" class="btn btn-primary"name="submit">Register</button><br>
        <div >Already have an account? <a href="login.php">Sign in</a></div>
    </form>
        <br>
        <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
        }

        function myFunctionconfirm() {
        var x = document.getElementById("confirm");
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
        }
</script>
        <br>
        
    </form>
    </div>
    </div>
</div>
</body>
</html>
