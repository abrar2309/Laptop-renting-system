<!-- view_history.php -->

<?php
require_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's rental history
$sql = "SELECT rt.TransactionID, l.Brand, l.Model, rt.RentalDate, rt.ReturnDate, rt.Status
        FROM rental_transactions rt
        JOIN laptops l ON rt.LaptopID = l.LaptopID
        WHERE rt.UserID = $user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rental_history = $result->fetch_all(MYSQLI_ASSOC);
} else {                                                            
    $rental_history = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Rental History</h2>

    <?php if (!empty($rental_history)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Laptop Brand</th>
                    <th>Laptop Model</th>
                    <th>Rental Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rental_history as $transaction) : ?>
                    <tr>
                        <td><?= $transaction['TransactionID'] ?></td>
                        <td><?= $transaction['Brand'] ?></td>
                        <td><?= $transaction['Model'] ?></td>
                        <td><?= $transaction['RentalDate'] ?></td>
                        <td><?= $transaction['ReturnDate'] ?></td>
                        <td><?= $transaction['Status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>            
    <?php else : ?>
        <p>No rental history available.</p>
    <?php endif; ?>
</body>
</html>




