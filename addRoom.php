
<?php
// admin_login.php

// Include the database connection file
include('db_connect.php');
?>


<?php


$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form fields are set
    if (isset($_POST['price'], $_POST['title'], $_POST['description'], $_POST['amount'], $_FILES['image'], $_POST['capacity'])) {
        $price = $_POST['price'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $amount = $_POST['amount']; 
        $capacity = $_POST['capacity'];

        // Handle image upload
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Insert room details into the database
            $sql = "INSERT INTO rooms (price, title, description, amount, image_path, capacity) 
        VALUES (:price, :title, :description, :amount, :image_path, :capacity)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':image_path', $target);
            $stmt->bindParam(':capacity', $capacity);

            if ($stmt->execute()) {
                // Redirect after successful form submission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                $message = "Error adding room.";
            }
        } else {
            $message = "Failed to upload image.";
        }
    } else {
        $message = "All fields are required.";
    }
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


    <title>Hrs &mdash; Where Comfort Meets Luxury, Every Stay is Special.</title>
    <style>
        /* Reset and base styles */

        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    }
/* Prevent extra space caused by the layout */

       
       
        
        /* Container styles */
        .container {
            width: 100%;
            max-width: 1400px;
            margin: 2rem auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 2rem;
        }
        /* Form styles */
        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Message styles */
        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            .header {
                padding: 0 2.4rem;
            }
            .main-nav {
                background-color: rgba(255, 255, 255, 0.97);
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                transform: translateX(100%);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.5s ease-in;
                opacity: 0;
                pointer-events: none;
                visibility: hidden;
            }
            .nav-open .main-nav {
                opacity: 1;
                pointer-events: auto;
                visibility: visible;
                transform: translateX(0);
            }
            .nav-open .icon-mobile-nav[name="close-outline"] {
                display: block;
            }
            .nav-open .icon-mobile-nav[name="menu-outline"] {
                display: none;
            }
            .main-nav-list {
                flex-direction: column;
                gap: 4.8rem;
            }
            .main-nav-link:link,
            .main-nav-link:visited {
                font-size: 3rem;
            }
            .btn-mobile-nav {
                display: block;
                z-index: 9999;
            }
        }


        .dashboard {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.header {
    background-color:rgb(214, 192, 132);
    color: white;
    padding: 20px;
    text-align: center;
}

.sidebar-container {
    display: flex;
    flex: 1;
    margin: 10px;
}

.sidebar {
    width: 200px;
    background-color: #343a40;
    color: white;
    padding: 30px;
}

.sidebar nav ul {
    list-style: none;
    padding: 0;
}

.sidebar nav ul li {
    margin: 30px 0;
}

.sidebar nav ul li a {
    color: white;
    text-decoration: none;
}

.sidebar nav ul li a:hover {
    text-decoration: underline;
}

.main-content {
    flex: 1;
    padding: 20px;
    overflow-y: auto; 
}


    </style>
</head>
<body>

<div class="dashboard">
        <header class="header">
            <h1>Hotel Admin Dashboard</h1>
        </header>


  <div class="sidebar-container">
            <aside class="sidebar">
                <nav>
                    <ul>
                        <li><a href="admin_dashboard.php">Home</a></li>
                        <li><a href="addRoom.php">Rooms</a></li>
                        <li><a href="index.php">Quit</a></li>
                    </ul>
                </nav>
            </aside>

    <div class="container">
        <h1>Hotel Management System</h1>

        <?php if (!empty($message)): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <h2>Add New Room</h2>
<form id="room-form" method="POST" enctype="multipart/form-data">
    <label for="price">Price (per night):</label>
    <input type="number" id="price" name="price" placeholder="Enter price" required>

    <label for="title">Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter title" required>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" placeholder="Enter description" required>

    <label for="capacity">Capacity:</label>
    <input type="number" id="capacity" name="capacity" placeholder="Enter room capacity" min="1" required>

    <label for="roomType">Amount Available:</label>
<input type="number" id="amount" name="amount" placeholder="Enter Amount of rooms" min="1" required>
</select>
    

<label for="image">Room Image:</label>
<div id="image-preview" style="width: 150px; height: 150px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
    <span style="color: #999;">Preview</span>
</div>
<input type="file" id="image" name="image" accept="image/*" required>

<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Get the first file selected
        const preview = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" style="width: 100%; height: 100%; object-fit: cover;">`;
            };

            reader.readAsDataURL(file); // Read the image as a data URL to display
        } else {
            preview.innerHTML = '<span style="color: #999;">Preview</span>'; // Reset if no file is selected
        }
    });
</script>

    <button type="submit" id="add-room-btn">Add Room</button>
</form>

<?php
// Fetch rooms from the database
$sql = "SELECT * FROM rooms";
$stmt = $pdo->query($sql);
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Room Details</h2>
<table>
    <thead>
        <tr>
            <th>Room ID</th>
            <th>Price</th>
            <th>Title</th>
            <th>Description</th>
            <th>Capacity</th>
            <th>Amount Available</th>
            <th>Image</th>
            <th>Edit</th> <!-- Added Edit column -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?= htmlspecialchars($room['id']) ?></td>
                <td><?= htmlspecialchars($room['price']) ?></td>
                <td><?= htmlspecialchars($room['title']) ?></td>
                <td><?= htmlspecialchars($room['description']) ?></td>
                <td><?= htmlspecialchars($room['capacity']) ?></td>
                <td><?= htmlspecialchars($room['amount']) ?></td>
                <td>
                    <img src="<?= htmlspecialchars($room['image_path']) ?>" alt="Room Image" style="width: 100px; height: auto;">
                </td>
                <td>
                    <a href="editRoom.php?id=<?= $room['id'] ?>" class="edit-btn">Edit</a> <!-- Edit Button -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>






<script>

    function updateRoomCapacity(roomId, newCapacity) {
      // Update the capacity of the room on the page
      const roomElement = document.querySelector(`#room-${roomId} .capacity`);
      if (roomElement) {
        roomElement.textContent = `Capacity: ${newCapacity}`;
      }
    }

    function updateRoomCapacityInDatabase(roomId) {
      // Send a POST request to update the capacity in the database
      const formData = new FormData();
      formData.append('room_id', roomId);

      fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
        method: 'POST',
        body: formData,
      })
      .then(response => response.json()) // Expecting JSON response with updated capacity
      .then(data => {
        if (data.capacity >= 0) {
          // Update the UI with the new capacity from the server
          updateRoomCapacity(roomId, data.capacity);
        }
      })
      .catch(error => {
        console.error('Error updating room capacity:', error);
      });
    }
</script>
</body>
</html>