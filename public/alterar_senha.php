<?php
    session_start();
    include "db-conn.php"; // Inclua o arquivo de conexão com o banco de dados

    // Verificar se o usuário está logado
    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

        // Verificar se todos os campos do formulário foram enviados
        if (isset($_POST['current-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password'])) {
            $current_password = $_POST['current-password'];
            $new_password = $_POST['new-password'];
            $confirm_password = $_POST['confirm-password'];

            // Verificar se a nova senha e a confirmação da senha coincidem
            if ($new_password == $confirm_password) {
                // Consulta SQL para verificar se a senha atual está correta
                $user_id = $_SESSION['id'];
                $sql = "SELECT * FROM users WHERE id='$user_id' AND password='$current_password'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 1) {
                    // Se a senha atual estiver correta, atualize a senha na base de dados
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash da nova senha
                    $update_sql = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
                    $update_result = mysqli_query($conn, $update_sql);

                    if ($update_result) {
                        // Redirecionar de volta para a página de definições com uma mensagem de sucesso
                        header("Location: definicoes.php?success=Senha alterada com sucesso");
                        exit();
                    } else {
                        // Se houver um erro ao atualizar a senha, redirecione de volta para a página de definições com uma mensagem de erro
                        header("Location: definicoes.php?error=Erro ao atualizar a senha");
                        exit();
                    }
                } else {
                    // Se a senha atual estiver incorreta, redirecione de volta para a página de definições com uma mensagem de erro
                    header("Location: definicoes.php?error=Senha atual incorreta");
                    exit();
                }
            } else {
                // Se a nova senha e a confirmação da senha não coincidirem, redirecione de volta para a página de definições com uma mensagem de erro
                header("Location: definicoes.php?error=A nova senha e a confirmação da senha não coincidem");
                exit();
            }
        } else {
            // Se algum campo estiver faltando, redirecione de volta para a página de definições com uma mensagem de erro
            header("Location: definicoes.php?error=Todos os campos são obrigatórios");
            exit();
        }
    } else {
        // Se o usuário não estiver logado, redirecione para a página de login
        header("Location: index.php");
        exit();
    }
?>
