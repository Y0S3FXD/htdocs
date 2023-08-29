<?php
// Database configuration and connection setup
// ...
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
// Query to fetch data
$query = "SELECT m.full_name, s.salutation, r.rented_movie
          FROM membership m
          JOIN salutation s ON m.salutation_id = s.salutation_id
          LEFT JOIN rentals r ON m.membership_id = r.membership_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr>
            <th>Full Name</th>
            <th>Salutation</th>
            <th>Rented Movie</th>
          </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['full_name'] . '</td>';
        echo '<td>' . $row['salutation'] . '</td>';
        echo '<td>' . $row['rented_movie'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>
