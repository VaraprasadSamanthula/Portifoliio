<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values and sanitize input
    $name = htmlspecialchars($_POST["uname"]);
    $mobile = htmlspecialchars($_POST["mnum"]);
    $email = htmlspecialchars($_POST["mail"]);
    $preferred_date = htmlspecialchars($_POST["prefdate"]);
    $hobbies = isset($_POST["hobbies"]) ? implode(", ", $_POST["hobbies"]) : "None";

    // Email details
    $to = "your-email@example.com"; // Change this to your actual email
    $subject = "New Contact Form Submission from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $body = "Name: $name\nMobile: $mobile\nEmail: $email\nPreferred Date: $preferred_date\nHobbies: $hobbies";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Form submitted successfully!'); window.location.href='contact_form.php';</script>";
    } else {
        echo "<script>alert('Error sending form. Please try again later.'); window.location.href='contact_form.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='contact_form.php';</script>";
}
?>
