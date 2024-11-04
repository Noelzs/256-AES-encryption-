<?php

// Check if the request is coming from a valid source
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve cart items from the request
    $cartItems = $_POST['cartItems'];

    // Connect to the database
    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "websitelogin"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO transactionlogs (title, price, date) VALUES (?, ?, NOW())");

    // Bind parameters
    $stmt->bind_param("ss", $title, $price);

    // Insert each item from the cartItems array
    foreach ($cartItems as $item) {
        $title = $item['title'];
        $price = $item['price'];
        $stmt->execute();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Send a response back
    echo "Transaction logged successfully!";
} else {
    // Handle invalid requests
    echo "Invalid request method!";
}

?>
