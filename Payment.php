<?php
// Assuming you have a database connection established
require_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $transactionId = $_POST['transactionId'];
    $amount = $_POST['amount'];
    $paymentDate = $_POST['paymentDate'];

    // Insert data into the 'payments' table
    $insert_query = "INSERT INTO payments (transactionId, amount, paymentDate) 
                     VALUES ('$transactionId', '$amount', '$paymentDate')";

    if ($conn->query($insert_query) === TRUE) {
        echo "Payment added successfully!";
        // You can redirect the user or perform other actions as needed
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
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
    <h2>Payment Form</h2>
    <form action="Payment.php" method="post">
        <label for="transactionId">Transaction ID:</label>
        <input type="text" id="transactionId" name="transactionId" required>

        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" required>

        <label for="paymentDate">Payment Date:</label>
        <input type="text" id="paymentDate" name="paymentDate" placeholder="YYYY-MM-DD" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>

