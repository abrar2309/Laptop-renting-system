<!-- laptops.php -->

<?php
require_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Laptops</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #4caf50;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            overflow: hidden;
        }

        h3 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 15px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Available Laptops</h2>

    <?php
    // Fetch and display available laptopss
    $sql = "SELECT * FROM laptops";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "<h3>Brand:{$row['Brand']}</h3>";
            echo " Model:{$row['Model']}";
            echo "<p>Processor: {$row['Processor']}</p>";
            echo "<p>RAM: {$row['RAM']} GB</p>";
            echo "<p>Storage: {$row['Storage']} GB</p>";
            echo "<p>RentalCost: {$row['RentalCost']} </p>";
            echo "<p>Availability: {$row['Availability']} available</p>";
            echo "<button onclick='viewDetails({$row['LaptopID']})'>View Details</button>";
            echo "</li>";
        }
    } else {
        echo "<p>No available laptops</p>";
    }
    ?>

    <script>
        function viewDetails(laptopID) {
            // Redirect to a page to view details based on the laptopID
            window.location.href = 'view_laptop.php?laptopID=' + laptopID;
        }
    </script>
</body>
</html>
