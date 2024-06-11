<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $destination_id = 1;
    $destination_name = "Grécia";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viagens para a Grécia</title>
    <link rel="stylesheet" href="../../assets/styles/navbar.css">
    <link rel="stylesheet" href="../../assets/styles/viagemConfig.css">
    <link rel="icon" type="image/x-icon" href="../../assets/images/logogpt.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        html {
            background: url('../../assets/images/grecia2.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body>
<nav>
    <div class="img_container">
       <a href="../../public/home.php"><img src="../../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
   <div id="titulo">
    <h1>
      Book your trip to Greece
    </h1>
   </div>
   <div class="Menu_user">
       <h1 class="hello" >Hello </h1>
       <ul class="menu">
        <li class="menu-item">
       <a  class="User"><?php echo $_SESSION['name']; ?></a>
       <ul class="drop-menu">
        <li class="drop-menu-item">
            <a href="../mybookings.php">Reservas</a>
        </li>
        <li class="drop-menu-item">
            <a href="../show_reviews.php">Reviews</a>
        </li>
        <li class="drop-menu-item">
          <a href="../definicoes.php">Definições</a>
      </li>
      <li class="drop-menu-item">
            <a href="../../includes/logout.php">Logout</a>
        </li>
    </ul>
  </li>
</ul>
      </div>
   
  </nav>
    <div class="main">
        <div class="container2">
            <form id="bookingForm" action="../../includes/booking.php" method="POST" onsubmit="return confirmBooking()">
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
                
                <input type="hidden" name="destination_id" value="<?php echo $destination_id; ?>">
                <input type="hidden" name="price" id="price" value="">
                <div id="priceDisplay"></div>
                
                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>
    <footer>
        <i class="fas fa-plane airplane-icon"></i>
        <em>Trabalho realizado por Daniel Botelho, João Pedroso e Rui Martins</em>
        <i class="fas fa-plane airplane-icon"></i>
    </footer>
    <script src="../../assets/scripts/preço.js"></script>
    <script>
        function confirmBooking() {
            return confirm("Do you want to confirm this booking?");
        }
    </script>
    <?php if (isset($_SESSION['booking_success'])): ?>
    <script>
        alert("<?php echo $_SESSION['booking_success']; ?>");
        <?php unset($_SESSION['booking_success']); ?>
    </script>
    <?php endif; ?>
</body>
</html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>
