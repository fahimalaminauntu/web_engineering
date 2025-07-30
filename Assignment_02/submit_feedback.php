<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$gmail = $_POST['gmail'] ?? '';
$gender = $_POST['gender'] ?? '';
$description = $_POST['description'] ?? '';

if (empty($name) || empty($gmail) || empty($gender) || empty($description)) {
    die("Please fill all fields.");
}

if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

$allowedGenders = ['Male', 'Female', 'Other'];
if (!in_array($gender, $allowedGenders)) {
    die("Invalid gender value.");
}

$stmt = $conn->prepare("INSERT INTO feedback_info (name, gmail, gender, description) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $gmail, $gender, $description);

if ($stmt->execute()) {
    echo "Thank you for your feedback!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>