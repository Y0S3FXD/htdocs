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
//delete movie

if (isset($_POST['delete_movie'])) {
    $movie_id = $_POST['movie_id'];

    $delete_movie_query = "DELETE FROM movies WHERE movie_id = '$movie_id'";

    if ($conn->query($delete_movie_query) === TRUE) {
        echo "Delete movie was successful.<br>";
    } else {
        echo "Error: " . $delete_membership_query . "<br>" . $conn->error;
    }
}



//show movies
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
echo "<h2>Delete Movie</h2>";
echo "
<label for='movie_id'>Movie Name:</label>
<input type='text' name='movie_id'>
";
echo"<input type='submit' name='delete_movie' value='Delete movie'>";

?>