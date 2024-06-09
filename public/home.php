<?php
    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

        ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WanderWorld</title>
  <link rel="stylesheet" href="../assets/styles/navbar.css">
  <link rel="stylesheet" href="../assets/styles/styles.css">
  <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>
<body>
  
  <nav>
    <div class="img_container">
       <a href="home.php"><img src="../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
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
          <a href="definicoes.php">Definições</a>
      </li>
      <li class="drop-menu-item">
            <a href="../includes/logout.php">Logout</a>
        </li>
    </ul>
  </li>
</ul>
      </div>
   
  </nav>
  <div class="container">
    
    <div class="destination" id="grecia">
      <a href="Destinos/grecia.php" class="link">
      <div class="destination-info">
        <h3>Grécia</h3>        
        <p>Voo + 7 noites c/ tudo incluído</p>
      </div>
    </a>
    </div>
  

  
    <div class="destination" id="brasil">
      <a href="Destinos/brasil.php" class="link">
        <div class="destination-info">
          <h3>Rio de Janeiro</h3>
          <p>Voo + 7 noites c/ tudo incluído</p>
        </div>
      </a>
    </div>
  
  
    <div class="destination" id="japao">
      <a href="Destinos/japao.php" class="link">
      <div class="destination-info">
        <h3>Japão</h3>
        <p>Voo + 7 noites c/ tudo incluído</p>
      </div>
    </a>
    </div>
  

  
   
    <div class="destination" id="paraguai">
      <a href="Destinos/paraguai.php" class="link">
      <div class="destination-info" id="info-paraguai">
        <h3>Paraguai</h3>
        <p>Voo + 7 noites c/ tudo incluído</p>
      </div>
    </a>
    </div>
  
  

  
    <div class="destination" id="noruega">
      <a href="Destinos/noruega.php" class="link">
      <div class="destination-info">
        <h3>Noruega</h3>
        <p>Voo + 7 noites c/ tudo incluído</p>
      </div>
    </a>
    </div>
  

  
    <div class="destination" id="marrocos">
      <a href="Destinos/marrocos.php" class="link">
      <div class="destination-info">
        <h3>Marrocos</h3>
        <p>Voo + 7 noites c/ tudo incluído</p>
      </div>
    </a>

    </div>

     
    <div class="destination" id="outros1">
      <a href="Destinos/outrosDestinos.php" class="link">
      <div class="destination-info">
        <h3>Outros Destinos</h3>
       
      </div>
    </a>

    </div>
  
  </div>
  <footer>
    <i class="fas fa-plane airplane-icon"></i>
    <em>Trabalho realizado por Daniel Botelho, João Pedroso e Rui Martins</em>
    
    <i class="fas fa-plane airplane-icon"></i>
  </footer>
</body>
</html>

<?php
    } else {
            header("Location: index.php");
            exit();
    }

    ?>