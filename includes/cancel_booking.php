<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    // Check if booking_id is provided
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_id'])) {
        // Include the database connection file
        include_once "db-conn.php";

        // Retrieve the booking_id
        $booking_id = $_POST['booking_id'];

        // Prepare and execute SQL DELETE statement
        $sql = "DELETE FROM viagens WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $stmt->close();
        }

        // Redirect back to mybookings.php
        header("Location: ../public/mybookings.php");
        exit();
    } else {
        // Redirect to mybookings.php if no booking_id is provided
        header("Location: ../public/mybookings.php");
        exit();
    }
} else {
    // Redirect to login page if user is not logged in
    header("Location: ../public/index.php");
    exit();
}
?>
