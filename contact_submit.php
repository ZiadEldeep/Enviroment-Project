<?php 
include 'config.php';


    // Escape special characters to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Print all submitted values for debugging (optional)
    // echo "Name: " . $name . "<br>";
    // echo "Email: " . $email . "<br>";
    // echo "Phone: " . $phone . "<br>";
    // echo "Subject: " . $subject . "<br>";
    // echo "Message: " . $message . "<br>";

    // Check if required fields are provided
    if ($name && $email && $message) {
        // Insert the sanitized values into the database
        $sql = "INSERT INTO `contacts` (name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
        
        if (mysqli_query($conn, $sql)) {
            echo 'your message sent!';
        } else {
            echo 'Query failed: ' . mysqli_error($conn); // Display error if the query fails
        }
    } else {
        echo 'Please fill out all required fields.';
    }

// Close the database connection
mysqli_close($conn);
?>
