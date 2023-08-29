<!DOCTYPE html>
<html>

<head>
    <title>Membership and Rentals</title>
</head>

<body>
    <h1>Membership and Rentals</h1>

    
    <script>
        // This script will fetch data from the back-end and populate the table
        fetch('get_data.php')  // Adjust the URL to match your back-end file
            .then(response => response.text())
            .then(data => {
                document.getElementById('table-container').innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>

    <h2>Add Membership</h2>
    <form method='POST' action='Movies.php'>
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
        <input type='submit' name='submit_membership' value='Add Membership'>
    </form>
</body>

</html>