<?php
// Include the database connection file (db.php)
require_once('connect.php');

// Check if a valid laptop ID is provided in the URL
if (!isset($_GET['laptopID']) || empty($_GET['laptopID'])) {
    header("Location: laptops.php");
    exit();
}

// Retrieve the laptopID from the URL
$laptopID = $_GET['laptopID'];

// Fetch laptop details from the database
$sql = "SELECT * FROM laptops WHERE LaptopID = $laptopID";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Laptop Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #4caf50;
        }

        div {
            border: 1px solid #ddd;
            padding: 10px;
            margin-top: 20px;
        }

        p {
            margin-bottom: 10px;
        }
        a {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Laptop Details</h2>

    <?php
    // Check if there are results from the database query
    if ($result->num_rows > 0) {
        // Fetch and display laptop details
        $row = $result->fetch_assoc();
        echo "<div>";
        echo "<p><strong>Brand:</strong> {$row['Brand']}</p>";
        echo "<p><strong>Model:</strong> {$row['Model']}</p>";
        echo "<p><strong>Processor:</strong> {$row['Processor']}</p>";
        echo "<p><strong>RAM:</strong> {$row['RAM']} GB</p>";
        echo "<p><strong>Storage:</strong> {$row['Storage']} GB</p>";
        echo "<p><strong>Availability:</strong> " . ($row['Availability'] ? 'Available' : 'Not Available') . "</p>";
        echo "<p><strong>Rental Cost:</strong> $" . $row['RentalCost'] . " per day</p>";
        // Add more details as needed
        echo "</div>";
    } else {
        // Display a message if no details are available for the laptop
        echo "<p>No details available for this laptop</p>";
    }
    ?><br><br>
    <a href="rental.php">RENT HERE</a>

</body>
</html>
