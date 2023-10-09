<!DOCTYPE html>

<head>
    <title>My Notes</title>
</head>

<body>
    <?php
    $age = 20;
    $name = "John";
    $is__it_true = false;
    echo "My name is $name and I am $age years old.";
    echo "<br>";
    if ($age >= 18) {
        echo "You are an adult";
    } else {
        echo "You are young dear friend";
    }
    echo "<br>";
    $cars = array("BMW", "MERCEDES", "TOYOTA", " HONDA", " VOLVO");
    foreach ($cars as $car) {
        echo "a $car <br>";
    
    }
    echo "<h1>How many cars are they ?</h1>";
    $car_count =    count($cars);
    echo $car_count;
    ?>
</body>