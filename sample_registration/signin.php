<?php
session_start();

require_once('db_config.php'); // Include the database configuration file
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'email' and 'password' keys exist in $_POST
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Validation checks
        if (empty($email) || empty($password)) {
            $errors[] = "Both email and password are required.";
        }

        try {
            
            // Prepare SQL statement to retrieve user information by email from the student_user table
            $sql_patient = "SELECT * FROM patient_users WHERE gmail = ?";
            $stmt_patient = $conn->prepare($sql_patient);
            $stmt_patient->bind_param("s", $email);
            $stmt_patient->execute();
            $result_patient = $stmt_patient->get_result();

             if ($result_patient->num_rows === 1) {
                $user = $result_patient->fetch_assoc();
                if (password_verify($password, $user['patient_password'])) {
                    // Authentication successful for student user
                    // You can set user session variables here if needed
                    // Store user email and user type in session
                    $_SESSION['gmail'] = $user['gmail'];
                   echo '<script>alert("Successfully.");</script>';
                   header("Location:homepage.php"); // Redirect to the dashboard or any other page 
                    exit();
                }

            } else {
                    $errors[] = "Account doesn't exist.";
            }

            
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        } finally {
            $stmt_patient->close();
        }
    } else {
        $errors[] = "Both email and password are required.";
    }
}


      
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Add your custom CSS styles here -->
        <style>
        /* Style for the body */
        body {
            background-image: url(''); /* Add your engaging background image URL here */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Style for the container */
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2); /* Box shadow for container */
            max-width: 400px;
            width: 90%;
        }

        /* Style for the header */
        h1 {
            color: #007BFF;
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Style for the form elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 80%;
            padding: 12px;
            font-size: 16px;
            border: none;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            outline: none;
            transition: background-color 0.3s;
        }

        .form-control:focus {
            background-color: #fff; /* Change background color on focus */
        }

        /* Style for the Sign In button */
        .signin-button {
            background-color: #007BFF;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .signin-button:hover {
            background-color: #0051A8;
        }

        /* Style for the Sign Up link */
        .signup-link {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .signup-link:hover {
            color: #0051A8;
        }
    </style>

</head>
<body>
    <div class="container">
        <h1>Sign In</h1>
        <!-- Add JavaScript for error handling -->
        <script>
                // Function to display error message as a pop-up
                function showError(message) {
                    var errorDiv = document.createElement("div");
                    errorDiv.className = "alert alert-danger";
                    errorDiv.innerHTML = message;
                    var container = document.querySelector(".container");
                    container.appendChild(errorDiv);
                    setTimeout(function() {
                        errorDiv.style.display = "none";
                    }, 3000); // Hide the error message after 3 seconds (adjust as needed)
                }

                // Check for PHP errors and display appropriate messages
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "showError('" . addslashes($error) . "');";
                    }
                }
                ?>
            </script>

        <form action="signin.php" method="POST">
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="signin-button">Sign In</button>
        </form>
        <p>Don't have an account? <a class="signup-link" href="register.php">Sign up here</a></p>
    </div>
</body>
</html>


