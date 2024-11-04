<?php
// Error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "websitelogin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve cartItems from query parameters
$cartItemsJson = $_GET['cartItems'] ?? '';

// Verify if cartItemsJson is not empty
if (!empty($cartItemsJson)) {
    // Attempt to decode JSON
    $cartItems = json_decode(urldecode($cartItemsJson), true);

    // Check if JSON decoding was successful
    if ($cartItems !== null) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO transactionlogs (title, price, date) VALUES (?, ?, NOW())");

        // Check if statement preparation was successful
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("sd", $title, $price); // Adjusted types: s for string (VARCHAR), d for double (FLOAT)

            // Iterate through cart items and insert into database
            foreach ($cartItems as $item) {
                $title = $item['title'] ?? '';
                $price = $item['price'] ?? 0;
                
                // Execute the statement
                if (!$stmt->execute()) {
                    echo "Error inserting record: " . $stmt->error;
                }
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "Error decoding cart items JSON.";
    }
} else {
    echo "No cart items provided.";
}

// Close database connection
$conn->close();
?>
