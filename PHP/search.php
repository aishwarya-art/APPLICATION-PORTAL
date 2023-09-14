<?php
require "connect.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Pagination variables
$itemsPerPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Search functionality
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = '';
if (!empty($searchTerm)) {
    // Define the columns you want to include in the search
    $searchColumns = ['id', 'name', 'qualification', 'nationality','email','address','dob','languages','skills','availability','interests']; // Add more columns if needed

    // Create the WHERE clause based on the search term and columns
    $searchConditions = [];
    foreach ($searchColumns as $column) {
        $searchConditions[] = "`$column` LIKE '%$searchTerm%'";
    }
    $searchQuery = "WHERE " . implode(" OR ", $searchConditions);
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Page</title>
    <style>
        /* ... Your existing CSS styles ... */
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
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
        .search-form {
            text-align: center;
            margin: 20px;
        }

        .search-form input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }

        .search-form button {
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for the search button on hover */
        .search-form button:hover {
            background-color: #444;
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

<h1>Search list</h1>

<!-- Search Form -->
<div class="search-form">
    <form method="GET" action="new.php">
        <input type="text" name="search" placeholder="Search by Name" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>

    <?php
    // Fetch data with search query and pagination
    $sql = "SELECT id, name FROM crud $searchQuery LIMIT $itemsPerPage OFFSET $offset";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>
                <a href='view.php?id=" . $row['id'] . "'>View</a>
                <span style='margin: 5px;'></span>
                <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No records found</td></tr>";
    }

   
    ?>
</table>

<!-- Pagination -->
<div class="pagination justify-content-end">
    <?php
    // Count total records for pagination
    $sql = "SELECT COUNT(*) AS total FROM crud $searchQuery";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $totalItems = $row['total'];
    
    // Calculate total pages
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Pagination links
    if ($page > 1) {
        echo "<a href='new.php?page=" . ($page - 1) . "&search=" . urlencode($searchTerm) . "'>&laquo; Previous</a>";
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='new.php?page=$i&search=" . urlencode($searchTerm) . "'>$i</a>";
    }

    if ($page < $totalPages) {
        echo "<a href='new.php?page=" . ($page + 1) . "&search=" . urlencode($searchTerm) . "'>Next &raquo;</a>";
    }
    ?>

</div>

</body>
</html>
