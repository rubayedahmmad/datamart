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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['loginemail'];
    $password = $_POST['loginpassword'];

    // SQL query to validate user
    $sql = "SELECT * FROM user_info WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, login successful
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
        echo '<p style="color: red; font-weight: bold; font-size: 24px;">Login Successful!</p>';
        echo '</div>';
        header("Refresh: 1; url=index.html");
        exit();
    } else {
        // User doesn't exist or credentials are incorrect
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
        echo '<p style="color: red; font-weight: bold; font-size: 24px;">Invalid email or password!</p>';
        echo '</div>';
        header("Refresh: 1; url=index.html");
        exit();
        
}
}

// Close database connection
$conn->close();
?>