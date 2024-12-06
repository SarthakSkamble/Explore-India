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

// Step 1: Check if the 'destination_name' parameter is passed in the URL
if (isset($_GET['destination_name'])) {
    $destinationName = $_GET['destination_name'];

    // Step 2: Query the database for details of the selected destination
    $query = "SELECT destination_name, destination_state, destination_type, destination_image, description 
              FROM destinations 
              WHERE destination_name = '$destinationName'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Step 3: Fetch the details and display them
        $row = $result->fetch_assoc();
        $destinationName = $row['destination_name'];
        $destinationState = $row['destination_state'];
        $destinationType = $row['destination_type'];
        $destinationImage = $row['destination_image'];
        $description = $row['description'];
    } else {
        echo "Destination not found.";
    }

    $conn->close();
} else {
    echo "No destination selected.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $destinationName; ?> - Details</title>
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    background-color: #f8f9fa;
    font-family: 'Arial', sans-serif;
    color: #333;
}

/* Destination Details Section */
.destination-details {
    padding: 40px;
    background: #fff;
    border-radius: 8px;
    max-width: 900px;
    margin: 40px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: all 0.3s ease;
}

.destination-details:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
}

/* Destination Image Styling */
.destination-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Title Styling */
.destination-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

/* Destination Information */
.destination-details p {
    font-size: 1.1rem;
    color: #7f8c8d;
    line-height: 1.6;
    margin-bottom: 15px;
}

.destination-description {
    font-size: 1.2rem;
    color: #2c3e50;
    margin-bottom: 30px;
}

/* Back Button Styling */
.back-button {
    display: inline-block;
    padding: 12px 25px;
    font-size: 1.1rem;
    color: #fff;
    background-color: #3498db;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.back-button:hover {
    background-color: #2980b9;
    transform: scale(1.05);
}

/* Animation for Content */
.destination-details {
    opacity: 0;
    animation: fadeIn 1s forwards;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .destination-details {
        padding: 20px;
    }

    .destination-title {
        font-size: 2rem;
    }

    .destination-description {
        font-size: 1rem;
    }

    .back-button {
        padding: 10px 20px;
    }
}

    </style>
</head>
<body>

<div class="destination-details">
    <img src="taj.jpg"  class="destination-image">
    <h1 class="destination-title"><?php echo $destinationName; ?> - <?php echo $destinationState; ?></h1>
    <p><strong>Type:</strong> <?php echo $destinationType; ?></p>
    <p class="destination-description"><?php echo $description; ?></p>
    <a href="index.php" class="back-button">Back to Destinations</a>
</div>

</body>
</html>
