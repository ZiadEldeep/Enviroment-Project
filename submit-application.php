<?php
// Database connection
$servername = "localhost"; // Your database host
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "enviroSolutions"; // Your database name

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $coverLetter = $_POST['coverLetter'];

    // Handle file upload
    $resume = $_FILES['resume'];
    $resumePath = 'uploads/' . basename($resume['name']);
    
    // Ensure uploads directory exists
    if (!file_exists('uploads')) {
        mkdir('uploads', 0755, true); // Create uploads directory if it doesn't exist
    }
    
    // Move uploaded file to the desired directory
    if (move_uploaded_file($resume['tmp_name'], $resumePath)) {
        // Prepare SQL statement
        $sql = "INSERT INTO applications (name, email, phone, resume, cover_letter) VALUES (:name, :email, :phone, :resume, :cover_letter)";
        
        // Prepare the statement
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':resume', $resumePath);
        $stmt->bindParam(':cover_letter', $coverLetter);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Application submitted successfully.";
        } else {
            echo "Error submitting application.";
        }
    } else {
        echo "Error uploading resume.";
    }
}
?>
