<?php
require 'database.php';
require 'security.php';
$db = new Database();

// get the data posted from the form
// Filter XSS
$email = XSSfilter($_POST["email"]);

// fetch user_id



header('Location: resetpassword.php');
?>