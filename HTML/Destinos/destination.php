<?php
$destino = isset($_GET['destino']) ? $_GET['destino'] : 'Brasil'; 
$titulo = "Book your trip to $destino";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Viagens para <?php echo $destino; ?></title>
  <link rel="stylesheet" href="../../styles/navbar.css">
  <link rel="stylesheet" href="../../styles/viagemConfig.css">
  <link rel="icon" type="image/x-icon" href="../../images/logogpt.jpeg">
</head>
<body>
  <nav>
    <div class="img_container">
      <a href="#"><img src="../../images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
    <div id="titulo">
      <h1><?php echo $titulo; ?></h1>
    </div>
    <div class="Menu_user">
      <h1 class="hello">Hello</h1>
      <ul class="menu">
        <li class="menu-item">
          <a class="User">User</a>
          <ul class="drop-menu">
            <li class="drop-menu-item"><a href="#">Perfil</a></li>
            <li class="drop-menu-item"><a href="#">Reservas</a></li>
            <li class="drop-menu-item"><a href="#">Reviews</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container2">
    <form id="bookingForm">
      <label for="departure">Departure Airport:</label>
      <select name="departure" id="departure">
        <option value="lisbon">Lisbon</option>
        <option value="porto">Porto</option>
        <option value="algarve">Algarve</option>
      </select>

      <label for="people">Number of People:</label>
      <select name="people" id="people">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
      </select>

      <label for="hotel">Choose Hotel:</label>
      <select name="hotel" id="hotel">
        <option value="hotel1">Hotel 1</option>
        <option value="hotel2">Hotel 2</option>
        <option value="hotel3">Hotel 3</option>
        <option value="hotel4">Hotel 4</option>
      </select>

      <button type="submit" id="bookNowButton">Book Now</button>
    </form>
    <div id="priceDisplay"></div>
  </div>

  <script src="../../scripts/preço.js"></script>
  <script src="../../scripts/booking.js"></script>
</body>
</html>