<?php
// Assuming you're using MySQLi for database connection
include('db.php'); // Include your database connection file

// Get the 'type' and 'bedding' parameters from the URL
$roomType = isset($_GET['type']) ? $_GET['type'] : '';
$beddingType = isset($_GET['bedding']) ? $_GET['bedding'] : '';

// Check if roomType is empty, if it is, exit with a message
if (empty($roomType)) {
    echo "No room type specified.";
    exit;
}

// Fetch the room details from the 'room' table based on the room type and bedding type
$sql = "SELECT * FROM room WHERE type = ? AND bedding = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $roomType, $beddingType);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the room data
    $room = $result->fetch_assoc();
    echo "<h1>Details for " . htmlspecialchars($room['type']) . "</h1>";
    echo "<p><strong>Room Type:</strong> " . htmlspecialchars($room['type']) . "</p>";
    echo "<p><strong>Bedding:</strong> " . htmlspecialchars($room['bedding']) . "</p>";
    echo "<p><strong>Place:</strong> " . htmlspecialchars($room['place']) . "</p>"; // Availability status
    echo "<p><strong>Customer ID:</strong> " . htmlspecialchars($room['cusid']) . "</p>"; // Customer ID (if you want to show it)
} else {
    echo "<p>No details available for this room type and bedding combination.</p>";
}

$stmt->close(); // Close the prepared statement
$con->close();  // Close the database connection
?>