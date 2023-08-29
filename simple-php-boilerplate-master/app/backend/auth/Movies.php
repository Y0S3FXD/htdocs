<?php
// Database configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'movie_rental_system';

// Create a connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit_membership'])) {
    $full_name = $_POST['full_name'];
    $physical_address = $_POST['physical_address'];
    $salutation_id = $_POST['salutation_id'];

    $insert_membership_query = "INSERT INTO membership (full_name, physical_address, salutation_id)
                               VALUES ('$full_name', '$physical_address', $salutation_id)";

    if ($conn->query($insert_membership_query) === TRUE) {
        echo "New membership record added successfully.<br>";
    } else {
        echo "Error: " . $insert_membership_query . "<br>" . $conn->error;
    }


}


// Close the connection
$conn->close();
?>
