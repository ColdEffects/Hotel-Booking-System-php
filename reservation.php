<?php
include 'db_connect.php';

// Fetch available rooms from the database
$sql = "SELECT * FROM rooms";
$stmt = $pdo->query($sql);
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);





session_start();
if (!isset($_SESSION['email'])) {
    echo "Session email is not set.";
    exit();
}



$firstName = htmlspecialchars($_SESSION['firstName']);
$lastName = htmlspecialchars($_SESSION['lastName']);
$email = htmlspecialchars($_SESSION['email']);
$username = htmlspecialchars($_SESSION['username']);
$address = htmlspecialchars($_SESSION['address']);
$mobile_number = htmlspecialchars($_SESSION['mobile_number']);
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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .dashboard-container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar styles */
        .sidebar {
            background-color: #333;
            color: #fff;
            width: 250px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-info h2 {
            font-size: 20px;
            margin: 0;
        }

        .nav-links {
            list-style: none;
            padding: 0;
        }

        .nav-links li {
            margin: 20px 0;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* Main content styles */
        .main-content {
    flex-grow: 1;
    padding: 20px;
    background-color: #fff;
    overflow-y: auto; /* Enable vertical scrolling */
    height: calc(100vh - 60px); /* Ensure the content area takes full height minus the top header */
    max-height: 100%; /* Ensures that the content will not overflow the window */
}

        header {
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 30px;
            color: #333;
        }

        .reservation-form {
            background-color: #fafafa;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        .reservation-form label {
            font-size: 16px;
        }

        .reservation-form input,
        .reservation-form select {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .reservation-form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .reservation-form button:hover {
            background-color: #45a049;
        }





        .rooms-list {
            max-width: 1500px;
            max-length
            margin-left: 70px;
  flex: 0 0 75%; 
  padding-right: 20px;
  height: auto; 
  display: flex;
  flex-wrap: wrap; 
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


    .cancel-button {
    background-color: #e74c3c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.cancel-button:hover {
    background-color: #c0392b;
}
    </style>
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile-info">
            <img src="img/profile-picture.jpg" alt="Profile Picture" class="profile-pic">
            <h2><?php echo $firstName . " " . $lastName; ?></h2>
        </div>
        <ul class="nav-links">
        <li><a href="profile.php">Home</a></li>
        <li><a href="reservation.php">Reservation</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main content area -->
    <div class="main-content">
        <header>
            <h1>Reservation</h1>
        </header>
        
        <!-- Reservation Form -->
        <div class="rooms-container">
    <div class="rooms-list">
      <?php foreach ($rooms as $room): ?>
    <div class="room-card" data-room-id="<?= htmlspecialchars($room['id']) ?>">
        <div class="room-info">
            <h3><?= htmlspecialchars($room['title']) ?></h3>
            <p class="price">$<?= htmlspecialchars($room['price']) ?> per night</p>
            <h2>Capacity: <?= htmlspecialchars($room['capacity']) ?> people</h2>
            <p><?= htmlspecialchars($room['description']) ?></p>
            <button class="cancel-button" onclick="confirmDelete(<?= $room['id'] ?>)">Cancel</button>
        </div>
        <img src="<?= htmlspecialchars($room['image_path']) ?>" alt="Room Image">
    </div>
    
<?php endforeach; ?>
    </div>
    <script>
    function confirmDelete(roomId) {
    if (confirm("Are you sure you want to cancel this room?")) {
        // Find the room card with the corresponding room ID and remove it
        var roomCard = document.querySelector('.room-card[data-room-id="' + roomId + '"]');
        if (roomCard) {
            roomCard.remove(); // Remove the room card from the page
        }
    }
}
</script>
</div>
</body>
</html>