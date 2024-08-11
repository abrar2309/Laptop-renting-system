<?php
require_once('connect.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$sel="SELECT * FROM users";
$query=mysqli_query($conn,$sel);
$result=mysqli_fetch_assoc($query);
echo '<h1>HI ', $result['Username'];
echo "<h1>Welcome to the Laptop Renting </h1>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laptop Renting System</title>
</head>
<body>
<style>.dashboard-links {
    text-align: center;
    padding: 20px;
    background-color: #f0f0f0;
}

.dashboard-links a {
    text-decoration:rgb(255, 0, 0);
    color: #333;
    margin: 10px;
    display: block;
}

.dashboard-links i {
    margin-right: 5px;
}
</style>


<footer class="dashboard-links"><br><br>
    <a href="laptops.php">View Laptops</a><br>
    <a href="rental.php">Rent Here</a><br>
    <a href="history.php">History</a><br>
    <a href="feedback.php">Feedback</a><br>
</footer>

</body>
</html>
