<?php
include 'db_connect.php';

$result = $conn->query("SELECT * FROM footer LIMIT 1");
$footer = $result->fetch_assoc();
?>

<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <h2>About Us</h2>
            <p><?php echo $footer['about_us']; ?></p>
        </div>

        <div class="footer-section contact">
            <h2>Contact Us</h2>
            <p><i class="fas fa-phone"></i> <?php echo $footer['phone1']; ?></p>
            <p><i class="fas fa-phone"></i> <?php echo $footer['phone2']; ?></p>
            <p><i class="fas fa-phone"></i> <?php echo $footer['phone3']; ?></p>
        </div>

        <div class="footer-section social">
            <h2>Follow Us</h2>
            <a href="<?php echo $footer['facebook_link']; ?>"><i class="fab fa-facebook"></i></a>
            <a href="<?php echo $footer['instagram_link']; ?>"><i class="fab fa-instagram"></i></a>
            <a href="<?php echo $footer['twitter_link']; ?>"><i class="fab fa-twitter"></i></a>
            <a href="<?php echo $footer['youtube_link']; ?>"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</footer>

<?php $conn->close(); ?>