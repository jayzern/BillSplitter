<?php
require 'database.php';
require 'security.php';
$db = new Database();

// get the data posted from the form
// Filter XSS
$email = XSSfilter($_POST["email"]);
$password = XSSfilter($_POST["password"]);
$passwordre = XSSfilter($_POST["passwordre"]);
$salt = sha1(time());
$name = XSSfilter($_POST["name"]);

// check database and see whether email is unique
$sql = $db->prepare("SELECT * FROM users WHERE email=:email");
$sql->bindValue(":email", $email, SQLITE3_TEXT);
$results = $sql->execute();
$row = $results->fetchArray();
if (isset($row['user_id'])) {
  header("Location: register.php");
  exit();
}

// encrypt the password
$encrypted_password = sha1($salt."--".$password);

// add the user to the database
$sql = $db->prepare("INSERT INTO users VALUES(NULL, :email, :encrypted_password, :salt, :name)");
$sql->bindValue(":email", $email, SQLITE3_TEXT);
$sql->bindValue(":encrypted_password", $encrypted_password, SQLITE3_TEXT);
$sql->bindValue(":salt", $salt, SQLITE3_TEXT);
$sql->bindValue(":name", $name, SQLITE3_TEXT);
$sql->execute();

// start a new session for this user and redirect to homepage
session_start();

$sqlid = "SELECT * FROM users WHERE(email = '$email')";
$row = $db->querySingle($sqlid);
$_SESSION['user_id'] = $row['user_id'];
header('Location: bill.php');
?>