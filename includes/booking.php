<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include_once "db-conn.php";
        include_once "functions.php";


        $departure = $_POST['departure'];
        $num_people = $_POST['people'];
        $hotel = $_POST['hotel'];
        $user_id = $_SESSION['id'];
        $user_name = $_SESSION['user_name'];
        $destination_id = $_POST['destination_id'];

        // Example prices
        $precoInicial = 500;
        $precoPessoa = 200;
        $precoHotel = 0;
        switch ($hotel) {
            case "hotel1":
                $precoHotel = 100;
                break;
            case "hotel2":
                $precoHotel = 150;
                break;
            case "hotel3":
                $precoHotel = 200;
                break;
            case "hotel4":
                $precoHotel = 250;
                break;
        }
        $price = $precoInicial + ($num_people * $precoPessoa) + $precoHotel;

        // Get the destination name
        $stmt = $conn->prepare("SELECT name FROM destinations WHERE id = ?");
        $stmt->bind_param("i", $destination_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $destination = $result->fetch_assoc();
        $destination_name = $destination['name'];
        $stmt->close();

        // Insert booking
        $sql = "INSERT INTO viagens (destination_id, departure_airport, num_people, hotel, price, user_id, destination_name, user_name)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issisdss", $destination_id, $departure, $num_people, $hotel, $price, $user_id, $destination_name, $user_name);
        $stmt->execute();
        $viagem_id = $stmt->insert_id; // Get the ID of the new booking
        $stmt->close();


// Log the booking action
$action = "Booking";
$description = "User $user_name (ID: $user_id) booked a trip to $destination_name (ID: $destination_id).";
log_action($conn, $user_id, $action, $description);


        $_SESSION['booking_success'] = "Booking successful!";
        header("Location: ../public/reviews.php?viagem_id=$viagem_id&destination_name=" . urlencode($destination_name));
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
