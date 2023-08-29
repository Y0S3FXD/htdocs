<!DOCTYPE html>
<html>

<head>
    <title>Membership and Rentals</title>
</head>

<body>
    <h1>Membership and Rentals</h1>

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

    // Member ship creation or submission
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

    // Query to fetch data
    $query = "SELECT m.full_name, s.salutation, r.currently_rented_movies
              FROM membership m
              JOIN salutation s ON m.salutation_id = s.salutation_id
              LEFT JOIN rentals r ON m.membership_id = r.membership_id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
            <tr>
                <th>Full Name</th>
                <th>Salutation</th>
                <th>Currently Rented Movie</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['full_name'] . "</td>
                <td>" . $row['salutation'] . "</td>
                <td>" . $row['currently_rented_movies'] . "</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    if (isset($_POST['delete_membership'])) {
        $full_name = $_POST['full_name'];

        $delete_membership_query = "DELETE FROM membership WHERE full_name = '$full_name'";

        if ($conn->query($delete_membership_query) === TRUE) {
            echo "Delete membership was successful.<br>";
        } else {
            echo "Error: " . $delete_membership_query . "<br>" . $conn->error;
        }
    }
    // Query to fetch movie names
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
    echo "<h2>Add Membership</h2>";
    echo "<form method='POST'>
    <label for='full_name'>Full Name:</label>
    <input type='text' name='full_name'><br>
    <label for='physical_address'>Physical Address:</label>
    <input type='text' name='physical_address'><br>
    <label for='salutation_id'>Salutation:</label>
    <select name='salutation_id'>
        <option value='1'>Mr</option>
        <option value='2'>Mrs</option>
        <option value='3'>Not Specified</option>
        <!-- Add more options as needed -->
    </select><br>

    <input type='submit' name='submit_membership' value='Add Membership'>
    <input type='submit' name='delete_membership' value='Delete membership'>
</form>
";

    // Close the connection
    $conn->close();
    ?>

</body>

</html>