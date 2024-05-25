<?php
session_start();
include_once "db-conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id']) && isset($_POST['viagem_id']) && isset($_POST['destination_name'])) {
    $user_id = $_SESSION['id'];
    $user_name = $_SESSION['user_name'];
    $viagem_id = $_POST['viagem_id'];
    $destination_name = $_POST['destination_name'];
    $review_text = $_POST['review'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO reviews (review_text, rating, user_id, user_name, viagem_id, destination_name) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisis", $review_text, $rating, $user_id, $user_name, $viagem_id, $destination_name);
    $stmt->execute();
    $stmt->close();

    $_SESSION['review_success'] = "Review submitted successfully!";
    header("Location: ../public/home.php?viagem_id=$viagem_id&destination_name=" . urlencode($destination_name));
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
