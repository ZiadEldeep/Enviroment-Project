<?php 
include 'config.php';



   // Escape special characters to prevent SQL injection
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $message = mysqli_real_escape_string($conn, $_POST['message']);

   // Print all submitted values
   echo "Name: " . $_POST['name'] . "<br>";
   echo "Email: " . $_POST['email'] . "<br>";
   echo "Message: " . $_POST['message'] . "<br>";

   // Check if required fields are provided
   if($name && $email && $message){
      // Insert the sanitized values into the database
      $sql = "INSERT INTO `consultations`(name, email, message) VALUES('$name', '$email', '$message')";
      mysqli_query($conn, $sql) or die('Query failed: '.mysqli_error($conn)); // Display error if the query fails
      echo 'your request sent!';
   } else {
      echo 'Please fill out all fields.';
   }

?>
