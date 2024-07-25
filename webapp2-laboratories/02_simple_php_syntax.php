<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Activity</title>

    <style>

        html {
            font-family: "Arial", sans-serif;
        }

        h1 {
            text-align: center;
        }

    </style>
</head>
<body>
    <h1>STUDENT INFO</h1>
    <pre>

    <?php
    $name = "Allen Murphy";
    $age = 21;
    $address = "L8B1 1st Ave. Larlin Village Sampaloc Apalit Pampanga";
    $hobbies = "Writing, Listening To Music, Etc.";
    $pet_peeve = "Pests";

    // $pet_peeve = "Pests";
    # $address = "L8B1 1st Ave. Larlin Village Sampaloc Apalit Pampanga";

    define ("name", "Allen Murphy");
    define ("age", 21);
    define ("address", "L8B1 1st Ave. Larlin Village Sampaloc Apalit Pampanga");
    define ("hobbies",  "Writing, Listening To Music, Etc.");
    define ("pet_peeve", "Pests");

    echo "<h2>". name . "</h2>";
    echo "<strong>Age</strong>: " . age . "<br>";
    echo "<strong>Address</strong>: " . address . "<br>";
    echo "<strong>Hobbies</strong>: " . hobbies . "<br>";
    echo "<strong>Pet Peeve</strong>: " . pet_peeve . "<br><br>";

    echo '<pre>';
    var_dump (name);
    echo '</pre>';
    echo '<pre>';
    var_dump (age);
    echo '</pre>';    
    echo '<pre>';
    var_dump (address);
    echo '</pre>';
    echo '<pre>';
    var_dump (hobbies);
    echo '</pre>';
    echo '<pre>';
    var_dump (pet_peeve);
    echo '</pre>';

    /*
        "Pest Peeve": Feelings of infuriation caused by things that is of perpetual nuisance.
    */
    ?>

    </pre>

</body>
</html>

