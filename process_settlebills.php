<?php
session_start();
require 'database.php';
require 'security.php';
require 'function_balance.php';
$db = new Database();

// POST
$bill_id = XSSfilter($_POST["bill_id"]);

// set bills from pending to settled
$sql = $db->prepare("UPDATE bills SET pending=:pending WHERE bill_id=:bill_id");
$sql->bindValue(":bill_id", $bill_id, SQLITE3_INTEGER);
$sql->bindValue(":pending", 0, SQLITE3_INTEGER);
$sql->execute();



//**************SEND NOTIFICATION TO AUTHOR IF YOU ARE A PAYER*****
// get author id and amount
$sql = "SELECT * FROM bills WHERE bill_id=$bill_id"; 
$row = $db->querySingle($sql);
$author_id = $row['author_id'];
$amount = $row['amount'];
$description = $row['description'];

// get user name
$sql = "SELECT * FROM users WHERE user_id=".$_SESSION['user_id'].""; 
$row = $db->querySingle($sql);
$username = $row['name'];

// write description
$new_description = $username." has paid you back £".$amount." for bill: ".$description;

// NEED TO SEND NOTIFICATION TO AUTHOR if you are a payer
if($author_id != $_SESSION['user_id']) {
    $sql = $db->prepare("INSERT INTO notifications VALUES(NULL, :user_id, :description, :notification_date)");
    $sql->bindValue(":user_id", $author_id ,SQLITE3_INTEGER);
    $sql->bindValue(":description", $new_description ,SQLITE3_TEXT);
    $sql->bindValue(":notification_date", NULL, SQLITE3_NUM);
    $sql->execute();
}
//*****************************************************************


// get new balance
$balance = findBalance($_SESSION['user_id'], 1);

echo $balance;

?>