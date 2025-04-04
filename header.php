<header>
    <nav>
        <div class="logo">Beauty<br>Station</div>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#packages">Packages</a></li>
            <li><a href="#about">About</a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="auth/profile.php">Profile</a></li>
                <li><a href="auth/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="auth/login.php">Login</a></li>
                <li><a href="auth/signup.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>