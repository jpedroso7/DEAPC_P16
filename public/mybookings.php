<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    include_once "../includes/db-conn.php";

    $user_id = $_SESSION['id'];
    $sql = "SELECT v.*, d.name as destination_name FROM viagens v
            JOIN destinations d ON v.destination_id = d.id
            WHERE v.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Capturar mensagens de sessão
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

    // Limpar mensagens de sessão
    unset($_SESSION['message']);
    unset($_SESSION['error']);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
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

            button {
                cursor: pointer;
                background: red;
                border: none;
                color: white;
                border-radius: 3px;
                width: 100%;
                padding-top: 5px;
                padding-bottom: 5px;
            }

            button:hover {
                background-color: rgba(255, 0, 0, 1);
            }

            #nobook {
                font-weight: bold;
                background-color: rgba(255, 255, 255, 0.5);
                height: 100%;
                margin: 0;
            }

            /* Responsive table design for smaller screens */
            @media screen and (max-width: 600px) {
                table {
                    border: 0;
                }

                table thead {
                    display: none;
                }

                table tr {
                    margin-bottom: 20px;
                    display: block;
                    border: 1px solid #ccc;
                }

                table td {
                    display: block;
                    text-align: right;
                }

                table td:before {
                    content: attr(data-label);
                    float: left;
                    font-weight: bold;
                }
            }
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Bookings</title>
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
      My Bookings
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
    <div class="main">
        <div class="container2">
            <!-- Display session messages -->
            <?php if ($message): ?>
                <div class="alert alert-success" style="text-align: center;"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-danger" style="text-align: center;"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if ($result->num_rows > 0): ?>
                <table border="1" align="center">
                    <thead>
                        <tr>
                            <th>Destination</th>
                            <th>Departure Airport</th>
                            <th>Number of People</th>
                            <th>Hotel</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['destination_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['departure_airport']); ?></td>
                                <td><?php echo htmlspecialchars($row['num_people']); ?></td>
                                <td><?php echo htmlspecialchars($row['hotel']); ?></td>
                                <td><?php echo htmlspecialchars($row['price']); ?></td>
                                <td>
                                    <form action="../includes/cancel_booking.php" method="POST">
                                        <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel Booking</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center;" id="nobook">You have no bookings at the moment.</p>
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
    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
