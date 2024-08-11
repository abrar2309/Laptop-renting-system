<!-- rent_laptop.php -->
<?php
require_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $laptop_id = $_POST['laptop'];
    $rental_duration = $_POST['rental_duration'];
    $rental_date = date("Y-m-d");
    $return_date = date("Y-m-d", strtotime("+$rental_duration days"));

    // Check if the selected laptop is available
    $availability_check = "SELECT Availability FROM laptops WHERE LaptopID = $laptop_id";
    $result = $conn->query($availability_check);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availability = $row['Availability'];   

        if ($availability > 0) {
            // Laptop is available, proceed with rental
        
            // Update the availability status of the laptop to indicate it is no longer available
            $update_availability = "UPDATE laptops SET Availability = 0 WHERE LaptopID = $laptop_id";
        
            if ($conn->query($update_availability) === TRUE) {
                // The laptop availability status has been successfully updated
        
                // Insert data into the 'rental_transactions' table
                $insert_rental = "INSERT INTO rental_transactions (UserID, LaptopID, RentalDate, ReturnDate, Status)
                                  VALUES (?, ?, ?, ?, 'rented')";
        
                $stmt = $conn->prepare($insert_rental);
                $stmt->bind_param("iiss", $user_id, $laptop_id, $rental_date, $return_date);
        
                if ($stmt->execute()) {
                    echo "Laptop rented successfully!";
                    // You can redirect the user or perform other actions as needed
                } else {
                    echo "Error: " . $stmt->error;
                }
        
                $stmt->close();
            } else {
                echo "Error updating laptop availability.";
            }
        } else {
            echo "Selected laptop is not available for rent.";
        }
    } else {
        echo "Error checking laptop availability.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Laptop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {    
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a{    
            background-color: navy;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Rent a Laptop</h2>

    <form method="post">
        <label for="laptop">Select a Laptop:</label>
        <select id="laptop" name="laptop" required>
            <?php
            // Fetch and display available laptops
            $sql = "SELECT * FROM laptops";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['LaptopID']}'>{$row['Brand']} {$row['Model']}</option>";
                }
            } else {
                echo "<option value='' disabled>No available laptops</option>";
            }
            ?>
        </select>

        <label for="rental_duration">Rental Duration (days):</label>
        <input type="number" id="rental_duration" name="rental_duration" required>

        <button type="submit">Rent Now</button><br><br><br><br><br>

        <a href="address.php">Address for delivary laptop</a>
        
    </form>
</body>
</html>
