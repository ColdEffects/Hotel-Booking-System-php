<?php
require_once './db_connect.php';


session_start();

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cartCount = count($cartItems); // Number of bookings

// Fetch room titles from the database based on room IDs in the cart
$roomTitles = [];
if (!empty($cartItems)) {
    $roomIds = implode(',', array_map('intval', $cartItems)); // Convert IDs to integers and prepare for SQL
    $query = "SELECT title FROM rooms WHERE id IN ($roomIds)";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $roomTitles[] = $row['title'];
        }
    }
}

// Format the room titles as a comma-separated string for display
$roomTitlesDisplay = !empty($roomTitles) ? implode(', ', $roomTitles) : 'Please select a room.';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the `admins` table
    $admin_query = "SELECT * FROM admins WHERE username = ?";
    $stmt = $pdo->prepare($admin_query);
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && $password === $admin['password']) {
        $_SESSION['is_admin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['mobile_number'] = $admin['mobile_number'];
        $_SESSION['address'] = $admin['address'];
        $_SESSION['firstName'] = $admin['firstName'];
        $_SESSION['lastName'] = $admin['lastName'];

        echo json_encode([
            'status' => 'success',
            'username' => $admin['username'],
            'mobile_number' => $admin['mobile_number'],
            'address' => $admin['address']
        ]);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the data from the POST request
        $roomId = $_POST['roomId'] ?? null;
        $title = $_POST['title'] ?? null;
        $image = $_POST['image'] ?? null;
        $price = $_POST['price'] ?? null;
      
        if ($roomId && $title && $image && $price) {
            // Insert data into the `cart` table
            $stmt = $pdo->prepare("INSERT INTO cart (room_id, title, image_path, price) VALUES (:roomId, :title, :image, :price)");
            $stmt->execute([
                ':roomId' => $roomId,
                ':title' => $title,
                ':image' => $image,
                ':price' => $price,
            ]);
      
            echo "Item added to cart successfully!";
        } else {
            echo "Invalid data provided!";
        }
      } else {
        echo "Invalid request method!";
      }

    // Check if the user exists in the `users` table
    $user_query = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($user_query);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['mobile_number'] = $user['mobile_number'];
        $_SESSION['address'] = $user['address'];

        exit();
    }

    // If login fails
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid username or password.'
    ]);
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['room_id'])) {
        $roomId = $_POST['room_id'];

        $sql = "UPDATE rooms SET capacity = capacity - 1 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $roomId);
        $stmt->execute();

        $stmt = $pdo->prepare("SELECT capacity FROM rooms WHERE id = :id");
        $stmt->bindParam(':id', $roomId);
        $stmt->execute();
        $updatedRoom = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['status' => 'success', 'capacity' => $updatedRoom['capacity']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Room ID not provided']);
    }
}
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $admin_query = "SELECT * FROM admins WHERE username = '$username'";
    $admin_result = $conn->query($admin_query);

    if ($admin_result->num_rows > 0) {
        $admin = $admin_result->fetch_assoc();

        if ($password === $admin['password']) {
            session_start();
            $_SESSION['is_admin'] = true;
            $_SESSION['username'] = $username;

            $_SESSION['mobile_number'] = $admin['mobile_number'];
            $_SESSION['address'] = $admin['address'];

            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<p>Invalid admin password. Please try again.</p>";
        }
    }

    $user_query = "SELECT * FROM users WHERE username = '$username'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['firstName'] = $user['firstName'];
            $_SESSION['lastName'] = $user['lastName'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['mobile_number'] = $user['mobile_number'];
            $_SESSION['address'] = $user['address'];

          
            header("Location: profile.php");
            exit();
        } else {
            echo "<p>Invalid user password. Please try again.</p>";
        }
    } else {
        echo "<p>No user found with the provided username. Please sign up first.</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    background: url('hotel.jpg') no-repeat center center fixed;
    background-size: cover;
    padding: 20px;
    display: flex;
    justify-content: center; /* Horizontally center */
    align-items: center; /* Vertically center */
    min-height: 100vh; /* Full viewport height */
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.6); /* Soft white overlay for contrast */
    z-index: -1; /* Ensure it's behind content */
}

/* Container to hold both sections */
.container {
    display: flex;
    justify-content: space-between;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    max-width: 1200px; /* You can set a max-width to prevent it from stretching too wide */
    margin: 0 15px; /* Optional, margin for small screen padding */
    gap: 30px; /* Add space between the two sections */
    flex-wrap: wrap; /* Make it responsive for small screens */
}

/* Login Section */
.login-section {
    width: 48%; /* Adjust width for smaller screens */
    height: 100%; /* Make sure it takes the full height of the container */
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Stretch the content to fill the available space */
}

.login-section h2 {
    text-align: center;
    margin-bottom: 20px;
}

.login-section form {
    display: flex;
    flex-direction: column;
}

.login-section label {
    margin-bottom: 10px;
    font-weight: bold;
}

.login-section input {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.login-section button {
    padding: 10px 20px;
    background: rgb(167, 152, 77);
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.login-section button:hover {
    background-color: rgb(185, 168, 79);
}

.login-section a {
    color: rgb(167, 152, 77);
    text-decoration: none;
}

/* Confirmation Section */
.confirmation-section {
    width: 48%; /* Adjust width for smaller screens */
    height: 100%; /* Make sure it takes the full height of the container */
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Stretch the content to fill the available space */
}

.confirmation-section h2 {
    text-align: center;
    margin-bottom: 20px;
}

.confirmation-section p {
    margin-bottom: 15px;
    line-height: 1.6;
}

.confirmation-section .details p {
    margin-bottom: 10px;
}

.confirmation-section .terms {
    margin-top: 30px;
}

.terms label {
    font-size: 16px;
}

.terms a {
    color: #007bff;
    text-decoration: none;
}

</style>
</head>
<body>
    <div class="container">
        <!-- Left Section: Login Form -->
        <div class="login-section">
            <h2>LOGIN</h2>
            <form id="loginForm" action="#" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <div class="button-container">
        <button type="submit" onclick="window.location.reload();">Login</button>
    </div>
</form>
        </div>
        <script>
    // Handle login via AJAX
    document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    console.log('Login form submitted. Username:', username, 'Password:', password);

    // Send the login data via AJAX
    fetch('booking.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(response => {
        console.log('Response received:', response);
        return response.json();
    })
    .then(data => {
        console.log('Data received from server:', data);
        if (data.status === 'success') {
            // Update the confirmation section with user details
            document.querySelector('.confirmation-section .details').innerHTML = `
                <p><strong>Guest Name:</strong> ${data.username}</p>
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Phone:</strong> ${data.mobile_number}</p>
                <p><strong>Address:</strong> ${data.address}</p>
            `;

            // Optionally show a success message
            alert('Login successful!');
        } else {
            alert(data.message); // Show error message if any
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>

        
        <!-- Right Section: Booking Confirmation -->
        <div class="confirmation-section">
        <h2>BOOKING CONFIRMATION</h2>
        <p>Your booking is still awaiting confirmation.</p>
        <div class="details">
            <!-- Number of Bookings -->
            <p><strong>Number of Bookings:</strong> 3 </p>

            <!-- Guest Name -->
            <p><strong>Guest Name:</strong> <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Please log in to view details.'; ?></p>

            <p><strong>Guest Name:</strong> <?= isset($_SESSION['firstName']) && isset($_SESSION['lastName']) ? htmlspecialchars($_SESSION['firstName']) . ' ' . htmlspecialchars($_SESSION['lastName']) : 'Please log in to view details.'; ?></p>

            <!-- Room Type -->
            <p><strong>Room Type:</strong> SeaSide Room, Skyline Suite, Woodland Cabin </p>

            <!-- Phone -->
            <p><strong>Phone:</strong> <?= isset($_SESSION['mobile_number']) ? htmlspecialchars($_SESSION['mobile_number']) : 'Please log in to view details.'; ?></p>

            <!-- Email -->
            <p><strong>Email:</strong> <?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Please log in to view details.'; ?></p>

            <!-- Address -->
            <p><strong>Address:</strong> <?= isset($_SESSION['address']) ? htmlspecialchars($_SESSION['address']) : 'Please log in to view details.'; ?></p>
        </div>

        <!-- Terms and Conditions -->
        <div class="terms">
            <input type="checkbox" id="terms" name="terms">
            <label for="terms">I agree to the <a href="#">Terms and Conditions</a></label>
        </div>

        <!-- Confirm Booking Button -->
        <button 
            id="confirmBooking" 
            disabled
            style="margin-top: 20px; padding: 10px 20px; background-color: rgb(167, 152, 77); color: #fff; border: none; border-radius: 4px; cursor: not-allowed;"
        >
            Confirm Booking
        </button>
        <p id="loginWarning" style="color: red; margin-top: 10px; <?= isset($_SESSION['username']) ? 'display: none;' : ''; ?>">
            Please log in to confirm your booking.
        </p>
        <p id="termsWarning" style="color: red; margin-top: 10px; display: none;">
            You must accept the Terms and Conditions to proceed.
        </p>
    </div>
</div>

<script>
    const termsCheckbox = document.getElementById('terms');
    const confirmButton = document.getElementById('confirmBooking');
    const termsWarning = document.getElementById('termsWarning');

    // Enable or disable the Confirm Booking button based on the checkbox
    termsCheckbox.addEventListener('change', function () {
        if (termsCheckbox.checked) {
            confirmButton.disabled = false;
            confirmButton.style.cursor = 'pointer';
            termsWarning.style.display = 'none';
        } else {
            confirmButton.disabled = true;
            confirmButton.style.cursor = 'not-allowed';
        }
    });

    // Handle the Confirm Booking button click
    confirmButton.addEventListener('click', function () {
        // Ensure the terms checkbox is checked
        if (!termsCheckbox.checked) {
            termsWarning.style.display = 'block';
            alert('You must accept the Terms and Conditions to proceed.');
            return;
        }


        window.location.href = 'profile.php';
    });
</script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Send the login data via AJAX
        fetch('booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update the confirmation section with user details
                document.querySelector('.confirmation-section .details').innerHTML = `
                    <p><strong>Guest Name:</strong> ${data.username}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                    <p><strong>Phone:</strong> ${data.mobile_number}</p>
                    <p><strong>Address:</strong> ${data.address}</p>
                `;

                // Hide the login warning
                document.getElementById('loginWarning').style.display = 'none';

                // Optionally show a success message
                alert('Login successful!');
            } else {
                // Display an error message if login fails
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
</body>
</html>
