<?php
session_start();
require 'security.php';
require 'database.php';

$db = new Database();
// session id for easier use!
$user_id = $_SESSION['user_id'];
$name = XSSfilter($_POST['name']);
$password = XSSfilter($_POST['password']);
$passwordre = XSSfilter($_POST['passwordre']);
$salt = time();
$encryptedpassword = sha1($salt."--".$password);

// make the required changes
if ($name != "") {
  $query = $db->prepare("UPDATE users SET name=:name WHERE user_id=:user_id");
  $query->bindValue(":user_id", $user_id, SQLITE3_INTEGER);
  $query->bindValue(":name", $name, SQLITE3_TEXT);
  $query->execute();
}

if ($password != "" && $password == $passwordre) {
  $query = $db->prepare("UPDATE users SET password=:password, salt=:salt WHERE user_id=:user_id");
  $query->bindValue(":user_id", $user_id, SQLITE3_INTEGER);
  $query->bindValue("password", $encryptedpassword, SQLITE3_TEXT);
  $query->bindValue(":salt", $salt, SQLITE3_TEXT);
  $query->execute();
}

header("Location: bill.php");
?>
