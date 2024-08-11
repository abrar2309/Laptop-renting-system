<?php
require_once('connect.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
   // $Userid = $_POST['UserID'];
    $Transaction_id=$_POST['Transaction_id'];
    $Street = $_POST['Street'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $ZipCode = $_POST['ZipCode'];
    $Country = $_POST['Country'];

    if (empty($errors)) {
        $user_id = $_SESSION['user_id'];

    // Insert data into the 'address' table
    $insert_query = "INSERT INTO address (UserID,Transaction_id,Street, City, State, ZipCode, Country) 
                     VALUES ('$user_id','$Transaction_id','$Street', '$City', '$State', '$ZipCode', '$Country')";

    if ($conn->query($insert_query) === TRUE) {
        echo "Address added successfully!";
        // You can redirect the user or perform other actions as needed
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Form</title>
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

        input {
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
    </style>
</head>
<body>
    <h2>Address Form</h2>
    <form action="address.php" method="post">
        <label for="Transaction_id">Transaction_ID</label>
        <input type="text" id="Transaction_id" name="Transaction_id" required>

        <label for="Street">Street:</label>
        <input type="text" id="street" name="Street" required>

        <label for="City">City:</label>
        <input type="text" id="city" name="City" required>

        <label for="State">State:</label>
        <input type="text" id="state" name="State" required>

        <label for="ZipCode">Zip Code:</label>
        <input type="text" id="zipcode" name="ZipCode" required>

        <label for="Country">Country:</label>
        <input type="text" id="country" name="Country" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>

