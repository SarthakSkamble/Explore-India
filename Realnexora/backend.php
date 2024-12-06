<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "";
$database = "userinfo";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $insertQuery = "INSERT INTO usersignup (Name, Email, Password, Address, Phoneno) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssss", $name, $email, $password, $address, $phone);

    if ($stmt->execute()) {
        echo "<script>alert('Signup successful! Redirecting to home page.'); window.location.href = 'frontend.html';</script>";
    } else {
        echo "<script>alert('Signup failed. Please try again.');</script>";
    }
    $stmt->close();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usersignup WHERE Email = ? AND Password = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        echo "<script>alert('Login successful!');</script>";
        echo"Goto main page";
       
        
        exit();
    } else {
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }

    $stmt->close();
}
$conn->close();


?>
