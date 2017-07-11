<?php
session_start();
require 'database.php';
require 'security.php';
require 'function_addbill.php';
//$db has to be below function_addbill.php for some reason? lol
$db = new Database();

// Post data from form
$amount = XSSfilter($_POST['amount']);
$date = XSSfilter($_POST['date']);
$description = XSSfilter($_POST['description']);
$emailblob = XSSfilter($_POST['emailblob']);

// Split amount between the users
// add bill to others selected
$count = 1;
foreach($_POST['users'] as $users) {
      $count++;
}
$splitamount = $amount/$count;


foreach ($_POST['users'] as $users) {
    addBillToUser($users, $splitamount, $date, $description, $emailblob);
}

$authoramount = $amount - $splitamount;

// add bill to author
$query = "SELECT * FROM users WHERE(user_id = '".$_SESSION['user_id']."')";
$results = $db->query($query);
$row = $results->fetchArray();
$email = $row["email"];
addBillToUser($email, $authoramount, $date, $description, $emailblob);

header("Location: bill.php");
?>