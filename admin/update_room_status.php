<?php
// Include your database connection file
include('db.php');

// Check if the room ID is set in the URL
if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    // Update the 'place' field to 'Free' and set 'cusid' to NULL for the selected room
    $sql = "UPDATE room SET place = 'Free', cusid = NULL WHERE id = ?";

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $roomId); // 'i' stands for integer
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Room marked as Free successfully.'); window.location.href='settings.php';</script>";
    } else {
        echo "<script>alert('Failed to update room status.'); window.location.href='settings.php';</script>";
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo "<script>alert('No room ID specified.'); window.location.href='settings.php';</script>";
}

// Close the database connection
$con->close();
?>