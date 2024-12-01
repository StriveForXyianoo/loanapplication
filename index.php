<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BGEMPC Multi-Coop Loan System</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>


    <!-- Sticky Navbar with Professional Design -->
    <header>
    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <div class="logo">
            <a href="index.php">
                <div class="logo-container" style="display: flex; align-items: center;">
                    <img src="1BGC.jpg" alt="BCGEMPC Logo" style="height: 50px;">
                    <span style="margin-left: 10px;">BGEMPC</span>
                </div>
            </a>
        </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="javascript:void(0)" class="btn-nav" onclick="redirectToLogin()">Get Started</a></li>
            </ul>
            <div class="nav-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>


    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Welcome to BGEMPC Coop Loan Management</h1>
            <hr>
            <p>Empowering your financial growth with easy loan management and personalized solutions.</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-us">
        <h2>About Us</h2>
        <p>We are a member-driven cooperative offering secure and accessible loans for both personal and business purposes.</p>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <h2>Our Services</h2>
        <div class="service-cards">
            <div class="card">
                <h3>Personal Loans</h3>
                <p>Flexible and quick loans for individual needs.</p>
            </div>
            <div class="card">
                <h3>Business Loans</h3>
                <p>Supporting your business with competitive rates and easy repayment plans.</p>
            </div>
            <div class="card">
                <h3>Loan Management</h3>
                <p>Track and manage your loans effortlessly through our platform.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <h2>What Our Members Say</h2>
        <div class="testimonial-cards">
            <?php 
                // Dynamically load testimonials from database (replace with DB logic)
                $testimonials = [
                    ["quote" => "CoopLoans has been a game-changer for my business.", "name" => "John Doe"],
                    ["quote" => "The personalized service made managing my loans easier.", "name" => "Jane Smith"]
                ];
                foreach ($testimonials as $testimonial) {
                    echo "<div class='testimonial'>
                            <p>\"{$testimonial['quote']}\"</p>
                            <h4>- {$testimonial['name']}</h4>
                        </div>";
                }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coop Loan Management. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
    <script>
// Listen for keydown event
document.addEventListener('keydown', function(event) {
    // Check if 'Ctrl' and 'Alt' are pressed, along with the 'B' key
    if (event.ctrlKey && event.altKey && event.key === 'b') {
        // Redirect to adminlogin.php
        window.location.href = 'adminlogin.php';
    }
});
</script>

</body>
</html>
