<?php
include 'main.php';
// Ensure post variable exists
if (isset($_POST['email'])) {
    // Validate email address
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('Please provide a valid email address!');
    }
    // Check if email exists in the database
    $stmt = $pdo->prepare('SELECT * FROM subscribers WHERE email = ?');
    $stmt->execute([ $_POST['email'] ]);
    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        exit('You\'re already a subscriber!');
    }
    // Insert email address into the database
    $stmt = $pdo->prepare('INSERT INTO subscribers (email,date_subbed) VALUES (?,?)');
    $stmt->execute([ $_POST['email'], date('Y-m-d\TH:i:s') ]);
    // Output success response
    exit('Thank you for subscribing!');
} else {
    // No post data specified
    exit('Please provide a valid email address!');
}
?>