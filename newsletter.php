<?php
include 'main.php';
// NOTICE: THE FOLLOWING PAGE IS UNRESTRICTED AND THEREFORE WE SUGGEST YOU IMPLEMENT RESTRICTIONS BEFORE GOING PRODUCTION
// Get all subscribers from the database
$stmt = $pdo->prepare('SELECT * FROM subscribers');
$stmt->execute();
$subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Send Newsletter</title>
        <link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
		<style> 
        html {
            background-color: #F8F9F9;
            background: linear-gradient(0deg, #f9f8f8 0%, #f9f8f8 80%, #cb5f51 80%, #cb5f51 100%);
            padding: 30px;
            height: 100%;
        }
        </style>
	</head>
	<body>

		<form class="send-newsletter-form" method="post" action="">

			<h1><i class="fa-regular fa-envelope"></i>Send Newsletter</h1>

			<div class="fields">

                <label for="recipients">Recipients</label>
                <div class="multi-select-list">
                    <?php foreach ($subscribers as $subscriber): ?>
                    <label>
                        <input type="checkbox" class="recipient" name="recipients[]" value="<?=$subscriber['email']?>"> <?=$subscriber['email']?>
                    </label>
                    <?php endforeach; ?>
                </div>

                <label for="subject">Subject</label>
                <div class="field">
                    <input type="text" id="subject" name="subject" placeholder="Subject" required>
                </div>

                <label for="template">Email Template</label>
                <div class="field">
                    <textarea id="template" name="template" placeholder="Enter your HTML template code here..." required></textarea>
                </div>

                <div class="responses"></div>

			</div>

			<input id="submit" type="submit" value="Send">

		</form>

	</body>
</html>