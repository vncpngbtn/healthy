<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <style>
        /* Style for the gradient white container */
        .container-box {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border: 2px solid #007BFF; /* Blue border */
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 50% auto; /* Center the container both horizontally and vertically */
        }

        /* Common style for signup buttons */
        .signup-button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
            width: 100%; /* Make buttons the same width */
            transition: background-color 0.3s, color 0.3s; /* Smooth background color and text color transition */
        }

        /* Style for gradient-colored buttons */
        .patient-button {
            background: linear-gradient(45deg, #007BFF, #0051A8); /* Blue gradient */
            color: #fff; /* White text color */
        }

        .guest-button {
            background: linear-gradient(45deg, #00FF00, #00B800); /* Green gradient */
            color: #fff; /* White text color */
        }

        /* Hover effect for signup buttons */
        .signup-button:hover {
            background-color: transparent; /* Transparent background on hover */
            color: yellow; /* Yellow text color on hover */
        }

        /* Style for the "Have an account? Sign In" link */
        .signin-link {
            text-decoration: none;
            color: #007BFF;
            display: block;
            margin-top: 20px;
            transition: color 0.3s; /* Smooth color transition on hover */
        }

        .signin-link:hover {
            color: #FFD700; /* Dark yellow color on hover */
            text-decoration: none; /* Remove underline on hover */
        }

        /* Style for the registration text */
        .registration-text {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #007BFF; /* Blue color for registration text */
        }

        /* Background image for the body */
        body {
            background-image: url('imus.jpg'); /* Background image */
            background-size: cover; /* Cover the entire viewport */
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="container-box">
                    <p class="registration-text">Registration</p>
                    <button class="signup-button patient-button" onclick="location.href='register_patient.php'">Sign up as a Patient</button>
                    
                    <a class="signin-link" href="signin.php">Have an account? Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JavaScript (jQuery and Popper.js required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
