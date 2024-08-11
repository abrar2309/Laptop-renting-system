<!-- register.php -->

<?php
require_once('connect.php');

$errors = array();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user registration
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
   /* $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);*/
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Simple form validation (you can enhance this as needed)
    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (empty($firstName)) {
        $errors[] = "First Name is required";
    }

    if (empty($lastName)) {
        $errors[] = "Last Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    }

    if (empty($phone)) {
        $errors[] = "Phone is required";
    }

    // If there are no validation errors, proceed with registration
    if (empty($errors)) {
        // Check if the username is already taken
        $check_username = "SELECT * FROM users WHERE Username = '$username'";
        $result_username = $conn->query($check_username);

        if ($result_username->num_rows > 0) {
            $errors[] = "Username is already taken. Please choose a different one.";
        } else {
            // Insert data into the 'users' table
            $insert_user = "INSERT INTO users (Username, Password, FirstName, LastName, Email, Phone)
                            VALUES ('$username', '$password', '$firstName', '$lastName', '$email', '$phone')";

            if ($conn->query($insert_user) === TRUE) {
                echo "Registration successful!";
                // You can redirect the user or perform other actions as needed
            } else {
                $errors[] = "Error: " . $insert_user . "<br>" . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>User Registration</h2>

    <?php
    // Display validation errors if any
    if (!empty($errors)) {
        echo '<div class="error"><ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul></div>';
    }
    ?>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

       <!--<label for="password">confirm_Password:</label>
        <input type="password" id="conifrm_password" name="password" required>-->

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <button type="submit">Register</button><br><br>

        <button><a href="login.php">Already register ? Login</a></button>
    </form>
</body>
</html>
