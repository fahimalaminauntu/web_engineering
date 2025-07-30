<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "coffee_shop";


$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $email = $conn->real_escape_string($_POST['email']);
    $review = $conn->real_escape_string($_POST['review_description']);

    $sql = "INSERT INTO customer_reviews (name, gender, email, review_description)
            VALUES ('$name', '$gender', '$email', '$review')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Review submitted successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>