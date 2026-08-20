<?php
// admin_login.php

// Include the database connection file
include('db_connect.php');


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_account'])) {
    // Retrieve and sanitize form inputs
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $address = $conn->real_escape_string($_POST['address']);
    $mobile_number = $conn->real_escape_string($_POST['mobile_number']);
    $email = $conn->real_escape_string($_POST['email']);
    $confirm_email = $conn->real_escape_string($_POST['confirm_email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate email match
    if ($email !== $confirm_email) {
        echo "Emails do not match!";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {

    

        // Prepare and execute the SQL query
        $sql = "INSERT INTO users (username, password, firstName, lastName, email, mobile_number, address) 
                VALUES ('$username', '$password', '$first_name', '$last_name', '$email', '$mobile_number', 'address')";

        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>








<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Omnifood is an AI-powered food subscription that will make you eat healthy again, 365 days per year. It's tailored to your personal tastes and nutritional needs."
    />


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" href="img/favicon.png" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/queries.css" />

    <script
      type="module"
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>

    <script
      defer
      src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"
    ></script>
    <script defer src="js/script.js"></script>

    <title>Omnifood &mdash; Never cook again!</title>
    <style>

        .container {
            display: flex;
        }

        .left {
            width: 50%;
            background-image: url('hotel.jpg'); /* Replace with your image file */
            background-size: cover;
            background-position: center;
            height: auto;
        }

        .right {
            width: 50%;
            padding: 40px;
            background-color: #f9f9f9;
        }

        .form-section {
            margin-bottom: 30px;
        }

        h1 {
            color: #8a9b48;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        form button {
            padding: 10px 20px;
            background-color: #8a9b48;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        form button:hover {
            background-color: #6e7a36;
        }
    </style>
</head>
<body>
<header class="header">
      <a href="#">
        <img class="logo" alt="Cavern logo" src="img/logo.png" />
      </a>

      <nav class="main-nav">
        <ul class="main-nav-list">
        <li><a class="main-nav-link" href="index.php">Home</a></li>
          <li><a class="main-nav-link" href="gallery.php">Gallery</a></li>
          <li><a class="main-nav-link" href="about_us.php">About us</a></li>
          <li><a class="main-nav-link" href="Login.php" >Log in</a></li>
          <li><a class="main-nav-link nav-cta" href="Signup.php">Sign up</a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>

    <div class="container">
        <div class="left"></div>
        <div class="right">
            <h1>SIGN UP</h1>
            <form method="POST" action="">
                <div class="form-section">
                    <h2>Personal Details</h2>
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <input type="text" name="address" placeholder="Full Address" required>
                    <input type="text" name="mobile_number" placeholder="Mobile Number" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="email" name="confirm_email" placeholder="Confirm E-mail" required>
                    <button type="button">VERIFY E-MAIL</button>
                    <input type="text" name="verification_code" placeholder="Verification Code">
                    <button type="button">CONFIRM</button>
                </div>
                <div class="form-section">
                    <h2>Account Details</h2>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit" name="create_account">CREATE ACCOUNT</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
