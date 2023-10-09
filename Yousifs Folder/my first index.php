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


    // add colume to membership table
    if (isset($_POST['Add_colume'])) {
        $column_name = $_POST['full_name'];
        $column_type = $_POST['colume_type'];
        $escaped_column_name = "`$column_name`";

        $add_colume_query = "ALTER TABLE membership ADD $escaped_column_name $column_type";


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
                <th>Rented Movie</th>
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
            echo "delete membership was successfully.<br>";
        } else {
            echo "Error: " . $insert_membership_query . "<br>" . $conn->error;
        }
    }
    // Fetch column names from the membership table
    $fetch_columns_query = "SHOW COLUMNS FROM membership";
    $columns_result = $conn->query($fetch_columns_query);

    $column_names = array();
    while ($row = $columns_result->fetch_assoc()) {
        $column_names[] = $row['Field'];
    }

    // Display the dropdown menu for selecting a column
    echo "<form method='POST'>
        <label for='selected_column'>Select Column:</label>
        <select name='selected_column'>";

    foreach ($column_names as $column_name) {
        echo "<option value='$column_name'>$column_name</option>";
    }

    echo "</select><br>
      <input type='submit' name='show_column_data' value='Show Column Data'>
      </form>";

    // Process the form submission and display selected column data
    if (isset($_POST['show_column_data'])) {

        // Fetch data for the selected column
        $fetch_column_data_query = "SELECT $selected_column FROM membership";
        $column_data_result = $conn->query($fetch_column_data_query);

        echo "<h2>Column Data: $selected_column</h2>";

        while ($row = $column_data_result->fetch_assoc()) {
            echo $row[$selected_column] . "<br>";
        }

        if (isset($_POST['delete_column'])) {

            $delete_column_query = "ALTER TABLE membership DROP COLUMN $selected_column";
            if ($conn->query($delete_membership_query) === TRUE) {
                echo "delete membership was successfully.<br>";
            } else {
                echo "Error: " . $insert_membership_query . "<br>" . $conn->error;
            }

        }
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
        <!-- Add more options as needed -->
    </select><br>
    <label for='colume_type'>Column Type:</label>
    <select name='colume_type'>
        <option value='VARCHAR(255)'>VARCHAR(255)</option>
        <option value='INT'>INT</option>
        <!-- Add more data types as needed -->
    </select><br>
    <input type='submit' name='submit_membership' value='Add Membership'>
    <input type='submit' name='delete_membership' value='Delete membership'>
    <input type='submit' name='delete_column' value='Delete column'>
    <input type='submit' name='Add_colume' value='Add Column'>
    <input type='submit' name='show_movies' value='Show movies'>

</form>
";


    // Close the connection
    $conn->close();
    ?>

</body>

</html>