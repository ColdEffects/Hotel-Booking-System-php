<?php
// editRoom.php

// Include the database connection
include('db_connect.php');

if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Fetch the room details from the database
    $sql = "SELECT * FROM rooms WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $room_id);
    $stmt->execute();
    $room = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the room doesn't exist, redirect to the admin dashboard
    if (!$room) {
        header("Location: addRoom.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form fields are set for update
    if (isset($_POST['price'], $_POST['title'], $_POST['description'], $_POST['capacity'], $_POST['amount'], $_FILES['image'])) {
        $price = $_POST['price'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $capacity = $_POST['capacity'];
        $amount = $_POST['amount'];

        // Handle image upload (if a new image is selected)
        if ($_FILES['image']['name']) {
            $image = $_FILES['image']['name'];
            $target = "uploads/" . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                // If new image uploaded, update image path
                $image_path = $target;
            } else {
                $image_path = $room['image_path']; // Keep the old image if upload fails
            }
        } else {
            $image_path = $room['image_path']; // Keep the old image if no new image is uploaded
        }

        // Update room details in the database
        $sql = "UPDATE rooms SET 
                    price = :price, 
                    title = :title, 
                    description = :description, 
                    capacity = :capacity, 
                    amount = :amount, 
                    image_path = :image_path 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->bindParam(':id', $room_id);

        if ($stmt->execute()) {
            header("Location: addRoom.php"); // Redirect after successful update
            exit;
        } else {
            $message = "Error updating room.";
        }
    } else {
        $message = "All fields are required.";
    }
}

// Handle delete room request
if (isset($_POST['delete_room'])) {
    // Delete the room image if it exists
    if (file_exists($room['image_path'])) {
        unlink($room['image_path']);
    }

    // Delete the room from the database
    $sql = "DELETE FROM rooms WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $room_id);
    
    if ($stmt->execute()) {
        header("Location: addRoom.php"); // Redirect after successful deletion
        exit;
    } else {
        $message = "Error deleting room.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;   
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 30px;
            width: 100%;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .form-container {
            display: flex;
            gap: 20px;
        }

        .form-container .form-fields {
            flex: 1;
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }

        input[type="text"], 
        input[type="number"], 
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="file"] {
            background-color: #f9f9f9;
        }

        button {
            display: inline-block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        button.delete {
            background-color: #dc3545;
        }

        button.delete:hover {
            background-color: #c82333;
        }

        button.cancel {
            background-color: #6c757d;
        }

        button.cancel:hover {
            background-color: #5a6268;
        }

        .message {
            background-color: #ffdddd;
            padding: 10px;
            border-left: 5px solid #f44336;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Room</h1>
        <?php if (!empty($message)): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="form-container">
            <!-- Form Fields -->
            <div class="form-fields">
                <form method="POST" enctype="multipart/form-data">
                <label for="price">Price (per night):</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($room['price']) ?>" min = "1" required>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($room['title']) ?>" required>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?= htmlspecialchars($room['description']) ?>" required>

            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" value="<?= htmlspecialchars($room['capacity']) ?>" min = "1" required>

            <label for="amount">Amount Available:</label>
            <input type="number" id="amount" name="amount" value="<?= htmlspecialchars($room['amount']) ?>" min = "1" required>

            <label for="image">Room Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <div>
                <h4>Current Image:</h4>
                <img src="<?= htmlspecialchars($room['image_path']) ?>" alt="Room Image" style="width: 100px; height: auto;">
            </div>

            <div>
            <h4>New Image:</h4>
    <img id="new-image-preview" src="" alt="New Room Image Preview" style="width: 100px; height: auto; display: none;">
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('new-image-preview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>

            <button type="submit">Update Room</button>
                </form>

                <!-- Delete Button -->
                <form method="POST">
                    <button type="submit" class="delete" name="delete_room" onclick="return confirm('Are you sure you want to delete this room?')">Delete Room</button>
                </form>

                <!-- Cancel Button -->
                <form method="GET" action="addRoom.php">
                    <button type="submit" class="cancel">Cancel</button>
                </form>
            </div>

        
        </div>
    </div>
</body>
</html>
