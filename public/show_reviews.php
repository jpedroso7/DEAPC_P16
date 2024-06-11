<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

include_once "../includes/db-conn.php";

$stmt = $conn->prepare("SELECT r.review_text, r.rating, r.user_name, v.destination_name 
                        FROM reviews AS r
                        INNER JOIN viagens AS v ON r.viagem_id = v.id");
$stmt->execute();
$result = $stmt->get_result();
$reviews = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reviews</title>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <link rel="stylesheet" href="../assets/styles/navbar.css">
  <link rel="stylesheet" href="../assets/styles/styles.css">
  <link rel="stylesheet" href="../assets/styles/reviews.css">
  <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <nav>
    <div class="img_container">
       <a href="home.php"><img src="../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
   <div id="titulo">
    <h1>
      Review Page
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
  <div class="review_container">
    <?php foreach ($reviews as $review): ?>
      <div class="review">
        <div class="header"><h3><?php echo htmlspecialchars($review['user_name']); ?> </h3> <h3 id="dest"><?php echo htmlspecialchars($review['destination_name']); ?></h3></div>
        <p id="text"><?php echo nl2br(htmlspecialchars($review['review_text'])); ?></p>
        <div class="stars">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <i class="fa-star <?php echo ($i <= $review['rating']) ? 'fa-solid' : 'fa-regular'; ?>"></i>
          <?php endfor; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <footer>
    <i class="fas fa-plane airplane-icon"></i>
    <em>Trabalho realizado por Daniel Botelho, João Pedroso e Rui Martins</em>
    <i class="fas fa-plane airplane-icon"></i>
  </footer>
  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .review_container {
      padding: 20px;
      display: flex;
      flex-direction: column;
      margin-top: 100px;
      gap: 10px;
    }
    .review {
      border: 1px solid black;
      padding: 10px;
      margin-bottom: 10px;
      background-color: rgba(1, 48, 75, 0.9);
      border-radius: 5px;
      color: darkgrey;
    }

    .header {
      display: flex;
      justify-content: space-between;
    }

    #dest {
      color: white;
      font-weigth: bold;
      margin-right: 20px;
    }

    #text {
      color: white;
      font-style: italic;
    }

    .stars {
      color: #ffb400;
    }
    .fa-regular {
      color: #ccc;
    }
    .fa-solid {
      color: gold;
    }
  </style>
</body>
</html>
