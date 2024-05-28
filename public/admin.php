<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['role'] == 'admin') {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - WanderWorld</title>
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
       <a  class="User"><?php echo $_SESSION['user_name']; ?></a>
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
    
<div class="card" id="user">
    <img src="../assets/images/icons8-user-96.png">
    <p><a href="usermgmt.php">User Management</a></p>
</div>
<div class="card" id="trip">
<img src="../assets/images/icons8-airplane-96.png">
        <p><a href="destinationmgmt.php">Destination Management</a></p>
</div>
<div class="card" id="logs">
<img src="../assets/images/icons8-logs-96.png">
        <p><a href="logs.php">Logs</a></p>
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
