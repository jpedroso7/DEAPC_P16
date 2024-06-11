<?php
session_start();
include_once "../includes/db-conn.php"; // Adjust the path as necessary

if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];
    $user_id = $_SESSION['id'];

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['message'] = "Todos os campos são obrigatórios.";
        $_SESSION['message_type'] = "error";
        header("Location: ../public/definicoes.php");
        exit();
    } elseif ($new_password !== $confirm_password) {
        $_SESSION['message'] = "A nova senha e a confirmação da senha não coincidem.";
        $_SESSION['message_type'] = "error";
        header("Location: ../public/definicoes.php");
        exit();
    } else {
        // Check current password
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($stored_password);
        $stmt->fetch();
        $stmt->close();

        if ($current_password !== $stored_password) {
            $_SESSION['message'] = "A senha atual está incorreta.";
            $_SESSION['message_type'] = "error";
            header("Location: ../public/definicoes.php");
            exit();
        } else {
            // Update password without hashing
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_password, $user_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Senha alterada com sucesso.";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Erro ao atualizar a senha.";
                $_SESSION['message_type'] = "error";
            }
            $stmt->close();
            header("Location: ../public/definicoes.php");
            exit();
        }
    }
} else {
    header("Location: ../public/definicoes.php");
    exit();
}
?>
