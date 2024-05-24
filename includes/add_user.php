<?php
session_start();

include_once "../includes/db-conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (user_name, name, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user_name, $name, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "User added successfully.";
    } else {
        $_SESSION['message'] = "Error adding user: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: ../public/usermgmt.php");
    exit();
}
?>
