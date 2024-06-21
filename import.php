<?php
// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$college = $_POST['college'];
$course = $_POST['course'];
$internship = $_POST['internship'];

// Database connection variables
$conn = new mysqli('localhost', 'root', '', 'application_form');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into form(name, email, contact, college, course, internship) values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $name, $email, $contact, $college, $course, $internship);
    $stmt->execute();
    echo "Form Submitted Successfully...";
    $stmt->close();
    $conn->close();
}
?>