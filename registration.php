<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "datamart";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST["username"]);
    $firstName = sanitize_input($_POST["firstName"]);
    $lastName = sanitize_input($_POST["lastName"]);
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);
    
    // Insert data into database
    $sql = "INSERT INTO user_info (username, firstName, lastName, email, password)
            VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
        echo '<p style="color: red; font-weight: bold; font-size: 24px;">Registration Successful!</p>';
        echo '</div>';
        header("Location: index.html"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
