<?php
session_start();
include_once "db-conn.php";
include_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id']) && isset($_POST['viagem_id']) && isset($_POST['destination_name'])) {
    $user_id = $_SESSION['id'];
    $user_name = $_SESSION['user_name'];
    $viagem_id = $_POST['viagem_id'];
    $destination_name = $_POST['destination_name'];
    $review_text = $_POST['review'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO reviews (review_text, rating, user_id, user_name, viagem_id, destination_name) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("siisis", $review_text, $rating, $user_id, $user_name, $viagem_id, $destination_name);
        if ($stmt->execute()) {
            // Log the review submission action
            $action = "Review Submission";
            $description = "User $user_name submitted a review for $destination_name with rating $rating.";
            log_action($conn, $user_id, $action, $description);

            $_SESSION['review_success'] = "Review submitted successfully!";
        } else {
            $_SESSION['review_error'] = "Error submitting review. Please try again.";
        }
        $stmt->close();
    } else {
        $_SESSION['review_error'] = "Error preparing the review submission request.";
    }
    header("Location: ../public/reviews.php?viagem_id=$viagem_id&destination_name=" . urlencode($destination_name));
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
