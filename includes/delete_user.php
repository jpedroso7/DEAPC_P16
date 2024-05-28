<?php
session_start();

include_once "db-conn.php";
include_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Retrieve user details for logging
    $stmt_user_details = $conn->prepare("SELECT user_name FROM users WHERE id = ?");
    if ($stmt_user_details) {
        $stmt_user_details->bind_param("i", $user_id);
        $stmt_user_details->execute();
        $stmt_user_details->bind_result($user_name);
        $stmt_user_details->fetch();
        $stmt_user_details->close();

        // Delete the user
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // Log the user deletion action
            $action = "User Deletion";
            $description = "Admin deleted user $user_name (User ID: $user_id).";
            log_action($conn, $_SESSION['id'], $action, $description);

            $_SESSION['message'] = "User deleted successfully.";
        } else {
            $_SESSION['message'] = "Error deleting user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Error retrieving user details. Please try again.";
    }

    $conn->close();
    header("Location: ../public/usermgmt.php");
    exit();
}
?>
