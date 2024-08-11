<!-- feedback.php -->

<?php
require_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process feedback submission
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    // Simple form validation (you can enhance this as needed)
    if (empty($feedback)) {
        $errors[] = "Feedback cannot be empty";
    }

    // If there are no validation errors, proceed with feedback submission
    if (empty($errors)) {
        $user_id = $_SESSION['user_id'];

        // Insert feedback into the 'feedback' table
        $insert_feedback = "INSERT INTO feedback (UserID, Feedback) VALUES ('$user_id', '$feedback')";

        if ($conn->query($insert_feedback) === TRUE) {
            echo "Feedback submitted successfully!";
        } else {
            $errors[] = "Error: " . $insert_feedback . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
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

        textarea {
            width: 100%;
            height: 100px;
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
    <h2>Feedback</h2>

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
        <label for="feedback">Your Feedback:</label>
        <textarea id="feedback" name="feedback" required></textarea>

        <button type="submit">Submit Feedback</button>
    </form>
</body>
</html>
