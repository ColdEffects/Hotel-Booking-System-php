<?php
// admin_login.php

// Include the database connection file
include('db_connect.php');
?>


<?php
// forgot_password.php
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
        

        /* Main Content */
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 60px); /* Full height minus header */
        }
        .forgot-password {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            text-align: center;
        }
        .forgot-password h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #6f7e3d;
        }
        .forgot-password form {
            margin-top: 20px;
        }
        .forgot-password input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .forgot-password button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #6f7e3d;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }
        .forgot-password button:hover {
            background-color: #5e6c33;
        }

        /* Image Section */
        .image-section {
            width: 50%;
            height: 100%;
        }
        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .forgot-password, .image-section {
                width: 100%;
                height: auto;
            }
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
        <div class="forgot-password">
            <h1>FORGOT PASSWORD</h1>
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Enter Username" required>
                <input type="email" name="email" placeholder="Enter E-mail" required>
                <button type="submit">VERIFY</button>
            </form>
        </div>

        <div class="image-section">
            <img src="hotel.jpg" alt="Room Image">
        </div>
    </div>

</body>
</html>
