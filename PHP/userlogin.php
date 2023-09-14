<?php
session_start();
if (!isset($_SESSION['username'])) {
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
        body{
            background-color:lightblue;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
           
        }

        .dashboard {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 30px;
        }

        .dashboard-btn {
            margin: 10px;
        }

        .logout-btn {
            margin-top: 20px;
        }

        .logout-btn a {
            color: #007bff;
            text-decoration: none;
        }

        .logout-btn a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard">
        <h2>Welcome <?php echo $_SESSION['username'] ?></h2>

        <div class="dashboard-btn">
            <a href="insert.php" class="btn btn-primary">Apply</a>
        </div>

        <div class="dashboard-btn">
            <a href="update.php" class="btn btn-info">Update</a>
        </div>

        <div class="dashboard-btn">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>