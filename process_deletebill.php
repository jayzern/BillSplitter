<?php
session_start();
require 'database.php';
require 'function_balance.php';
$db = new Database();
$bill_id = $_POST['bill_id'];
$db->exec("DELETE FROM bills WHERE bill_id=$bill_id");

// get new balance
$balance = findBalance($_SESSION['user_id'], 0);
echo $balance;
?>