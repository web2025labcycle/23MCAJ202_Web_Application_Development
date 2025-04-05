<?php
// Variables to control display and messages
$showForm = true; // To decide whether to show the form
$successMessage = ""; // To hold success message

// Initialize form field and error variables
$name = $email = "";
$nameError = $emailError = $passwordError = $confirmPasswordError = "";

// Check if form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and trim form data to remove unwanted spaces
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $isValid = true; // Assume input is valid unless an error is found

    // Validate name (only letters and spaces allowed)
    if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $nameError = "Name must contain only letters and spaces.";
        $isValid = false;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        $isValid = false;
    }

    // Validate password (at least 8 chars, 1 uppercase, 1 number, 1 special char)
    if (
        strlen($password) < 8 ||
        !preg_match("/[A-Z]/", $password) ||
        !preg_match("/[0-9]/", $password) ||
        !preg_match("/[!@#$%^&*]/", $password)
    ) {
        $passwordError = "Password must be at least 8 characters, contain 1 uppercase letter, 1 number, and 1 special character.";
        $isValid = false;
    }

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $confirmPasswordError = "Passwords do not match.";
        $isValid = false;
    }

    // If everything is valid, show success message and hide the form
    if ($isValid) {
        $showForm = false; // hide form
        $successMessage = "<h2 style='color: green;'>Successfully Registered</h2>
                           <p><strong>Name:</strong> $name</p>
                           <p><strong>Email:</strong> $email</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        /* Styling for form and layout */
        body { font-family: Arial, sans-serif; background-color: #d6c3c3a2; }
        .container { width: 500px; margin: 50px auto; background: lightblue; padding: 20px; border-radius: 30px; }
        label { display: block; margin-top: 18px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; border: none; border-radius: 8px; background-color: #1c6679; color: white; }
        .error { color: red; font-size: 12px; }
        button { margin-top: 10px; padding: 8px; width: 100%; background: #440b2a; border: none; color: white; border-radius: 8px; cursor: pointer; font-size: 16px; }
        .message { margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="container">
        <?php if (!$showForm): ?>
            <!-- Display success message if form submitted successfully -->
            <div class="message">
                <?php echo $successMessage; ?>
            </div>
        <?php else: ?>
            <!-- Display form if not submitted or has errors -->
            <h2>Registration Form</h2>
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"><?php echo $nameError; ?></span>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailError; ?></span>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span class="error"><?php echo $passwordError; ?></span>

                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword">
                <span class="error"><?php echo $confirmPasswordError; ?></span>

                <button type="submit">Register</button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
