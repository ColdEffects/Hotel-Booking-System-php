

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
.gallery-section {
    padding: 40px 20px; 
    background-color: #f9f9f9; 
    text-align: center; 
}

.gallery-title {
    font-size: 28px; 
    margin-bottom: 20px; 
}

.gallery-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);  /* 4 equal-width columns */
    gap: 20px;  /* Space between the images */
}

.gallery-item {
    overflow: hidden; 
    /* border-radius: 8px;  */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
}

.gallery-item img {
    width: 100%;  /* Make sure images fill the container */
    height: auto; /* Maintain aspect ratio */
    display: block; 
    transition: transform 0.3s ease; 
}

.gallery-item img:hover {
    transform: scale(1.05); 
}



</style>
</head>
<body>
    <header class="header">
        <a href="#">
            <img class="logo" alt="Logo" src="img/logo-placeholder-image.png" />
        </a>
        <nav class="main-nav">
            <ul class="main-nav-list">
            <li><a class="main-nav-link" href="index.php">Home</a></li>
        <li><a class="main-nav-link" href="gallery.php">Gallery</a></li>
        <li><a class="main-nav-link" href="about_us.php">About us</a></li>
        <li><a class="main-nav-link" href="Login.php">Log in</a></li>
        <li><a class="main-nav-link nav-cta" href="Signup.php">Sign up</a></li>
            </ul>
        </nav>
        <button class="btn-mobile-nav">
            <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
            <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
        </button>
    </header>

    <section class="gallery-section">
    <h2 class="gallery-title">Our Hotel Gallery</h2>
    <div class="gallery-container">
        <div class="gallery-item">
            <img src="img/gallery/gallery-1.jpg" alt="Hotel Room 1" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-2.jpg" alt="Hotel Room 2" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-3.jpg" alt="Hotel Room 3" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-4.jpg" alt="Hotel Room 4" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-5.jpg" alt="Hotel Room 5" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-6.jpg" alt="Hotel Room 6" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-7.jpg" alt="Hotel Room 7" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-8.jpg" alt="Hotel Room 8" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-9.jpg" alt="Hotel Room 9" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-10.jpg" alt="Hotel Room 10" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-11.jpg" alt="Hotel Room 11" />
        </div>
        <div class="gallery-item">
            <img src="img/gallery/gallery-12.jpg" alt="Hotel Room 12" />
        </div>
    </div>
</section>

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
