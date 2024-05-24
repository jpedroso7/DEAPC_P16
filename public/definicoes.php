<?php
    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

        ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Definições</title>
    <link rel="stylesheet" href="../assets/styles/definicoes.css">
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="icon" type="image/x-icon" href="../images/logogpt.jpeg">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<nav>
    <div class="img_container">
       <a href="#"><img src="../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
   <div id="titulo">
    <h1>
      Desenvolvimento de viagens computacionais
    </h1>
   </div>
   
    <div class="Menu_user">
       <h1 class="hello" style="margin-bottom: 30px;">Hello </h1>
       <ul class="menu">
        <li class="menu-item">
       <a  class="User"><?php echo $_SESSION['name']; ?></a>
       <ul class="drop-menu">
        <li class="drop-menu-item">
            <a href="mybookings.php">Reservas</a>
        </li>
        <li class="drop-menu-item">
            <a href="show_reviews.php">Reviews</a>
        </li>
        <li class="drop-menu-item">
          <a href="../HTML/definicoes.html">Definições</a>
      </li>
      <li class="drop-menu-item">
            <a href="../includes/logout.php">Logout</a>
        </li>
    </ul>
  </li>
</ul>
      </div>
   
  </nav>

    <div class="settings-container">
        <h2>Definições</h2>
        <div class="settings-options">
            <button id="privacidade-btn">Privacidade</button>
            <button id="conta-btn">Conta</button>
        </div>


        <div id="privacidade" class="settings-section" style="display: none;">
            <h3>Privacidade</h3>
            <form class="settings-form">
                <div class="form-group">
                    <label for="current-password">Senha Atual</label>
                    <input type="password" id="current-password" name="current-password" required>
                </div>
                <div class="form-group">
                    <label for="new-password">Nova Senha</label>
                    <input type="password" id="new-password" name="new-password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmar Nova Senha</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit">Alterar Senha</button>
            </form>
        </div>


        <div id="conta" class="settings-section" style="display: none;">
            <h3>Conta</h3>
       
            <p>....</p>
        </div>
    </div>

    <footer>
        <i class="fas fa-plane airplane-icon"></i>
        <em>Trabalho realizado por Daniel Botelho, João Pedroso e Rui Martins</em>
        
        <i class="fas fa-plane airplane-icon"></i>
      </footer>
    <script>
        
        document.getElementById('privacidade-btn').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('privacidade').style.display = 'block';
            document.getElementById('conta').style.display = 'none';
        });

        document.getElementById('conta-btn').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('privacidade').style.display = 'none';
            document.getElementById('conta').style.display = 'block';
        });
    </script>

</body>
</html>
<?php
    } else {
            header("Location: index.php");
            exit();
    }

    ?>