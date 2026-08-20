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

    <main>
      <section class="section-hero">





        
        <div class="hero">
          <div class="hero-text-box">
            <h1 class="heading-primary">
              HRS hotel and resort
            </h1>
            <p class="hero-description">
            Welcome to HRS, where luxury meets comfort in the heart of Batangas. Our hotel offers a unique blend of modern amenities and timeless elegance, designed to make your stay as relaxing and memorable as possible.
            </p>
            <a class="btn btn--full margin-right-sm" href="booknow.php">Book Now</a>

            <a href="#about" class="btn btn--outline">Learn more &darr;</a>
            <div class="delivered-meals">
              <div class="delivered-imgs">
                <img src="img/customers/customer-1.jpg" alt="Customer photo" />
                <img src="img/customers/customer-2.jpg" alt="Customer photo" />
                <img src="img/customers/customer-3.jpg" alt="Customer photo" />
                <img src="img/customers/customer-4.jpg" alt="Customer photo" />
                <img src="img/customers/customer-5.jpg" alt="Customer photo" />
                <img src="img/customers/customer-6.jpg" alt="Customer photo" />
              </div>
              <p class="delivered-text">
                <span>25,000+</span> people booked last year!
              </p>
            </div>
          </div>
         
        </div>
      </section>



      <section class="section-pricing" id="about">
        <div class="container">
          <span class="subheading">Discover Us</span>
          <h2 class="heading-secondary">
          What We Do
          </h2>
        </div>
      <div class="container grid grid--4-cols">
        <div class="feature">
          <ion-icon class="feature-icon" name="bed-outline"></ion-icon>
          <p class="feature-title">Luxurious Retreat</p>
          <p class="feature-text">
          Each of our beautifully appointed rooms is equipped with plush bedding, high-speed internet access, flat-screen TVs, and mini-fridges, ensuring your utmost convenience.
          </p>
        </div>
        <div class="feature">
          <ion-icon class="feature-icon" name="home-outline"></ion-icon>
          <p class="feature-title">Prime Location</p>
          <p class="feature-text">
          For those seeking a more luxurious experience, we offer spacious suites with stunning city views, a private living area, and premium services.
          </p>
        </div>
        <div class="feature">
          <ion-icon class="feature-icon" name="shirt-outline"></ion-icon>
          <p class="feature-title">Elegant Comfort</p>
          <p class="feature-text">
          Indulge in delicious dining options at our on-site restaurant, offering a variety of gourmet dishes made with the finest local ingredients.
          </p>
        </div>
        <div class="feature">
          <ion-icon class="feature-icon" name="desktop-outline"></ion-icon>
          <p class="feature-title">Exclusive Experience</p>
          <p class="feature-text">
          Enjoy a refreshing cocktail at the bar or take advantage of our 24-hour room service.
          </p>
        </div>
      </div>
    </section>





      

      

      <section class="section-meals" id="rooms">
        <div class="container center-text">
          <span class="subheading">Hotels</span>
          <h2 class="heading-secondary">
            Our Rooms
          </h2>
        </div>

       


        <div class="grid-container">
          <div class="grid-item">
            <img src="img/our-rooms-1.jpg" alt="Hotel Dining">
            <div class="view-more-text">Hotel Dining</div>
            <button class="view-more" onclick="window.location.href='gallery.php'">View More</button>
          </div>
          <div class="grid-item">
            <img src="img/our-rooms-2.jpg" alt="Events">
            <div class="view-more-text">Events</div>
            <button class="view-more" onclick="window.location.href='gallery.php'">View More</button>
          </div>
          <div class="grid-item">
            <img src="img/our-rooms-3.jpg" alt="Rooms">
            <div class="view-more-text">Rooms</div>
            <button class="view-more" onclick="window.location.href='gallery.php'">View More</button>
          </div>
        </div>




       
      </section>

      <section class="section-testimonials" id="feedbacks">
        <div class="testimonials-container">
          <span class="subheading">Feedbacks</span>
          <h2 class="heading-secondary">What our guests say</h2>

          <div class="testimonials">
            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Dave Bryson"
                src="img/customers/dave.jpg"
              />
              <blockquote class="testimonial-text">
              The service was exceptional, and the staff went above and beyond to ensure our comfort. I highly recommend this hotel for a memorable stay
              </blockquote>
              <p class="testimonial-name">&mdash; Florencio</p>
            </figure>

            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Ben Hadley"
                src="img/customers/ben.jpg"
              />
              <blockquote class="testimonial-text">
              The rooms were comfortable, and the hotel’s location was perfect for exploring the city. We had a wonderful time and will definitely return.
              </blockquote>
              <p class="testimonial-name">&mdash; Mark David</p>
            </figure>

            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Steve Miller"
                src="img/customers/steve.jpg"
              />
              <blockquote class="testimonial-text">
              This was the perfect stay! From the amenities to the attention to detail, everything exceeded our expectations.
              </blockquote>
              <p class="testimonial-name">&mdash; Steve Miller</p>
            </figure>

            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Hannah Smith"
                src="img/customers/hannah.jpg"
              />
              <blockquote class="testimonial-text">
              The staff was incredibly friendly and welcoming, and the amenities were top-notch. It made our trip unforgettable, and we’ll be back for sure!
              </blockquote>
              <p class="testimonial-name">&mdash; Hannah Smith</p>
            </figure>
          </div>
        </div>

        <div class="gallery">
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-1.jpg"
              alt="Photo of beautifully
            arranged food"
            />
           
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-2.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-3.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-4.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-5.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-6.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-7.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-8.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-9.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-10.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-11.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-12.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
        </div>
      </section>

    

      
    </main>

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
