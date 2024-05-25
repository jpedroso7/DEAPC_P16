<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['user_name']) || !isset($_GET['viagem_id']) || !isset($_GET['destination_name'])) {
    header("Location: index.php");
    exit();
}

$viagem_id = $_GET['viagem_id'];
$destination_name = $_GET['destination_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WanderWorld - Reviews</title>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <link rel="stylesheet" href="../assets/styles/navbar.css">
  <link rel="stylesheet" href="../assets/styles/styles.css">
  <link rel="stylesheet" href="../assets/styles/reviews.css">
  <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="../assets/scripts/review.js"></script>
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
  <div class="rating_box">
    <div class="review_box">
      <header>How was your experience?</header>
      <div class="stars">
        <i class="fa-solid fa-star" data-value="1"></i>
        <i class="fa-solid fa-star" data-value="2"></i>
        <i class="fa-solid fa-star" data-value="3"></i>
        <i class="fa-solid fa-star" data-value="4"></i>
        <i class="fa-solid fa-star" data-value="5"></i>
      </div>
      <div class="form">
        <form action="../includes/submit_review.php" method="POST">
          <input type="hidden" name="rating" id="rating" value="0">
          <input type="hidden" name="viagem_id" value="<?php echo htmlspecialchars($viagem_id); ?>">
          <input type="hidden" name="destination_name" value="<?php echo htmlspecialchars($destination_name); ?>">
          <textarea id="long-text" name="review" rows="4" cols="50"></textarea>
          <button type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <footer>
    <i class="fas fa-plane airplane-icon"></i>
    <em>Trabalho realizado por Daniel Botelho, João Pedroso e Rui Martins</em>
    <i class="fas fa-plane airplane-icon"></i>
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const stars = document.querySelectorAll('.fa-star');
      const ratingInput = document.getElementById('rating');
      stars.forEach(star => {
        star.addEventListener('click', function () {
          ratingInput.value = this.getAttribute('data-value');
          stars.forEach(s => s.classList.remove('selected'));
          this.classList.add('selected');
          for (let i = 0; i < this.getAttribute('data-value'); i++) {
            stars[i].classList.add('selected');
          }
        });
      });
    });
  </script>
</body>
</html>

