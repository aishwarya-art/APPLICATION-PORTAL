<?php

include 'connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$errors = array();

if (isset($_SESSION['username'])) {
    // Fetch user data based on the logged-in username
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM `crud` WHERE name='$username'";
    $result = mysqli_query($con, $sql);
    $user_data = mysqli_fetch_assoc($result);

    if (!$user_data) {
        // Redirect back to dashboard if no user data found
        header('Location: userlogin.php');
        exit;
    }

    // Handling form submission
    if (isset($_POST['submit'])) {
        // Fetch the updated data from the form
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $qualification = $_POST['qualification'];
        $age = $user_data['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $dob = $_POST['dob'];
        $nationality = $_POST['nationality'];
        $languages = $_POST['languages'];
        $skills = $_POST['skills'];
        $work_experience = $_POST['work_experience'];
        $reference = $_POST['reference'];
        $social_profiles = $_POST['social_profiles'];
        $portfolio_url = $_POST['portfolio_url'];
        $availability = $_POST['availability'];
        $salary_expectation = $_POST['salary_expectation'];
        $interests = $_POST['interests'];
        $certifications = $_POST['certifications'];

        $image_name = $_POST['image_name']; 
        $resume_name = $_POST['resume_name']; 

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($image_tmp, 'uploads/' . $image_name);
        } else {
            // Use the existing image name if no new image is uploaded
            $image_name = $user_data['image_name'];
        }
    
        // Handle resume upload
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            $resume_name = $_FILES['resume']['name'];
            $resume_tmp = $_FILES['resume']['tmp_name'];
            move_uploaded_file($resume_tmp, 'uploads/' . $resume_name);
        } else {
            // Use the existing resume name if no new resume is uploaded
            $resume_name = $user_data['resume_name'];
        }
        // Update data in the database
        $sql = "UPDATE `crud` SET name='$name', phone='$phone', email='$email', qualification='$qualification', age='$age', gender='$gender',
         address='$address', dob='$dob', nationality='$nationality', languages='$languages', skills='$skills', work_experience='$work_experience',
          reference='$reference', social_profiles='$social_profiles', portfolio_url='$portfolio_url', availability='$availability', 
          salary_expectation='$salary_expectation', interests='$interests', certifications='$certifications', image_name='$image_name',
           resume_name='$resume_name' WHERE name='$username'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "<script>alert('Record Updated successfully.');window.location.href='userlogin.php';</script>";
        } else {
            die(mysqli_error($con));
        }

        // Refresh the page to reflect updated data
        echo "<script>alert('Record updated successfully.');window.location.href='userlogin.php';</script>";
        exit;
    }

    // Handling delete request
    if (isset($_POST['delete'])) {
        // Delete the user's application data from the database
        $sql = "DELETE FROM `crud` WHERE name='$username'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            // Redirect to dashboard after successful deletion
            header('Location: userlogin.php');
            exit;
        } else {
            die(mysqli_error($con));
        }
    }
} else {
    // Redirect to login page if the user is not logged in
    header('Location: login.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <style>
        /* Add any additional CSS styles for the update page here if needed */
 <style>
        body {
            background-color:lightblue;
        }
        body {
            display: flex;
            justify-content: center;
            
            padding-top: 50px;
        }

        .container {
            max-width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        form label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group p {
            color: red;
            margin: 5px 0 0;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            text-align: center;
        }

        .logout-btn a {
            color: #007bff;
            text-decoration: none;
        }

        .logout-btn a:hover {
            text-decoration: underline;
        }

        .uploaded-files {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .uploaded-files h4 {
            margin-bottom: 10px;
        }

        .uploaded-files img {
            max-width: 100%;
            display: block;
            margin-bottom: 10px;
        }
    </style>
    <title>Update Details</title>
</head>
<body>
    <div class="container">
        <h2>Update Details</h2>
        <form method="post" action="" enctype="multipart/form-data">

	 <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="off" required value="<?php echo isset($name) ? $name : ''; ?>">
                <?php if (isset($errors['name'])) echo '<p>' . $errors['name'] . '</p>'; ?>
            </div>

           
	     <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required value="<?php echo isset($phone) ? $phone : ''; ?>">
                <?php if (isset($errors['phone'])) echo '<p>' . $errors['phone'] . '</p>'; ?>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required value="<?php echo isset($email) ? $email : ''; ?>">
                <?php if (isset($errors['email'])) echo '<p>' . $errors['email'] . '</p>'; ?>
            </div>

            <div class="form-group">
                <label for="qualification">Highest Qualification</label>
                <input type="text" class="form-control" id="qualification" name="qualification" required value="<?php echo isset($qualification) ? $qualification : ''; ?>">
                <?php if (isset($errors['qualification'])) echo '<p>' . $errors['qualification'] . '</p>'; ?>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" required value="<?php echo isset($age) ? $age : ''; ?>">
                <?php if (isset($errors['age'])) echo '<p>' . $errors['age'] . '</p>'; ?>
            </div>

           <div class="form-group">
                <label>Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Male") echo "checked"; ?>>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female") echo "checked"; ?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required value="<?php echo isset($address) ? $address : ''; ?>">
                <?php if (isset($errors['address'])) echo '<p>' . $errors['address'] . '</p>'; ?>
            </div>

            <div class="form-group">
                <label>Upload Image</label><br>
                <input type="file" name="image">
                <?php if (isset($errors['image'])) echo '<p>' . $errors['image'] . '</p>'; ?>
            </div>
            <div class="form-group">
                <label>Upload Resume</label><br>
                <input type="file" name="resume">
                <?php if (isset($errors['resume'])) echo '<p>' . $errors['resume'] . '</p>'; ?>
            </div>
		
	        <div>
                <label>Date of Birth</label><br>
                <input type="date" class="form-control" name="dob" required value="<?php echo isset($dob) ? $dob : ''; ?>">
                <?php if (isset($errors['dob'])) echo '<p>' . $errors['dob'] . '</p>'; ?>
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" required value="<?php echo isset($nationality) ? $nationality : ''; ?>">
            </div>

            <div class="form-group">
                <label for="languages">Languages (comma-separated)</label>
                <input type="text" class="form-control" id="languages" name="languages" required value="<?php echo isset($languages) ? $languages : ''; ?>">
            </div>

            <div class="form-group">
                <label for="skills">Skills</label>
                <textarea class="form-control" id="skills" name="skills" rows="3" required><?php echo isset($skills) ? $skills : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="work_experience">Work Experience</label>
                <textarea class="form-control" id="work_experience" name="work_experience" rows="3" required><?php echo isset($work_experience) ? $work_experience : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="reference">Reference</label>
                <textarea class="form-control" id="reference" name="reference" rows="3"><?php echo isset($reference) ? $reference : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="social_profiles">Social Media Profiles</label>
                <input type="text" class="form-control" id="social_profiles" name="social_profiles" value="<?php echo isset($social_profiles) ? $social_profiles : ''; ?>">
            </div>

            <div class="form-group">
                <label for="portfolio_url">Portfolio URL</label>
                <input type="text" class="form-control" id="portfolio_url" name="portfolio_url" value="<?php echo isset($portfolio_url) ? $portfolio_url : ''; ?>">
            </div>

            <div class="form-group">
                <label for="availability">Availability</label>
                <select class="form-control" id="availability" name="availability">
                    <option value="Full-time" <?php if (isset($availability) && $availability == "Full-time") echo "selected"; ?>>Full-time</option>
                    <option value="Part-time" <?php if (isset($availability) && $availability == "Part-time") echo "selected"; ?>>Part-time</option>
                    <option value="Freelance" <?php if (isset($availability) && $availability == "Freelance") echo "selected"; ?>>Freelance</option>
                </select>
            </div>

            <div class="form-group">
                <label for="salary_expectation">Salary Expectation</label>
                <input type="text" class="form-control" id="salary_expectation" name="salary_expectation" value="<?php echo isset($salary_expectation) ? $salary_expectation : ''; ?>">
            </div>

            <div class="form-group">
                <label for="interests">Interests/Hobbies</label>
                <textarea class="form-control" id="interests" name="interests" rows="3"><?php echo isset($interests) ? $interests : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="certifications">Certifications</label>
                <textarea class="form-control" id="certifications" name="certifications" rows="3"><?php echo isset($certifications) ? $certifications : ''; ?></textarea>
            </div>

            <a href="update.php">submit</a>
    </form>
	
	
        <div class="logout-btn">
            <a href="userlogin.php">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>