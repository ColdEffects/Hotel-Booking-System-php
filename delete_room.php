<?php
include 'db_connect.php';

// Check if the id parameter is set in the URL
if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM rooms WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $roomId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the reservation page or display a success message
        header("Location: reservation.php");
        exit();
    } else {
        echo "Error: Could not delete the room.";
    }
} else {
    echo "No room ID specified.";
}
?>