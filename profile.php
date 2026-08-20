<?php
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard</title>
    

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
}

header {
    margin-bottom: 30px;
}

header h1 {
    font-size: 30px;
    color: #333;
}

.profile-details,
.settings {
    background-color: #fafafa;
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 8px;
}

.profile-details h2,
.settings h2 {
    margin-top: 0;
}

button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
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
            <h1>Welcome <?php echo $username; ?>!</h1>
        </header>
        <div class="profile-section">
            <!-- Profile Details -->
            <div id="profile-view">
                <h2><?php echo $firstName . " " . $lastName; ?></h2>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $mobile_number; ?></p>
                <p><strong>Address:</strong> <?php echo $address; ?></p>
                <button onclick="toggleEdit()">Edit Profile</button>
            </div>

            <!-- Edit Profile Form -->
            <div id="profile-edit" style="display: none;">
                <form action="update_profile.php" method="POST">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
                    
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                    
                    <label for="mobile_number">Phone:</label>
                    <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $mobile_number; ?>" required>
                    
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>
                    
                    <button type="submit">Save Changes</button>
                    <button type="button" onclick="toggleEdit()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEdit() {
    const profileView = document.getElementById('profile-view');
    const profileEdit = document.getElementById('profile-edit');
    profileView.style.display = profileView.style.display === 'none' ? 'block' : 'none';
    profileEdit.style.display = profileEdit.style.display === 'none' ? 'block' : 'none';
}
</script>
</body>
</html>