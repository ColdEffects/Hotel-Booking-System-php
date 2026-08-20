<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Admin Dashboard</title>
    <link rel="stylesheet" href="styles_two.css">


    <style>
body {
    font-family: Arial, sans-serif;a
    margin: 0;
    padding: 0;
    background-color:rgb(244, 244, 244);
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

.overview {
    margin-bottom: 40px;
}

.cards {
    display: flex;
    justify-content: space-between;
}

.icon {
    width: 50px; 
    height: 50px;
    margin-bottom: 10px; 
}
.card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(146, 139, 61, 0.1);
    flex: 1;
    margin: 0 10px;
    text-align: center;
}

.card h3 {
    margin: 0 0 10px;
}

.quick-links {
    margin-top: 20px;
}

.quick-links ul {
    list-style: none;
    padding: 0;
}

.quick-links ul li {
    margin: 10px 0;
}

.quick-links ul li a {
    color: #007bff;
    text-decoration: none;
}

.quick-links ul li a:hover {
    text-decoration: underline;
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

            <main class="main-content">
                <section class="overview">
                    <h2>Overview</h2>
                    <div class="cards">
                    <div class="card">
                        <img src="booking.png" alt="Bookings Icon" class="icon">
                        <h3>Total Bookings</h3>
                        <p>150</p>
                        </div>
                    <div class="card">
                        <img src="bed.png" alt="Rooms Icon" class="icon">
                        <h3>Available Rooms</h3>
                        <p>30</p>
                        </div>
                    <div class="card">
                        <img src="revenue.png" alt="Revenue Icon" class="icon">
                        <h3>Revenue</h3>
                        <p>$25,000</p>
                        </div>
                    <div class="card">
                        <img src="customer.png" alt="Customer Icon" class="icon">
                        <h3>Customers</h3>
                        <p>120</p>
                        </div>
                    </div>
                </section>

                <section class="quick-links">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href="#addBooking">Add New Booking</a></li>
                        <li><a href="#manageRooms">Manage Rooms</a></li>
                        <li><a href="#viewReports">View Reports</a></li>
                        <li><a href="#customerFeedback">Customer Feedback</a></li>
                    </ul>
                </section>
            </main>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>