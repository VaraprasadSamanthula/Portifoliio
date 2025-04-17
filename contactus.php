<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to clean inputs
    function sanitize($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Initialize variables
    $errors = [];

    // Validate Name
    $uname = sanitize($_POST["uname"]);
    if (empty($uname) || strlen($uname) < 3) {
        $errors[] = "Name must be at least 3 characters long.";
    }

    // Validate Mobile Number
    $mnum = sanitize($_POST["mnum"]);
    if (!preg_match("/^[6-9][0-9]{9}$/", $mnum)) {
        $errors[] = "Mobile number must be exactly 10 digits and start with 6, 7, 8, or 9.";
    }

    // Validate Email
    $mail = sanitize($_POST["mail"]);
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validate Preferred Date
    $prefdate = $_POST["prefdate"];
    $today = date("Y-m-d");
    if ($prefdate < $today) {
        $errors[] = "Preferred date cannot be in the past.";
    }

    // Validate Hobbies
    if (!isset($_POST["hobbies"]) || count($_POST["hobbies"]) == 0) {
        $errors[] = "Please select at least one hobby.";
    } else {
        $hobbies = $_POST["hobbies"];
    }

    // If no errors, process the form
    if (empty($errors)) {
        echo "<h2>Form Submitted Successfully!</h2>";
        echo "<p><strong>Name:</strong> $uname</p>";
        echo "<p><strong>Mobile Number:</strong> $mnum</p>";
        echo "<p><strong>Email:</strong> $mail</p>";
        echo "<p><strong>Preferred Date:</strong> $prefdate</p>";
        echo "<p><strong>Hobbies:</strong> " . implode(", ", $hobbies) . "</p>";
    } else {
        echo "<h2>Errors Found:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul><a href='contactus.html'>Go Back</a>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varaprasad - Contact</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Style.css?v=1.1">
</head>
<body>
    <!-- Header Section -->
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container text-center">
            <h2 class="display-5 fw-bold">Welcome to My Portfolio</h2>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link  active" href="home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.html">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-4">
        <!-- Contact Information -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title border-bottom pb-2">Contact Information</h2>
                <div class="mt-3">
                    <p class="mb-2"><i class="fas fa-phone me-2"></i> Contact Number: 9392858274</p>
                    <p class="mb-2"><i class="fas fa-envelope me-2"></i> Email: varaprasadsamanthula8334@gmail.com</p>
                    <p class="mb-2"><i class="fas fa-home me-2"></i> Address: Gorle street, Salur, Parvathipuram, Andhra Pradesh.</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="card shadow-sm">
    <div class="card-body">
        <h2 class="card-title border-bottom pb-2">Contact Form</h2>
        <form class="mt-4" action="process_contact.php" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="uname" class="form-label">Name</label>
                    <input type="text" class="form-control" name="uname" placeholder="Enter your Name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mnum" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" name="mnum" placeholder="Enter Your mobile number" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="mail" class="form-label">E-Mail ID</label>
                <input type="email" class="form-control" name="mail" placeholder="Enter Your E-Mail ID" required>
            </div>

            <div class="mb-3">
                <label for="prefdate" class="form-label">Preferred Date</label>
                <input type="date" class="form-control" name="prefdate" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Hobbies</label>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Cricket">
                            <label class="form-check-label">Cricket</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="VolleyBall">
                            <label class="form-check-label">VolleyBall</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Badminton">
                            <label class="form-check-label">Badminton</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Football">
                            <label class="form-check-label">Football</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
        </form>
    </div>
</div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">© 2025 Varaprasad. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <div class="text-center text-md-end">
                        <a href="https://www.linkedin.com/in/your-profile" class="text-white me-3">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="https://www.facebook.com/your-profile" class="text-white me-3">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/your-profile" class="text-white me-3">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.twitter.com/your-profile" class="text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Form Validation Script -->
    <!-- JavaScript Validation -->
    <script>
        function validateForm() {
            var name = document.getElementById("uname").value.trim();
            var mobile = document.getElementById("mnum").value.trim();
            var email = document.getElementById("mail").value.trim();
            var prefDate = document.getElementById("prefdate").value;
            var hobbies = document.querySelectorAll('input[name="hobbies"]:checked');

            // Validate Name (At least 3 characters)
            if (name.length < 3) {
                alert("Name must be at least 3 characters long!");
                return false;
            }

            // Validate Mobile Number (Starts with 6-9 and is 10 digits long)
            var mobilePattern = /^[6-9][0-9]{9}$/;
            if (!mobilePattern.test(mobile)) {
                alert("Mobile number must be exactly 10 digits and start with 6, 7, 8, or 9!");
                return false;
            }

            // Validate Email Format
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address!");
                return false;
            }

            // Validate Preferred Date (Cannot be in the past)
            var today = new Date().toISOString().split("T")[0];
            if (prefDate < today) {
                alert("Preferred date cannot be in the past!");
                return false;
            }

            // Validate Hobbies (At least one must be selected)
            if (hobbies.length === 0) {
                alert("Please select at least one hobby!");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
