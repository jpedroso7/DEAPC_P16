<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    include_once "../includes/db-conn.php";

    // Fetch users from the database
    $sql = "SELECT id, user_name, name FROM users WHERE role = 'user'";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
    <link rel="stylesheet" href="../assets/styles/admin.css">

    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/styles/navbar.css">
    <link rel="stylesheet" href="../assets/styles/viagemConfig.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logogpt.jpeg">
    <style>
        /* Apply basic styling to the main container */
        .main {
            margin: 20px;
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Set the height to full viewport height */
            flex-direction: column;
        }

        /* Style the table container */
        .container2 {
            display: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            width: 75%;
            margin-bottom: 20px;
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

      

        #delete {
            margin: 0;
            padding: 5px;
            background :red;
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

        .add-user-form {
            width: 75%;
            padding: 20px;
            background-color: rgb(1, 48, 75);
            color: white;
            border-radius: 5px;
            display: none;
        }

        .add-user-form input {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .add-user-form button {
            background: green;
        }

        .add-user-form button:hover {
            background: darkgreen;
        }

        .menu {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

       

     
    </style>
    <script>
        function showSection(section) {
            document.querySelector('.container2').style.display = 'none';
            document.querySelector('.add-user-form').style.display = 'none';
            document.querySelector(`.${section}`).style.display = 'block';
        }
    </script>
</head>
<body>

<nav>
    <div class="img_container">
       <a href="admin.php"><img src="../assets/images/logogpt.jpeg" alt="Logo" id="logo"></a>
    </div>
   <div id="titulo">
    <h1>
      User Management
    </h1>
   </div>
    <div class="Menu_user" style="margin-top: 25px;">
       <h1 class="hello" style="margin-bottom: 30px;">Hello </h1>
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
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: white;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    
    <div class="menu acontainer" class="acontainer">
        <button class="card" onclick="showSection('container2')">See All Users</button>
        <button class="card" onclick="showSection('add-user-form')">Add New User</button>
    </div>
    
    <div class="container2">
        <?php if ($result->num_rows > 0): ?>
            <table border="1" align="center">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td>
                            <form action="../includes/delete_user.php" method="POST">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" id="delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center;" id="nobook">No users found.</p>
        <?php endif; ?>
    </div>

    <div class="add-user-form">
        <h2>Add New User</h2>
        <form action="../includes/add_user.php" method="POST">
            <input type="text" name="user_name" placeholder="Username" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Add User</button>
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

<?php
} else {
    header("Location: index.php");
    exit();
}
?>
