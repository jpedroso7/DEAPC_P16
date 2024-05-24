<?php
include_once "db-conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination_name = $_POST['destination_name'];
    $image = $_FILES['image'];
    $description = $_POST['description'];

    // Ensure the image is uploaded
    if ($image['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading image.";
        exit();
    }

    // Move the uploaded file to the appropriate directory
    $image_path = "../assets/images/" . basename($image['name']);
    if (!move_uploaded_file($image['tmp_name'], $image_path)) {
        echo "Error moving uploaded file.";
        exit();
    }

    // Insert the destination into the database
    $stmt = $conn->prepare("INSERT INTO destinations (name, description, image_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $destination_name, $description, $image_path);
    if ($stmt->execute()) {
        $destination_id = $stmt->insert_id;
        $stmt->close();

        // Create the destination PHP file
        $template = file_get_contents('../public/Destinos/destination_template.php');
        $new_page = str_replace(['{DESTINATION_ID}', '{DESTINATION_NAME}', '{DESTINATION_DESCRIPTION}', '{IMAGE_PATH}'], [$destination_id, $destination_name, $description, $image_path], $template);
        file_put_contents("../public/Destinos/" . strtolower($destination_name) . ".php", $new_page);

        echo "Destination added successfully!";
    } else {
        echo "Error adding destination to database.";
    }
}
?>
