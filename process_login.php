<?php
include "database.php";
include "security.php";

$db = new Database();

$email = XSSfilter($_POST["email"]);
$password = XSSfilter($_POST["password"]);

$sql = $db->prepare("SELECT * FROM users WHERE email=:email");
$sql->bindValue(":email", $email, SQLITE3_TEXT);
$results = $sql->execute();
$row = $results->fetchArray();

// encrypt the password with the corresponding salt
$salt = $row["salt"];
$encrypted_password = sha1($salt."--".$password);
$password = $row["password"];

// check if the passwords match
if ($encrypted_password == $password) {
  session_start();
  $_SESSION["user_id"] = $row["user_id"];
  header("Location: bill.php");
  exit();
} else {
  header("Location: index.php");

}
?>