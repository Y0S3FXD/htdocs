<?php
// Database configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'movie_rental_system';

// Create a connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// check connection
if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
// add the movie
if (isset($_POST['add_movie'])) {
    $movie_name = $_POST['movie_name'];
    $db_table_create = "CREATE TABLE IF NOT EXISTS movies(
        movie_id INT AUTO_INCREMENT PRIMARY KEY,
        movie_name VARCHAR(255) NOT NULL)";
    if ($conn->query($db_table_create) === TRUE) {
        echo "table movies created successfully";
    } else {
        echo "error creating movies table" . $conn->error;
    }
    $insert_movie_query = "INSERT INTO movies (movie_name) VALUES ('$movie_name')";
    if ($conn->query($insert_movie_query) === TRUE) {
        echo "New movie added successfully.<br>";
    } else {
        echo "Error: " . $insert_movie_query . "<br>" . $conn->error;
    }
}


$fetch_movies_query = "SELECT movie_id, movie_name FROM movies";

$movies_result = $conn->query($fetch_movies_query);

if ($movies_result->num_rows > 0) {
    echo "<h2>Movie List</h2>";
    echo "<table border='1'>
    <tr>
        <th>Movie ID</th>
        <th>Movie Name</th>
    </tr>";

    while ($row = $movies_result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row['movie_id'] . "</td>
        <td>" . $row['movie_name'] . "</td>
        
        <td><input type='submit' name='Seen_movie' value='Rented Movies'></td>

        </tr>";
    }

    echo "</table>";
} else {
    echo "No movie records found.";
}
echo "<h2>Add Movie</h2>";
echo "<form method='POST'>
<label for='Movie Name'>Movie Name:</label>
<input type='text' name='movie_name'><br>

<input type='submit' name='add_movie' value='submit and add movie'>
</form>";
?>