<?php
include_once "db-conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['destination_id'])) {
    $destination_id = $_POST['destination_id'];

    // Fetch the destination details from the database
    $stmt = $conn->prepare("SELECT name FROM destinations WHERE id = ?");
    $stmt->bind_param("i", $destination_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $destination = $result->fetch_assoc();
    $stmt->close();

    if ($destination) {
        $destination_name = strtolower(str_replace(' ', '', $destination['name']));
        $file_path = "../public/Destinos/{$destination_name}.php";

        // Delete the file if it exists
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete the destination record from the database
        $stmt = $conn->prepare("DELETE FROM destinations WHERE id = ?");
        $stmt->bind_param("i", $destination_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['remove_success'] = "Destination removed successfully.";
    } else {
        $_SESSION['remove_error'] = "Destination not found.";
    }
}

header("Location: admin_destinations.php");
exit();
?>
