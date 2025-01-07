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

if (isset($_POST['submit'])) {
    $destinationtype = $_POST['destination-type'];
    $destinationstate = $_POST['destination-state'];

    $searchquery = "SELECT destination_name, destination_type, destination_state FROM destinations WHERE destination_type= '$destinationtype' AND destination_state= '$destinationstate'";
    $result = $conn->query($searchquery);

    // Step 3: Check if there are rows and display them
    if ($result->num_rows > 0) {
       
        echo "<div class='destination-list'>";
        // Output data for each row
        // Inside the while loop that fetches the destinations
        while ($row = $result->fetch_assoc()) {
             $destinationName = $row["destination_name"];
             $destinationState = $row["destination_state"];
    
    // Create a link with a GET request, passing destination name as a parameter
            echo "<div class='destination-button'>";
            echo "<a href='result.php?destination_name=" . urlencode($destinationName) . "' class='destination-btn'>" . $destinationName . " - " . $destinationState . "</a>";
             echo "</div>";
}

        echo "</div>";
    } else {
        echo "<p>No results found.</p>";
    }

    // Step 4: Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesser-Known Indian Destinations</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            background-image: url('explore.jpeg');
            background-size: cover; /* This makes sure the image covers the entire screen */
            background-position: center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents the image from repeating */
        }

        /* Hero Section */
        .hero {
            position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 10;

        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .hero button {
            padding: 15px 25px;
            font-size: 1.2rem;
            color: white;
            background-color: #ff6347;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .hero button:hover {
            background-color: #e53e3e;
            transform: scale(1.05);
        }

        /* Add Select One of These Text */
        .overlay-text {
            font-size: 2rem;
            font-weight: bold;
            color: white;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* Preferences Section */
        .preferences {
            margin-top: 30px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }

        .preferences h2 {
            font-size: 2.3rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .preferences-form label {
            font-size: 1.2rem;
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .preferences-form select,
        .preferences-form button {
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
            font-size: 1.1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .preferences-form button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .preferences-form button:hover {
            background-color: #0056b3;
        }

        /* Destination Results */
        .destination-list {

            margin-top: 530px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .destination-button {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .destination-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .destination-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Footer */
        .footer {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 20px;
            margin-top: 50px;
            position: relative;
            z-index: 1;
        }

        .footer p {
            font-size: 1rem;
        }

        .social-media a {
            color: #fff;
            margin: 0 15px;
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: #ff6347;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .categories {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .categories {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    

    <?php if (isset($result) && $result->num_rows > 0): ?>
        <div class="destination-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="destination-button">
                    <button class="destination-btn"><?php echo $row["destination_name"] . " - " . $row["destination_state"]; ?></button>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <div class="hero">
        <div class="overlay-text">Select One of These</div>
        <h1>Explore Beautiful  Indian Destinations</h1>
        <p>Find offbeat locations that are perfect for your next trip</p>
    </div>

    <div class="footer">
        <p>&copy; 2024 Explore India - All Rights Reserved</p>
    </div>

</body>
</html>
