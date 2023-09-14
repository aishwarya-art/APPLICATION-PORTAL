<?php
require "connect.php";

// Pagination variables
$limit = 5; // Number of records per page
$page_number = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

// Calculate the initial page and offset for pagination
$initial_page = ($page_number - 1) * $limit;

// Get the selected sort option for name
$sortByName = isset($_GET['sortByName']) ? $_GET['sortByName'] : '';

// Define sort queries for different name options
$sortByNameQueries = [
    'a-z' => "ORDER BY name ASC",
    'z-a' => "ORDER BY name DESC",
    // Add more sort options as needed
];

// Default sort query for name if no option selected
$sortByNameQuery = '';

// Check if the selected sort option exists in the sortByNameQueries array
if (array_key_exists($sortByName, $sortByNameQueries)) {
    $sortByNameQuery = $sortByNameQueries[$sortByName];
}

// Get the selected sort option for ID
$sortByID = isset($_GET['sortByID']) ? $_GET['sortByID'] : '';

// Define sort queries for different ID options
$sortByIDQueries = [
    'low-high' => "ORDER BY id ASC",
    'high-low' => "ORDER BY id DESC",
    // Add more sort options as needed
];

// Default sort query for ID if no option selected
$sortByIDQuery = '';

// Check if the selected sort option exists in the sortByIDQueries array
if (array_key_exists($sortByID, $sortByIDQueries)) {
    $sortByIDQuery = $sortByIDQueries[$sortByID];
}

// Fetch data with pagination and sorting
$getQuery = "SELECT id, name FROM crud $sortByNameQuery $sortByIDQuery LIMIT $initial_page, $limit";
$result = mysqli_query($con, $getQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightblue;
        }

        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
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

        .pagination a:hover {
            background-color: #444;

        }
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
        </style>
</head>
<body>
<a href="dashboard.php" class="back-to-dashboard">Back to Dashboard</a>

    <div class="container">
        <h3 style="text-align: center;">Select options to sort</h3>
        <br>
        <div style="display: flex; justify-content: space-around;">
            <form action="sortfunction.php" method="GET">
                <select name="sortByName">
                    <option value="" disabled selected>Select Name option</option>
                    <option value="a-z">Name ASC</option>
                    <option value="z-a">Name DESC</option>
                </select>
                <input type="submit" value="Sort Name">
            </form>

            <form action="sortfunction.php" method="GET">
                <select name="sortByID">
                    <option value="" disabled selected>Select ID option</option>
                    <option value="low-high">ID ASC</option>
                    <option value="high-low">ID DESC</option>
                </select>
                <input type="submit" value="Sort ID">
            </form>
        </div>
        <br>
        <table>
           

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>
                    <a href='view.php?id=" . $row['id'] . "'>View</a>
                    <span style='margin: 5px;'></span>
                    <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                    </td>";
                
                    "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- ... Your pagination links ... -->
        <div class="pagination">
            <?php
            // Count total records for pagination
            $countQuery = "SELECT COUNT(*) AS total FROM crud";
            $countResult = mysqli_query($con, $countQuery);
            $countRow = mysqli_fetch_assoc($countResult);
            $totalItems = $countRow['total'];

            // Calculate total pages
            $totalPages = ceil($totalItems / $limit);

            // Pagination links
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='sortfunction.php?page=$i'>$i</a>";
            }
            ?>
    </div>

</body>
</html>
