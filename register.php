<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "registration"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $role = $conn->real_escape_string($_POST['role']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $region = $conn->real_escape_string($_POST['region']);
    $address = $conn->real_escape_string($_POST['address']);

    // Password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (role, name, email, password, contact, region, address)
            VALUES ('$role', '$name', '$email', '$hashed_password', '$contact', '$region', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Registration successful!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

$conn->close();
?>
