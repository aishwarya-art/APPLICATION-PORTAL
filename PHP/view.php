<?php
require "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightblue; /* Set light blue background color */
        }
        h1 {
            text-align: center;
            padding: 20px;
        }
        .details-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .details-container p {
            margin: 10px 0;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Details View</h1>
    <div class="details-container">
        <?php
            
            // Check connection
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            // Retrieving the details based on the ID from the 'details' table.
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM crud WHERE id = $id";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p><strong>ID:</strong> " . $row['id'] . "</p>";
                    echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                    // Display other details here as needed.
                    // For example: echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                    // Add more lines for other details you want to display.
                    echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                    echo "<p><strong>Qualification:</strong> " . $row['qualification'] . "</p>";
                    echo "<p><strong>Age:</strong> " . $row['age'] . "</p>";
                    echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
                    echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
                   
                    if (!empty($row['image_name'])) {
                        echo "<p><strong>Image:</strong></p>";
                        echo "<img src='uploads/" . $row['image_name'] . "' style='max-width: 300px;' alt='User Image'>";
                    } else {
                        echo "<p>No image found.</p>";
                    }

                    // Display the resume
                   
                    if (!empty($row['resume_name'])) {
                        echo "<p><strong>Resume:</strong></p>";
                        echo "<iframe src='uploads/" . $row['resume_name'] . "' style='width: 100%; height: 500px;'></iframe>";
                        // Replace "application/pdf" with the appropriate MIME type if the resume is in a different format.
                    } 
                    else{
                        echo "<p>No resume found.</p>";
                    }
                    echo "<p><strong>DOB:</strong> " . $row['dob'] . "</p>";
                    echo "<p><strong>Nationality:</strong> " . $row['nationality'] . "</p>";
                    echo "<p><strong>Languages:</strong> " . $row['languages'] . "</p>";
                    echo "<p><strong>Skills:</strong> " . $row['work_experience'] . "</p>";
                    echo "<p><strong>Work experience:</strong> " . $row['dob'] . "</p>";
                    echo "<p><strong>Reference:</strong> " . $row['reference'] . "</p>";
                    echo "<p><strong>Social profiles:</strong> " . $row['social_profiles'] . "</p>";
                    echo "<p><strong>Availability :</strong> " . $row['availability'] . "</p>";
                    echo "<p><strong>Salary Expectation:</strong> " . $row['salary_expectation'] . "</p>";
                    echo "<p><strong>Interests:</strong> " . $row['interests'] . "</p>";
                    echo "<p><strong>Certificates:</strong> " . $row['certifications'] . "</p>";
                    
                } else {
                    echo "<p>No details found for the given ID.</p>";
                }
            } else {
                echo "<p>Invalid ID.</p>";
            }

            $con->close();
        ?>
        
        <p class="back-link"><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
