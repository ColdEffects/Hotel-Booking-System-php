
<?php
include('db_connect.php');


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Check if the user exists in the admins table
    $admin_query = "SELECT * FROM admins WHERE username = '$username'";
    $admin_result = $conn->query($admin_query);

    if ($admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();

        // Verify the admin password (consider hashing for better security)
        if ($password === $admin['password']) {
            // Start a session for the admin
            session_start();
            $_SESSION['is_admin'] = true;
            $_SESSION['username'] = $username;

            // Add additional admin details to the session (mobile_number and address)

            // Redirect to admin_dashboard.php
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<p>Invalid admin password. Please try again.</p>";
        }
    }

    // Check if the user exists in the users table
    $user_query = "SELECT * FROM users WHERE username = '$username'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();

        // Verify the user password (use password_verify if passwords are hashed)
        if (password_verify($password, $user['password'])) {
            // Start a session for the user
            session_start();
            // $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['firstName'] = $user['firstName'];
            $_SESSION['lastName'] = $user['lastName'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['mobile_number'] = $user['mobile_number'];
            $_SESSION['address'] = $user['address'];

            // Redirect to profile.php
            header("Location: profile.php");
            exit();
        } else {
            echo "<p>Invalid user password. Please try again.</p>";
        }
    } else {
        echo "<p>No user found with the provided username. Please sign up first.</p>";
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

    <title>Hrs &mdash; Where Comfort Meets Luxury, Every Stay is Special.</title>
    <style>


        .container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .left {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
        }

        .left h1 {
            font-size: 3rem;
            color: #8a9b48;
            margin-bottom: 20px;
        }

        .left form input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .left form button {
            padding: 10px 20px;
            background-color: #8a9b48;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .left form button:hover {
            background-color: #6e7a36;
        }

        .left a {
            color: #6e7a36;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .right {
            width: 50%;
            background-image: url('hotel.jpg'); /* Replace with your image file */
            background-size: cover;
            background-position: center;
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
        <div class="left">
            <h1>LOGIN</h1>
            <form method="POST" action="login.php">
                <input type="text" name="username" placeholder="Enter Username" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <a href="ForgotPass.php">Forgot password?</a>
                <button type="submit">Log In</button>
            </form>
            <p>Don't have an account? <a href="Signup.php">Sign Up</a></p>
        </div>
        <div class="right"></div>
    </div>
</body>
</html>
