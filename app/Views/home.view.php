<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>This is a Home</h1>
    <?php

    try {
        $query = "SELECT * FROM u WHERE id = ?";
        $params = [1];
        $result = DatabaseConnection::executeSearch($query, $params);

        // Displaying the results
        foreach ($result as $row) {
            echo "User: " . $row['name'] . ", id: " . $row['id'] . "<br>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>
</body>

</html>