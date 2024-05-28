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


$stmt = $conn->prepare("SELECT * FROM logs ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
$logs = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
    <link rel="stylesheet" href="../assets/styles/admin.css">

    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/viagemConfig.css">
    <link rel="icon" type="image/x-icon" href="../../assets/images/logogpt.jpeg">
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
</head>
<body>
<nav>
    <div class="img_container">
       <a href="./admin.php"><img src="../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
   <div id="titulo">
    <h1>
    Logs
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

    <h1>Logs</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Action</th>
            <th>Description</th>
            <th>Timestamp</th>
        </tr>
        <?php foreach ($logs as $log): ?>
        <tr>
            <td><?php echo htmlspecialchars($log['id']); ?></td>
            <td><?php echo htmlspecialchars($log['user_id']); ?></td>
            <td><?php echo htmlspecialchars($log['action']); ?></td>
            <td><?php echo htmlspecialchars($log['description']); ?></td>
            <td><?php echo htmlspecialchars($log['created_at']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
