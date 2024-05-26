<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_id'])) {
        include_once "db-conn.php";

        $booking_id = $_POST['booking_id'];

        // Delete associated reviews first
        $sql_delete_reviews = "DELETE FROM reviews WHERE viagem_id = ?";
        $stmt_delete_reviews = $conn->prepare($sql_delete_reviews);
        if ($stmt_delete_reviews) {
            $stmt_delete_reviews->bind_param("i", $booking_id);
            $stmt_delete_reviews->execute();
            $stmt_delete_reviews->close();
        } else {
            $_SESSION['error'] = "Error preparing the reviews delete request.";
            header("Location: ../public/mybookings.php");
            exit();
        }

        // Now delete the booking
        $sql = "DELETE FROM viagens WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $booking_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Booking canceled successfully.";
            } else {
                $_SESSION['error'] = "Error canceling the booking. Please try again.";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Error preparing the booking delete request. Please try again.";
        }
        
        header("Location: ../public/mybookings.php");
        exit();
    } else {
        header("Location: ../public/mybookings.php");
        exit();
    }
} else {
    header("Location: ../public/index.php");
    exit();
}
?>
