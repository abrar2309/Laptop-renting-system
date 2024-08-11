<!-- login.php -->

<?php
require_once('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user login
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check login credentials
    $check_login = "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'";
    $result_login = $conn->query($check_login);

    if ($result_login->num_rows > 0) {
        // Login successful, set session variables
        $user = $result_login->fetch_assoc();
        $_SESSION['user_id'] = $user['UserID'];
        $_SESSION['username'] = $user['Username'];

        // Redirect to a welcome or dashboard page
        header("Location:links.php");
        exit();
    } else {
        echo "Invalid login credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
    <h2>User Login</h2>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>
</html>
