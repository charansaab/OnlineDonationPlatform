
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/js/validation.js" defer></script>
</head>

<body>
    <div class="container">
        <h1>User Registration</h1>
        <form action="signup.php" method="post" id="signup" novalidate>
            

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Confirm password" name="password_confirmation" required>
            </div>
            <button type="submit" name="register" class="btn btn-secondary mb-2">Register</button>
            <div>
            <p> Already have an account? <a href="login.php" class="menu-btn">Login Here</a> </p>
        </form>        
    </div>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>

<!-- Code for user sign-up -->

<?php

if (empty($_POST["name"])) {
    die("Name is required.");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required.");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters.");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter.");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number.");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match.");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$db = require __DIR__ . "/connection.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $db->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $db->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($db->errno === 1062) {
        die("Email already exist.");
    } else {
        die($db->error . " " . $db->errno);
    }
}
?>