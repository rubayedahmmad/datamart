<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datamart";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS service_list (
    serviceID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    coverPictureUrl VARCHAR(255) NOT NULL,
    serviceName VARCHAR(100) NOT NULL,
    discountedPrice DECIMAL(10, 2) NOT NULL,
    originalPrice DECIMAL(10, 2) NOT NULL
)";
$conn->query($sql);

// CRUD operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create operation
    if (isset($_POST["create"])) {
        $coverPictureUrl = mysqli_real_escape_string($conn, $_POST["coverPictureUrl"]);
        $serviceName = $_POST["serviceName"];
        $discountedPrice = $_POST["discountedPrice"];
        $originalPrice = $_POST["originalPrice"];

        $sql = "INSERT INTO service_list (coverPictureUrl, serviceName, discountedPrice, originalPrice) 
                VALUES ('$coverPictureUrl', '$serviceName', $discountedPrice, $originalPrice)";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Read operation
    if (isset($_POST["read"])) {
        $sql = "SELECT * FROM service_list";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ServiceID: " . $row["serviceID"] . " - Service Name: " . $row["serviceName"] . " - Discounted Price: $" . $row["discountedPrice"] . " - Original Price: $" . $row["originalPrice"] . "<br>";
            }
        } else {
            echo "No services found.";
        }
    }

    // Update operation
    if (isset($_POST["update"]) && isset($_POST["serviceID"])) {
        $serviceID = $_POST["serviceID"];
        $coverPictureUrl = $_POST["coverPictureUrl"];
        $serviceName = $_POST["serviceName"];
        $discountedPrice = $_POST["discountedPrice"];
        $originalPrice = $_POST["originalPrice"];

        $sql = "UPDATE service_list SET coverPictureUrl='$coverPictureUrl', serviceName='$serviceName', discountedPrice=$discountedPrice, originalPrice=$originalPrice WHERE serviceID=$serviceID";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Delete operation
    if (isset($_POST["delete"]) && isset($_POST["serviceID"])) {
        $serviceID = $_POST["serviceID"];

        $sql = "DELETE FROM service_list WHERE serviceID=$serviceID";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service List Operations</title>
    <style>
        :root {
            --main-color: #0fa4af;
            --black: #13131a;
            --border: .1rem solid rgba(255, 255, 255, .3);
        }

        * {
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
            transition: .2s linear;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
            scroll-padding-top: 9rem;
            scroll-behavior: smooth;
        }

        html::-webkit-scrollbar {
            width: .8rem;
        }

        html::-webkit-scrollbar-track {
            background: transparent;
        }

        html::-webkit-scrollbar-thumb {
            background: #fff;
            border-radius: 5rem;
        }

        body {
            background-image: url("images/bg.jpeg");
        }

        h1 {
        text-align: center;
        color: #f5c518;
        margin-top: 2rem;
        font-size: 3rem; 
        font-weight: bold;
        }

        .dropdown-container {
            text-align: center;
            margin: 1rem auto; 
            padding: 1rem;
            border: var(--border);
            border-radius: 0.5rem;
            background-color: #fff; 
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            max-width: 20rem;
            width: auto; 
        }

        .dropdown-container select {
            padding: .8rem;
            font-size: 1.6rem;
            border: var(--border);
            border-radius: .5rem;
        }
        form {
            display: none;
            flex-direction: column;
            align-items: center;
            margin-top: 2rem;
        }

        form.active {
            display: flex;
        }

        label {
            color: #000000;
            font-size: 1.6rem;
            margin-top: 1rem;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="password"] {
            width: 30rem;
            padding: .8rem;
            font-size: 1.6rem;
            border: 1px solid #ccc;
            border-radius: .5rem;
            margin-top: .5rem;
            text-transform: none;
        }

        input[type="submit"] {
            width: 15rem;
            padding: 1rem;
            font-size: 1.7rem;
            color: #fff;
            background: var(--main-color);
            cursor: pointer;
            border-radius: .5rem;
            margin-top: 1.5rem;
        }

        input[type="submit"]:hover {
            background: var(--black);
        }

        form {
            margin: 1rem auto;
            padding: 1rem;
            border: var(--border);
            border-radius: 0.5rem;
            background-color: #fff; 
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            max-width: 35rem;
            width: auto;
            
        }
        .logout-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 1rem 3rem;
            font-size: 1.7rem;
            color: #fff;
            background: #e59102;
            cursor: pointer;
            text-align: center;
            border-radius: .5rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: var(--black);
        }
    </style>
</head>
<body>
    <h1>Service List Operations</h1>
    <button onclick="logout()" class="logout-btn">Logout</button>
    <div class="dropdown-container">
        <select id="operation" onchange="toggleForm()">
            <option value="" selected disabled>Select Operation</option>
            <option value="create">Create Service</option>
            <option value="read">Read Services</option>
            <option value="update">Update Service</option>
            <option value="delete">Delete Service</option>
        </select>
    </div>

    <form id="createForm" method="POST" action="" class="active">
        <label for="coverPictureUrl">Cover Picture URL:</label>
        <input type="text" name="coverPictureUrl" id="coverPictureUrl" required>

        <label for="serviceName">Service Name:</label>
        <input type="text" name="serviceName" id="serviceName" required>

        <label for="discountedPrice">Discounted Price:</label>
        <input type="number" step="0.01" name="discountedPrice" id="discountedPrice" required>

        <label for="originalPrice">Original Price:</label>
        <input type="number" step="0.01" name="originalPrice" id="originalPrice" required>

        <input type="submit" name="create" value="Create">
    </form>

    <form id="readForm" method="POST" action="">
        <input type="hidden" name="read" value="true">
        <input type="submit" value="Read">
    </form>

    <form id="updateForm" method="POST" action="">
        <label for="update-serviceID">ServiceID:</label>
        <input type="number" name="serviceID" id="update-serviceID" required>

        <label for="update-coverPictureUrl">Cover Picture URL:</label>
        <input type="text" name="coverPictureUrl" id="update-coverPictureUrl" required>

        <label for="update-serviceName">Service Name:</label>
        <input type="text" name="serviceName" id="update-serviceName" required>

        <label for="update-discountedPrice">Discounted Price:</label>
        <input type="number" step="0.01" name="discountedPrice" id="update-discountedPrice" required>

        <label for="update-originalPrice">Original Price:</label>
        <input type="number" step="0.01" name="originalPrice" id="update-originalPrice" required>

        <input type="submit" name="update" value="Update">
    </form>

    <form id="deleteForm" method="POST" action="">
        <label for="delete-serviceID">ServiceID:</label>
        <input type="number" name="serviceID" id="delete-serviceID" required>

        <input type="submit" name="delete" value="Delete">
    </form>

    <script>
        function toggleForm() {
            var operation = document.getElementById("operation").value;
            var createForm = document.getElementById("createForm");
            var readForm = document.getElementById("readForm");
            var updateForm = document.getElementById("updateForm");
            var deleteForm = document.getElementById("deleteForm");

            createForm.classList.remove("active");
            readForm.classList.remove("active");
            updateForm.classList.remove("active");
            deleteForm.classList.remove("active");

            if (operation === "create") {
                createForm.classList.add("active");
            } else if (operation === "read") {
                readForm.classList.add("active");
            } else if (operation === "update") {
                updateForm.classList.add("active");
            } else if (operation === "delete") {
                deleteForm.classList.add("active");
            }
        }
        function logout() {
        window.location.href = "adminlogin.php";
}
    </script>
</body>
</html>
