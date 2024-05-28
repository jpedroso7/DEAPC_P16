<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_id'])) {
        include_once "db-conn.php";
        include_once "functions.php";

        $booking_id = $_POST['booking_id'];

        // Get booking details for logging
        $stmt_booking_details = $conn->prepare("SELECT destination_name FROM viagens WHERE id = ?");
        if ($stmt_booking_details) {
            $stmt_booking_details->bind_param("i", $booking_id);
            $stmt_booking_details->execute();
            $stmt_booking_details->bind_result($destination_name);
            $stmt_booking_details->fetch();
            $stmt_booking_details->close();

            // Delete associated reviews first
            $sql_delete_reviews = "DELETE FROM reviews WHERE viagem_id = ?";
            $stmt_delete_reviews = $conn->prepare($sql_delete_reviews);
            if ($stmt_delete_reviews) {
                $stmt_delete_reviews->bind_param("i", $booking_id);
                $stmt_delete_reviews->execute();
                $stmt_delete_reviews->close();

                // Now delete the booking
                $sql_delete_booking = "DELETE FROM viagens WHERE id = ?";
                $stmt_delete_booking = $conn->prepare($sql_delete_booking);
                if ($stmt_delete_booking) {
                    $stmt_delete_booking->bind_param("i", $booking_id);
                    if ($stmt_delete_booking->execute()) {
                        // Log the cancellation action
                        $action = "Booking Cancellation";
                        $description = "User {$_SESSION['user_name']} canceled a trip to $destination_name (Booking ID: $booking_id).";
                        log_action($conn, $_SESSION['id'], $action, $description);

                        $_SESSION['message'] = "Booking canceled successfully.";
                    } else {
                        $_SESSION['error'] = "Error canceling the booking. Please try again.";
                    }
                    $stmt_delete_booking->close();
                } else {
                    $_SESSION['error'] = "Error preparing the booking delete request. Please try again.";
                }
            } else {
                $_SESSION['error'] = "Error preparing the reviews delete request.";
            }
        } else {
            $_SESSION['error'] = "Error retrieving booking details. Please try again.";
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
