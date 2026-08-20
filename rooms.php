<?php
include 'db_connect.php';

// Fetch available rooms from the database
$sql = "SELECT * FROM rooms";
$stmt = $pdo->query($sql);
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);


$cartItems = $pdo->query("SELECT * FROM cart")->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['confirm_booking'])) {
  // Assuming cart is stored in a session
  session_start();
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      // Clear the cart in the session
      $_SESSION['cart'] = [];
  }

  // Optionally, you can display a confirmation message
  echo "Booking confirmed!";
  exit();
}

// Check if a room is added to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_room_id'])) {
  $roomId = $_POST['remove_room_id'];

  // Fetch current room amount from the database
  $stmt = $pdo->prepare("SELECT amount FROM rooms WHERE id = :room_id");
  $stmt->execute(['room_id' => $roomId]);
  $room = $stmt->fetch(PDO::FETCH_ASSOC);

  foreach ($_SESSION['cart'] as $item) {
    // Bind parameters for each item in the cart
    $stmt->execute([
        'image_path' => $item['image'],  // Assuming 'image' key in cart contains the image path
        'title'      => $item['title'], // Assuming 'title' key in cart contains the room title
        'price'      => $item['price'], // Assuming 'price' key in cart contains the room price
    ]);
}

  if ($room) {
      // Increment the room amount by 1
      $newAmount = $room['amount'] + 1;

      // Update the room amount in the database
      $stmt = $pdo->prepare("UPDATE rooms SET amount = :new_amount WHERE id = :room_id");
      $stmt->execute(['new_amount' => $newAmount, 'room_id' => $roomId]);
  }

  // Update the session/cart
  session_start();
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Loop through each item in the cart
    foreach ($_SESSION['cart'] as $cartItem) {
        // Prepare the SQL query to insert the item into the cart table
        $stmt = $pdo->prepare("INSERT INTO cart (image_path, title, price) VALUES (:image_path, :title, :price)");

        // Execute the query with the cart item details
        $stmt->execute([
            ':image_path' => $cartItem['image'],
            ':title'      => $cartItem['title'],
            ':price'      => $cartItem['price']
        ]);
    }
}

// Fetch available rooms from the database
$sql = "SELECT * FROM rooms";
$stmt = $pdo->query($sql);
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the cart items (optional for displaying cart items)
$cartItems = $pdo->query("SELECT * FROM cart")->fetchAll(PDO::FETCH_ASSOC);

  // Redirect back to refresh the cart
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}

if (isset($_POST['add_room_id'])) {
  $roomId = $_POST['add_room_id'];

  // Fetch current room amount from the database
  $stmt = $pdo->prepare("SELECT amount FROM rooms WHERE id = :room_id");
  $stmt->execute(['room_id' => $roomId]);
  $room = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($room && $room['amount'] > 0) {
      // Decrement the room amount by 1
      $newAmount = $room['amount'] - 1;

      // Update the room amount in the database
      $stmt = $pdo->prepare("UPDATE rooms SET amount = :new_amount WHERE id = :room_id");
      $stmt->execute(['new_amount' => $newAmount, 'room_id' => $roomId]);
  }

  exit(); // End script after processing the request
}
if (isset($_POST['confirm_booking'])) {
    // Assuming cart is stored in a session
    session_start();
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $room) {
            $roomId = $room['id'];

            // Decrement the room amount in the database
            $stmt = $pdo->prepare("SELECT amount FROM rooms WHERE id = :room_id");
            $stmt->execute(['room_id' => $roomId]);
            $roomData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($roomData && $roomData['amount'] > 0) {
                $newAmount = max(0, $roomData['amount'] - 1);
                $updateStmt = $pdo->prepare("UPDATE rooms SET amount = :new_amount WHERE id = :room_id");
                $updateStmt->execute(['new_amount' => $newAmount, 'room_id' => $roomId]);
            }
        }

        // Clear the cart
        $_SESSION['cart'] = [];
    }

    echo "Booking confirmed!";
    exit();
}
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

    body {
      overflow-x: visible;
    }
    .logo {
      text-decoration: none;
      color: black;
      font-size: 1.8em;
    }

    .nav-links {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    .nav-links li {
      margin-right: 20px;
    }

    .nav-links a {
      color: black;
      text-decoration: none;
      font-size: 1.2em;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .nav-links a:hover {
      background-color: #e0e0e0;
    }

    .rooms-container {
  display: flex;
  justify-content: space-between;
  width: 90%; /* 90% width of the screen */
  height: 90vh; /* 90% of the screen height */
  margin: 0 auto; /* Center the container */
  padding: 20px;
  background-color: #fff;

  border-radius: 8px;
}

/* Rooms List */
.rooms-list {
  flex: 0 0 75%; /* Take 75% of the screen width */
  padding-right: 20px;
  height: auto; /* Allow the container to grow based on content */
  display: flex;
  flex-wrap: wrap; /* Allow rooms to wrap to the next line */
}
.room-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 40px;
  padding: 20px;
  background-color: #fafafa;
  border-radius: 8px;
  width: 100%; /* Make room cards take full width */
  box-sizing: border-box;
}

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .room-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
      padding: 20px;
      background-color: #fafafa;
      border-radius: 8px;
    }

    .room-card img {
      width: 600px;
      height: 400px;
      object-fit: cover;
      border-radius: 8px;
    }

    .last-h2 {
      margin-bottom: 50px;
    }

    .room-info {
      flex: 1;
      margin-right: 20px;
    }

    .room-info h3 {
      margin: 0;
      font-size: 3em;
      color: #555;
    }

    .room-info p {
      margin: 15px 0;
      font-size: 1.9em;
      color: #777;
    }

    .room-info .price {
      color: #28a745;
      font-size: 1.9em;
      font-weight: bold;
    }

    .book-button {
      display: inline-block;
      padding: 12px 25px;
      font-size: 1.2em;
      color: #fff;
      background: rgb(167, 152, 77);
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .book-button:hover {
      background-color:rgb(189, 168, 66);
    }

    /* Cart Styles */
    .cart-container {
  flex: 0 0 25%; /* Cart takes 25% width */
  height: auto; /* Dynamically adjust height */
  padding: 20px;
  background-color: #f7f7f7; /* Background color */
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  margin-top: 80px;
  margin-bottom: -50px;
  box-sizing: border-box; /* Include padding in height calculations */
}

.cart-container {
  max-height: 80vh; /* Prevent the cart from becoming too tall */
  overflow-y: visible;
  background-color: #f7f7f7;
}

/* Cart Header */
.cart-container h2 {
  font-size: 1.8em;
  margin-bottom: 20px;
  color: #333;
}

/* Cart Items */
.cart-item {
  display: flex;
  align-items: center;
  margin-bottom: 20px; /* Add spacing between items */
}

.cart-item img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  margin-right: 10px;
  border-radius: 5px;
}

.cart-item-title {
  font-size: 1.2em;
  color: #333;
}

.cart-item-remove {
  font-size: 1.2em;
  color: #ff0000;
  cursor: pointer;
  margin-left: 60%;
}

.cart-total {
  text-align: right;
  font-size: 1.5em;
  font-weight: bold;
  margin-top: 20px;
}

/* Confirm Button */
.confirm-button {
  display: inline-block;
  padding: 12px 25px;
  font-size: 1.2em;
  color: #fff;
  background-color: #28a745;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
  transition: background-color 0.3s;
  margin-top: 20px;
  width: 100%;
  text-align: center;
}

.confirm-button:hover {
  background-color: #218838;
}
  </style>
</head>
<body>
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
  <div class="rooms-container">
    <div class="rooms-list">
      <h1>Available Rooms</h1>
      <?php foreach ($rooms as $room): ?>
    <div class="room-card" data-room-id="<?= htmlspecialchars($room['id']) ?>">
        <div class="room-info">
            <h3><?= htmlspecialchars($room['title']) ?></h3>
            <p class="price">$<?= htmlspecialchars($room['price']) ?> per night</p>
            <h2>Capacity: <?= htmlspecialchars($room['capacity']) ?> people</h2>
            <h2 class="last-h2">
                Amount: <?= htmlspecialchars($room['amount']) ?>
                <?php if ($room['amount'] == 0): ?>
                    <span style="color: red;">(Out of Stock)</span>
                <?php endif; ?>
            </h2>
            <p><?= htmlspecialchars($room['description']) ?></p>

            <?php if ($room['amount'] > 0): ?>
                <!-- Add to Cart Button -->
                <button class="book-button" onclick="addToCart(<?= htmlspecialchars($room['id']) ?>, '<?= htmlspecialchars($room['title']) ?>', '<?= htmlspecialchars($room['image_path']) ?>', <?= htmlspecialchars($room['price']) ?>)">Add to Cart</button>
            <?php else: ?>
                <button class="book-button" disabled>Out of Stock</button>
            <?php endif; ?>

            <!-- Hidden form for adding room to cart -->
            <form id="cart-form-<?= htmlspecialchars($room['id']) ?>" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" style="display:none;">
                <input type="hidden" name="room_id" value="<?= htmlspecialchars($room['id']) ?>">
            </form>
        </div>
        <img src="<?= htmlspecialchars($room['image_path']) ?>" alt="Room Image">
    </div>
<?php endforeach; ?>
    </div>

    <!-- Cart Sidebar -->
    <div class="cart-container">
      <h2>Your Cart</h2>
      <div id="cart-items"></div>
      <div id="cart-total" class="cart-total">Total: $0</div>

      <!-- Confirm Button (Initially Hidden) -->
      <button id="confirm-button" class="confirm-button" style="display: none;" onclick="confirmBooking()">Confirm Booking</button>
    </div>
  </div>

  <script>
    const removeButton = document.createElement('span');
removeButton.classList.add('cart-item-remove');
removeButton.textContent = 'Remove';
removeButton.onclick = () => removeFromCart(index, item.roomId);
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function addToCart(roomId, title, image, price) {
  const item = { roomId, title, image, price };
  cart.push(item);
  localStorage.setItem('cart', JSON.stringify(cart));

  // Send AJAX request to decrement the room's amount in the database
  fetch("<?= $_SERVER['PHP_SELF']; ?>", {
    method: "POST",
    body: new URLSearchParams({
      'add_room_id': roomId // Send the room_id to decrement the amount
    })
  })
  .then(response => response.text())
  .then(() => {
    // Update the cart UI
    const roomCard = document.querySelector(`.room-card[data-room-id="${roomId}"]`);
    const amountElement = roomCard.querySelector('.last-h2');
    const currentAmount = parseInt(amountElement.textContent.split(': ')[1]);

    if (currentAmount > 1) {
      amountElement.innerHTML = `Amount: ${currentAmount - 1}`;
    } else {
      amountElement.innerHTML = 'Amount: 0 <span style="color: red;">(Out of Stock)</span>';
      const button = roomCard.querySelector('.book-button');
      button.disabled = true;
    }

    updateCart();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

function removeFromCart(index, roomId) {
  // Send AJAX request to the backend to increase the room amount by 1
  fetch("<?= $_SERVER['PHP_SELF']; ?>", {
    method: "POST",
    body: new URLSearchParams({
      'remove_room_id': roomId // Send the room_id to increase the amount
    })
  })
  .then(response => response.text())
  .then(() => {
    // After the backend processes, remove the item from the cart array
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();

    // Update the room amount on the UI and enable the "Add to Cart" button
    const roomCard = document.querySelector(`.room-card[data-room-id="${roomId}"]`);
    const amountElement = roomCard.querySelector('.last-h2');
    const currentAmount = parseInt(amountElement.textContent.split(': ')[1]);

    amountElement.innerHTML = `Amount: ${currentAmount + 1}`;

    const button = roomCard.querySelector('.book-button');
    button.disabled = false;

    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

function updateCart() {
  const cartItemsDiv = document.getElementById('cart-items');
  cartItemsDiv.innerHTML = '';
  let total = 0;

  cart.forEach((item, index) => {
    total += item.price;

    const itemDiv = document.createElement('div');
    itemDiv.classList.add('cart-item');

    const itemImage = document.createElement('img');
    itemImage.src = item.image;

    const itemTitle = document.createElement('span');
    itemTitle.classList.add('cart-item-title');
    itemTitle.textContent = item.title;

    const removeButton = document.createElement('span');
    removeButton.classList.add('cart-item-remove');
    removeButton.textContent = 'Remove';
    removeButton.onclick = () => removeFromCart(index, item.roomId);

    itemDiv.appendChild(itemImage);
    itemDiv.appendChild(itemTitle);
    itemDiv.appendChild(removeButton);

    cartItemsDiv.appendChild(itemDiv);
  });

  document.getElementById('cart-total').textContent = `Total: $${total.toFixed(2)}`;

  // Dynamically adjust cart container height (optional)
  const cartContainer = document.querySelector('.cart-container');
  cartContainer.style.height = 'auto'; // Reset to allow natural expansion

  // Show the "Confirm" button if there are items in the cart
  if (cart.length > 0) {
    document.getElementById('confirm-button').style.display = 'block';
  } else {
    document.getElementById('confirm-button').style.display = 'none';
  }
}

function confirmBooking() {
  // Clear the cart from localStorage
  localStorage.removeItem('cart');

  // Send AJAX request to the server to clear the cart on the server side
  fetch("<?= $_SERVER['PHP_SELF']; ?>", {
    method: "POST",
    body: new URLSearchParams({
      'confirm_booking': true // Inform the server that booking is confirmed
    })
  })
  .then(response => response.text())
  .then(() => {
    // Update the cart UI
    updateCart(); // This will remove all items from the cart

    // Redirect to booking.php or display a confirmation message
    window.location.href = "booking.php"; // Or you can display a confirmation message here
  });
}

    // Initial call to populate cart on page load
    updateCart();
  </script>
</body>
</html>