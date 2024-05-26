<?php
session_start();

// Verifica se o usuário está logado e é administrador
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['role'] == 'admin') {
    // Conexão com o banco de dados (ajuste conforme necessário)
    $conn = new mysqli('localhost', 'root', '', 'test_db');

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consulta para obter os logs
    $sql = "SELECT * FROM logs ORDER BY timestamp DESC";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logs - WanderWorld</title>
        <link rel="stylesheet" href="../assets/styles/navbar.css">
        <link rel="stylesheet" href="../assets/styles/styles.css">
        <link rel="stylesheet" href="../assets/styles/admin.css">
        <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>
    <nav>
        <div class="img_container">
            <a href="#"><img src="../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
        </div>
        <div id="titulo">
            <h1>Desenvolvimento de viagens computacionais</h1>
        </div>
        <div class="Menu_user">
            <h1 class="hello" style="margin-bottom: 30px;">Hello </h1>
            <ul class="menu">
                <li class="menu-item">
                    <a class="User"><?php echo $_SESSION['user_name']; ?></a>
                    <ul class="drop-menu">
                        <li class="drop-menu-item">
                            <a href="../includes/logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="acontainer">
        <h2>Logs</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Ação</th>
                <th>Data/Hora</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['user']}</td>
                            <td>{$row['action']}</td>
                            <td>{$row['timestamp']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum log encontrado.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <footer>
        <i class="fas fa-plane airplane-icon"></i>
        <em>Trabalho realizado por Daniel Botelho, João Pedroso e Rui Martins</em>
        <i class="fas fa-plane airplane-icon"></i>
    </footer>
    </body>
    </html>

    <?php
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>