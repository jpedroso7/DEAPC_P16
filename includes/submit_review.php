<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "db-conn.php";

    $user_id = $_SESSION['id'];
    $user_name = $_SESSION['user_name'];
    $review_text = $_POST['review'];
    $rating = intval($_POST['rating']);

    if ($rating < 1 || $rating > 5) {
        $_SESSION['review_error'] = "Rating must be between 1 and 5 stars.";
        header("Location: ../public/reviews.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO reviews (review_text, rating, user_name, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $review_text, $rating, $user_name, $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['review_success'] = "Review submitted successfully!";
    header("Location: ../public/home.php");
    exit();
} else {
    header("Location: ../public/reviews.php");
    exit();
}
?>
