<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    include_once "../../includes/db-conn.php";

    // Fetch destinations from the database where ID is greater than 6
    $sql = "SELECT * FROM destinations WHERE id > 6";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Destinations</title>
    <link rel="stylesheet" href="../../assets/styles/navbar.css">
  <link rel="stylesheet" href="../../assets/styles/styles.css">
  <link rel="icon" type="image/x-icon" href="../../assets/images/logogpt.jpeg">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Apply basic styling to the main container */
        .main {
            margin: 20px;
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Set the height to full viewport height */
        }

        /* Style the table container */
        .container2 {
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            width: 75%;
        }

        /* Apply styling to the table */
        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
            font-weight: bold;
        }

        /* Style the table header */
        th {
            background-color: rgb(1, 48, 75);
            color: darkgrey;
            font-weight: bold;
            padding: 10px;
            text-align: left;
        }

        /* Style the table rows */
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        /* Alternate row background color for better readability */
        tr:nth-child(even) {
            background: rgb(1, 48, 75, 0.8);
        }

        tr:nth-child(odd) {
            background-color: rgba(31, 79, 104, 0.8);
        }

        /* Hover effect on table rows */
        tr:hover {
            opacity: 0.8;
        }

        a {
            text-decoration: none;
            color: white;
        }

    </style>
</head>
<body>
<nav>
    <div class="img_container">
       <a href="../home.php"><img src="../../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
   <div id="titulo">
    <h1>
      Other Destinations
    </h1>
   </div>
   <div class="Menu_user">
       <h1 class="hello" style="margin-bottom: 30px;">Hello </h1>
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
        <?php if ($result->num_rows > 0): ?>
            <table border="1" align="center">
                <thead>
                <tr>
                    <th>Destination Name</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                    <td id="name"><a href="<?php echo $row['name']; ?>.php"><?php echo $row['name']; ?></a></td>
                        <td><?php echo $row['description']; ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center;">No destinations found.</p>
        <?php endif; ?>
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
