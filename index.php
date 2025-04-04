<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Beauty Station</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">Beauty<br>Station</div>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
            </ul>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="btn profile-btn"><i class="fas fa-user"></i> Profile</a>
                    <a href="logout.php" class="btn logout-btn">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn login-btn">Login</a>
                    <a href="signup.php" class="btn signup-btn">Signup</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero" id="home">
            <h1>Welcome to our beauty parlour services</h1>
            <p>IT'S NICE TO SEE YOU</p>
        </section>

        <!-- Gallery Section -->
        <section class="gallery" id="gallery">
            <h2>Gallery</h2>
            <p>Collect your movements</p>
            <div class="gallery-items">
                <?php
                $gallery = [
                    ["image12.jpeg", "After Haircut"],
                    ["image13.jpeg", "Bridal Look"],
                    ["image14.jpeg", "Skin After Treatment"],
                    ["image15.jpeg", "Mehandi"]
                ];
                foreach ($gallery as $item) {
                    echo "<div class='gallery-item'>
                            <img src='images/$item[0]' alt='$item[1]'>
                            <p>$item[1]</p>
                          </div>";
                }
                ?>
            </div>
        </section>



        <!-- Services Section -->
        <section class="services-page" id="services">
            <h2>Services</h2>
            <p>Celebrate beautiful moments</p>
            <div class="service-categories">
                <?php
                // Fetch and display services from the database
                $result = $conn->query("SELECT * FROM services");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='service-category'>
                            <img src='images/{$row['image']}' alt='{$row['name']}'>
                            <h3>{$row['name']}</h3>
                            <p>{$row['description']}</p>
                            <p>Price: ₹ {$row['price']}</p>
                          </div>";
                }
                ?>
            </div>

            <!-- Appointment Booking Form -->
            <?php if (isset($_SESSION['user_id'])): ?>
            <h3>Book Your Appointment</h3>
            <form action="book_appointment.php" method="post">
                <label for="service">Choose Service:</label>
                <select id="service" name="service" required>
                    <option value="">-- Select Service --</option>
                    <?php
                    // Fetch services for the dropdown
                    $result = $conn->query("SELECT * FROM services");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>
                                {$row['name']} - ₹ {$row['price']}
                              </option>";
                    }
                    ?>
                </select>

                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required />

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required />

                <label for="date">Appointment Date:</label>
                <input type="date" id="date" name="date" required />

                <label for="time">Appointment Time:</label>
                <input type="time" id="time" name="time" required />

                <button type="submit" class="btn book-btn">Book Appointment</button>
            </form>
            <?php else: ?>
                <p>Please <a href="login.php">login</a> to book an appointment.</p>
            <?php endif; ?>
        </section>

        <!-- About Section -->
        <section class="About" id="about">
            <div class="team-section">
                <h2>About</h2>
                <h1>Our Amazing Team</h1>
                <div class="team-members">
                    <?php
                    $team = [
                        ["profile.jpeg", "Prerna Shahare"],
                        ["profile.jpeg", "Shweta Tondare"],
                        ["profile.jpeg", "Gayatri Waghaye"]
                    ];
                    foreach ($team as $member) {
                        echo "<div class='team-member'>
                                <img src='images/$member[0]' alt='$member[1]'>
                                <p>$member[1]</p>
                              </div>";
                    }
                    ?>
                </div>
            </div>
        </section>

    </main>
    <?php include 'footer.php'; ?>


</body>
</html>

<?php
$conn->close();
?>