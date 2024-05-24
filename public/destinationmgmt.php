<?php
include_once "../includes/db-conn.php";
session_start();

// Fetch all destinations
$sql = "SELECT id, name FROM destinations WHERE id > 6";
$result = $conn->query($sql);
$destinations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $destinations[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Destinations</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
    <link rel="stylesheet" href="../assets/styles/admin.css">

    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/viagemConfig.css">
    <link rel="icon" type="image/x-icon" href="../../assets/images/logogpt.jpeg">
</head>
<body>
<nav>
    <div class="img_container">
       <a href="./admin.php"><img src="../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
   <div id="titulo">
    <h1>
    Destination Management
    </h1>
   </div>
    <div class="Menu_user">
       <h1 class="hello">Hello </h1>
       <ul class="menu">
        <li class="menu-item">
       <a  class="User"><?php echo $_SESSION['name']; ?></a>
       <ul class="drop-menu">
      
      <li class="drop-menu-item">
            <a href="../includes/logout.php">Logout</a>
        </li>
    </ul>
  </li>
</ul>
      </div>
  </nav>

    <div class="main">
        <div class="container2">
            <h2>Add Destination</h2>
            <form action="../includes/add_destination.php" method="POST" enctype="multipart/form-data" id="formadmin">
                <label for="destination_name">Destination Name:</label>
                <input type="text" name="destination_name" id="destination_name" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required></textarea>

                <label for="image">Destination Image:</label>
                <input type="file" name="image" id="image" required>

                <button type="submit">Add Destination</button>
            </form>

            <h2>Remove Destination</h2>
            <form action="../includes/remove_destination.php" method="POST">
                <label for="destination_id">Select Destination to Remove:</label>
                <select name="destination_id" id="destination_id" required>
                    <?php foreach ($destinations as $destination): ?>
                        <option value="<?php echo $destination['id']; ?>"><?php echo $destination['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Remove Destination</button>
            </form>
        </div>
    </div>

    <footer>
        <i class="fas fa-plane airplane-icon"></i>
        <em>Trabalho realizado por Daniel Botelho, João Pedroso e Rui Martins</em>
        <i class="fas fa-plane airplane-icon"></i>
    </footer>
</body>
</html>
