<?php
// admin_login.php

// Include the database connection file
include('db_connect.php');
?>

<?php
// Get today's date in the required format (YYYY-MM-DD)
$today = date('Y-m-d');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Ensure check-in and check-out are valid
    if (strtotime($checkin) < strtotime(date('Y-m-d'))) {
        die('Check-in date cannot be in the past.');
    }

    if (strtotime($checkout) <= strtotime($checkin)) {
        die('Check-out date must be after the check-in date.');
    }

    // Proceed with form processing (e.g., saving to database)
    echo "Dates are valid. Check-in: $checkin, Check-out: $checkout";
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
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

.book-now-section {
    display: flex; /* Use flexbox for centering */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 100px; /* Set a height for the section */
    background-color: rgba(0, 0, 0, 0.8); /* Darkish background */
    margin: 40px 0; /* Add some margin above and below */
}

.book-now-box {
    padding: 20px; /* Add some padding around the text */
    border-radius: 8px; /* Rounded corners */
}

.book-now-text {
    color: white; /* Text color */
    font-size: 24px; /* Font size */
    text-align: center; /* Center the text */
}


        /* Reservation form container with background image */
        .checkout-container {
            background-image: url('background.png');
            background-size: cover; 
            background-position: center center; 
            background-repeat: no-repeat; 
            width: 100%;
            height: 59%; 
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-top: 20px; */
        }

        .checkout-form {
            background-color: rgba(0, 0, 0, 0.8); /* Transparent black background */
            padding: 30px;
            border-radius: 8px;
            width: 90%;
            max-width: 900px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            
        }

        /* .form-field {
            margin-bottom: 20px;
        } */

        .checkout-field label {
            color: white;
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .checkout-field input,
        .checkout-field select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: white; /* Make input fields white */
        }

        .checkout-field button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            background-color: #84873A;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .checkout-field button:hover {
            background-color: #555;
        }

        .checkout-field button:active {
            background-color: #444;
        }

        .checkout-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Flexbox for Check-in and Check-out fields */
        .date-fields {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .date-fields .checkout-field {
            flex: 1;
        }

        @media (max-width: 768px) {
            .checkout-form {
                padding: 20px;
            }
            .date-fields {
                flex-direction: column;
            }
            .date-fields .checkout-field {
                flex: none;
                margin-bottom: 15px;
            }
        }

        .h2-reservation {
    background: rgb(167, 152, 77);
    color: rgb(255, 255, 255);
    font-size: 15px;
    border-bottom: 5px groove rgb(255, 255, 255);
    margin: auto; /* Center horizontally and add top margin */
    padding: 15px;
    border-radius: 8px;
    width: 90%;
    max-width: 900px;
    text-align: center; /* Optional: Center text inside the element */
    margin-top: 40px;
}
    </style>
</head>
<body>

<!-- Header Section -->
<header class="header">
    <a href="#">
      <img class="logo" alt="Cavern logo" src="img/logo-placeholder-image.png" />
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

<!-- Reservation Form Section -->


<section class="book-now-section">
    <div class="book-now-box">
        <h2 class="book-now-text">BOOK NOW!</h2>
    </div>
</section>


 <h2 class="h2-reservation">Reservation</h2>
<div class="checkout-container">
    <div class="checkout-form">
    <form action="rooms.php" method="POST">
        <div class="date-fields">
            <!-- Check-in Date -->
            <div class="checkout-field">
                <label for="checkin">Check-in Date</label>
                <input 
                    type="date" 
                    id="checkin" 
                    name="checkin" 
                    min="<?php echo $today; ?>" 
                    required>
            </div>

            <!-- Check-out Date -->
            <div class="checkout-field">
                <label for="checkout">Check-out Date</label>
                <input 
                    type="date" 
                    id="checkout" 
                    name="checkout" 
                    required>
            </div>

            <div class="checkout-field button-container">
                <button type="submit">SEARCH</button>
            </div>
        </div>
    </form>

    <script>
        // Get references to the date input fields
        const checkInInput = document.getElementById('checkin');
        const checkOutInput = document.getElementById('checkout');

        // Set the minimum date for check-out when check-in changes
        checkInInput.addEventListener('change', function () {
            const checkInDate = new Date(checkInInput.value);
            const nextDay = new Date(checkInDate);
            nextDay.setDate(checkInDate.getDate() + 1); // Calculate the next day

            // Update the check-out field's minimum date
            checkOutInput.setAttribute('min', nextDay.toISOString().split('T')[0]);

            // Clear check-out if it is before the new minimum date
            if (new Date(checkOutInput.value) <= checkInDate) {
                checkOutInput.value = '';
            }
        });

        // Validate the check-out date
        checkOutInput.addEventListener('change', function () {
            const checkInDate = new Date(checkInInput.value);
            const checkOutDate = new Date(checkOutInput.value);

            if (checkOutDate <= checkInDate) {
                alert('Check-out date must be after the check-in date.');
                checkOutInput.value = '';
            }
        });
    </script>
    
    </div>
</div>


<footer class="footer">
      <div class="container grid grid--footer">
        <div class="logo-col">

          <ul class="social-links">
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-instagram"></ion-icon
              ></a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-facebook"></ion-icon
              ></a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-twitter"></ion-icon
              ></a>
            </li>
          </ul>

          <p class="copyright">
            Copyright &copy; <span class="year">2027</span> by Hrs, Inc.
            All rights reserved.
          </p>
        </div>

        <div class="address-col">
          <p class="footer-heading">Contact us</p>
          <address class="contacts">
            <p class="address">
              623 Harrison St., 2nd Floor, San Francisco, CA 94107
            </p>
            <p>
              <a class="footer-link" href="tel:415-201-6370">415-201-6370</a
              ><br />
              <a class="footer-link" href="mailto:hello@omnifood.com"
                >hello@gmail.com</a
              >
            </p>
          </address>
        </div>

        <nav class="nav-col">
          <p class="footer-heading">Account</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">Create account</a></li>
            <li><a class="footer-link" href="#">Sign in</a></li>
            <li><a class="footer-link" href="#">iOS app</a></li>
            <li><a class="footer-link" href="#">Android app</a></li>
          </ul>
        </nav>

        <nav class="nav-col">
          <p class="footer-heading">Company</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">About Hrs</a></li>
            <li><a class="footer-link" href="#">For Business</a></li>
            <li><a class="footer-link" href="#">Hotel partners</a></li>
            <li><a class="footer-link" href="#">Careers</a></li>
          </ul>
        </nav>

        <nav class="nav-col">
          <p class="footer-heading">Resources</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">Hotel directory </a></li>
            <li><a class="footer-link" href="#">Help center</a></li>
            <li><a class="footer-link" href="#">Privacy & terms</a></li>
          </ul>
        </nav>
      </div>
    </footer>
</body>
</html>
