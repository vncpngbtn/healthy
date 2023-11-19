<?php
session_start(); // Start the session - This should be the very first line
require_once('db_config.php'); // Include the database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Retrieve form data and sanitize
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $middle_name = $conn->real_escape_string($_POST['middle_name']);
    $address = $conn->real_escape_string($_POST['address']);
    $zip_code = intval($_POST['zip_code']); // Convert to integer
    $p_number = intval($_POST['p_number']); // Convert to integer
    $gmail = $conn->real_escape_string($_POST['gmail']);
    $patient_password = $_POST['patient_password'];
    $confirm_password = $_POST['confirm_password'];
   

    // Check if the email is already registered
    $check_email_sql = "SELECT * FROM patient_users WHERE gmail = ?";
    $check_email_stmt = $conn->prepare($check_email_sql);
    $check_email_stmt->bind_param("s", $gmail);
    $check_email_stmt->execute();
    $check_email_result = $check_email_stmt->get_result();

    

    // Validation checks
    $errors = array();

    if (empty($first_name) || empty($last_name) || empty($middle_name) || empty($address) || empty($zip_code) || empty($p_number) || empty($gmail) || empty($patient_password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }
    if ($check_email_result->num_rows > 0) {
        $errors[] = "This email is already registered.";
    }

    if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($patient_password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Hash the password for security
        $hashed_password = password_hash($patient_password, PASSWORD_DEFAULT);

        $status = 0;
        $registration_date = date("Y-m-d H:i:s"); // Current timestamp

        // Insert data into the database using a prepared statement
        $sql = "INSERT INTO patient_users (first_name, last_name, middle_name, address, zip_code, p_number, gmail, patient_password, registration_date ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $first_name, $last_name, $middle_name, $address, $zip_code, $p_number, $gmail, 
            $hashed_password, $registration_date );

        if ($stmt->execute()) {
            // Registration successful
            header("Location: signin.php"); // Redirect to a success page
            exit();
        } else {
            die("Error: " . $stmt->error);
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for form styling */
        body {
            background-color: #f2f2f2;
        }

        .container {
            background: linear-gradient(45deg, #fff, #f2f2f2);
            border: 2px solid #007BFF;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
            width: 400px;
            transition: background-position 0.3s;
            cursor: pointer;
        }

        .container:hover {
            background-position: 100% 0;
        }

        h1 {
            color: #007BFF;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        button {
            background: linear-gradient(45deg, #007BFF, #0051A8);
            border: none;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background: linear-gradient(45deg, #0051A8, #007BFF);
        }

        /* Style for the "Have an account? Sign in here" link */
        .signin-link {
            text-align: center;
            margin-top: 10px;
        }

        .signin-link a {
            text-decoration: none;
            color: #007BFF;
        }

        .signin-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient Registration</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" id="middle_name" name="middle_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="zip_code">Zipcode</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="p_number">Phone Number</label>
                <input type="text" id="p_number" name="p_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gmail">Email:</label>
                <input type="email" id="gmail" name="gmail" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="patient_password">Password:</label>
                <input type="password" id="patient_password" name="patient_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
        
        <!-- "Have an account? Sign in here" link -->
        <div class="signin-link">
            <p>Have an account? <a href="signin.php">Sign in here</a></p>
        </div>
    </div>

    <!-- Add Bootstrap JavaScript (jQuery and Popper.js required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

