<?php
require "connect.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .back-to-dashboard {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for the button on hover */
        .back-to-dashboard:hover {
            background-color: #444;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightblue; /* Set light blue background color */
        }
        .pagination-links a {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .pagination-links a:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
<a href="dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
<br>
<h3 style="text-align:center;">Filter Data</h3>
<div class="container">
    <br>
    <div class="container">
        <br>
        
        <form method="POST" action="filter.php">
            <div class="form-inline">
                <label>Qualification:</label>
                <select class="form-control" name="qualification">
                    <option value="" disabled selected>Select qualification</option>
                    <!-- Add more qualification options here -->
                    <option value="BE"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="BE"){echo "selected";}?>BE</option>
						<option value="PU"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="PU"){echo "selected";}?>PU</option>
						<option value="SSLC"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="SSLC"){echo "selected";}?>SSLC</option>
						<option value="BCOM"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="BCOM"){echo "selected";}?>BCOM</option>
                        <option value="CA"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="CA"){echo "selected";}?>CA</option>
						<option value="MCA"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="MCA"){echo "selected";}?>MCA</option>
                         <option value="MBBS"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="MBBS"){echo "selected";}?>MBBS</option>
						<option value="BSC"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="BSC"){echo "selected";}?>BSC</option>
                        <option value="BCA"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="BCA"){echo "selected";}?>BCA</option>
						<option value="NURSARY"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="NURSARY"){echo "selected";}?>NURSARY</option>
                        <option value="LLB"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="LLB"){echo "selected";}?>LLB</option>
						<option value="MSC"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="MSC"){echo "selected";}?>MSC</option>
                        <option value="TCH"><?php if(isset($_GET['qualification'])&& $_GET['qualification']=="TCH"){echo "selected";}?>TCH</option>
                </select>

                
                    <!-- Add more gender options here -->
                </select>

                <button class="btn btn-primary" name="filter">Filter</button>
                <button class="btn btn-success" name="reset">Reset</button>
            </div>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limit = 5; // Number of records to display per page
                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page=1;
                }
                $start_from = ($page-1) * $limit;

                if (isset($_POST['filter'])) {
                    $qualification = $_POST['qualification'];
                    

                    // Prepare the base query
                    $sql = "SELECT * FROM `crud` WHERE 1";

                    // Add filters to the query based on selected options
                    if (!empty($qualification)) {
                        $sql .= " AND `qualification`='$qualification'";
                    }

                    $sql .= " LIMIT $start_from, $limit";

                    $query = mysqli_query($con, $sql) or die(mysqli_error());

                    while ($fetch = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $fetch['id'] . "</td>";
                        echo "<td>" . $fetch['name'] . "</td>";
                        echo "<td><a href='view.php?id=" . $fetch['id'] . "'>View</a></td>";
                        echo "</tr>";
                    }
                } elseif (isset($_POST['reset'])) {
                    $query = mysqli_query($con, "SELECT * FROM `crud` LIMIT $start_from, $limit") or die(mysqli_error());

                    while ($fetch = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $fetch['id'] . "</td>";
                        echo "<td>" . $fetch['name'] . "</td>";
                        echo "<td><a href='view.php?id=" . $fetch['id'] . "'>View</a></td>";
                        echo "</tr>";
                    }
                } else {
                    $query = mysqli_query($con, "SELECT * FROM `crud` LIMIT $start_from, $limit") or die(mysqli_error());

                    while ($fetch = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $fetch['id'] . "</td>";
                        echo "<td>" . $fetch['name'] . "</td>";
                        echo "<td><a href='view.php?id=" . $fetch['id'] . "'>View</a>
                        <span style='margin: 5px;'></span>
                        <a href='Delete.php?id=" . $fetch['id'] . "'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <ul class="pagination justify-content-end">
            <?php
            $result_db = mysqli_query($con,"SELECT COUNT(id) FROM `crud`");
            $row_db = mysqli_fetch_row($result_db);
            $total_records = $row_db[0];
            $total_pages = ceil($total_records / $limit);

            // Previous page button
            if ($page > 1) {
                echo "<li class='page-item'><a class='page-link' href='filter.php?page=".($page - 1)."'>Previous</a></li>";
            } else {
                echo "<li class='page-item disabled'><a class='page-link'>Previous</a></li>";
            }

            // Page buttons
            for ($i=1; $i<=$total_pages; $i++) {
                if ($i == $page) {
                    echo "<li class='page-item active'><a class='page-link' href='filter.php?page=".$i."'>".$i."</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='filter.php?page=".$i."'>".$i."</a></li>";
                }
            }

            // Next page button
            if ($page < $total_pages) {
                echo "<li class='page-item'><a class='page-link' href='filter.php?page=".($page + 1)."'>Next</a></li>";
            } else {
                echo "<li class='page-item disabled'><a class='page-link'>Next</a></li>";
            }
            ?>
        </ul>
    
    </div>
</div>
</body>
</html>
