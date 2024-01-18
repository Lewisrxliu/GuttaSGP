<?php
include 'main.php';
// Ensure post variable exists
if (isset($_GET['email'], $_GET['code'])) {
    // Validate email address
    if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        exit('Please provide a valid email address!');
    }
    // Check if email exists in database
    $stmt = $pdo->prepare('SELECT * FROM subscribers WHERE email = ?');
    $stmt->execute([ $_GET['email'] ]);
    $subscriber = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($subscriber) {
        // Verify code
        if (sha1($subscriber['id'] . $subscriber['email']) == $_GET['code']) {
            // Delete the email from the subscribers list
            $stmt = $pdo->prepare('DELETE FROM subscribers WHERE email = ?');
            $stmt->execute([ $_GET['email'] ]);
            // Output success response
            exit('You\'ve successfully unsubscribed!');
        } else {
            exit('Incorrect code provided!');
        }
    } else {
        exit('You\'re not a subscriber or you\'ve already unsubscribed!');
    }
} else {
    exit('No email address and/or code specified!');
}
?>