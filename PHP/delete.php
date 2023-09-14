<?php
// Include the database connection file
require "connect.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID of the record to be deleted from the URL parameter
    $id = $_GET['id'];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM crud WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the display page after successful deletion
        echo "<script>alert('Record deleted successfully.');window.location.href='index.php';</script>";
         
        exit;
    } else {
        // If there's an error in the deletion process, you can handle it here
        die("Error deleting record: " . $con->error);
    }
} else {
    // If no ID is provided in the URL parameter, redirect back to the display page
    header('Location: index.php');
    exit;
}
?>
