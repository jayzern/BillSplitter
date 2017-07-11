<?php
session_start();
// check whether you have access
require 'access.php';
require 'database.php';
$db = new Database();
require 'function_getname.php';
if (loggedIn() == false) header('Location: index.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css" type="text/css" charset="utf-8">
    <script src='jquery-3.1.1.min.js'></script>
    <script src='js_settlebills.js'></script>
    <title></title>
  </head>
  <body>
  
  <div class="hiddencontent">
  <?php
  $username = getName($_SESSION['user_id']);
  echo "<h1>Welcome, ".$username."</h1>";
  ?>
  </div>
  
  <div class="hiddencontent">
  <a href="addbill.php" class="button">Add Bill</a>
  <a href="settledbills.php" class="button">Settled Bills</a>
  <a href="settings.php" class="button">Settings</a>
  <a href="process_logout.php" class="button">Logout</a>
  </div>
  

  
  <div class="hiddencontent">
  <div class="pusheen">
      <a href="http://www.pusheen.com/"><img src="pusheen_bill.png" style="width:225px;height:175px"></a>
  </div>
  <p><b> Copyright: Cats were taken from http://www.pusheen.com/, click on the cat for more!</b></p>
  <p><b>Note: it turns green if its a surplus; red if its a deficit! </b></p>
  <p><b>After you settle a bill, your balance uses AJAX to recalculate and recolour itself.</b></p>
  </div>
  
  
  <!-- TOTAL BALANCE -->
  <div class="content">
  <?php 
  require 'function_balance.php';
  $balance = findBalance($_SESSION['user_id'], 1);
  if($balance >= 0) {
      echo "<h1>Total Balance: £<font color=green><div id='balance'>".$balance."</div></font></h1>";
  } else {
      echo "<h1>Total Balance: £<font color=red><div id='balance'>".$balance."</div></font></h1>";
  }
  ?>
  </div>

  <div class="hiddencontent">
  <p><b> When settling a bill that is <font color=red>DUE</font>, CatSplitter sends a notification to the author!</b><p>
  <p><b> When settling a bill that is <font color=green>OWED</font>, CatSplitter stores your bill in Settled Bills.</b><p>
  </div>
  
  
  <!-- PENDING BILLS ONLY -->
  <div class="content">
  <h2>Pending: (Most recent notifications at the top!)</h2>
  
  <?php
  $billquery = "SELECT * FROM bills WHERE user_id = '".$_SESSION['user_id']."' AND pending = 1 ORDER BY bill_id DESC";
  $billresults = $db->query($billquery);
  
  while ($billrow = $billresults->fetchArray()) {
    $bill_id = $billrow['bill_id'];
    $author_id = $billrow['author_id'];
    $amount = number_format((float)$billrow['amount'], 2, '.', '');
    $due_date = $billrow['due_date'];
    $description = $billrow['description'];
    
    // get name of author
    $name = getName($author_id);    
    
    if($author_id == $_SESSION['user_id'])
	$status = "<font color=green><b>OWED</b></font>";
    else 
	$status = "<font color=red><b>DUE</b></font>";
    
    
    // prints the bill
    echo "<p>".$status." &nbsp;&nbsp;&nbsp;&nbsp;<b>Author:</b> ".$name." <b>Amount:</b> £".$amount." <b>Bill:</b> ".$description." <b>Due on:</b> ".$due_date."<button style='float: right;' id=".$bill_id ."> Settle</button><br/></p>";
  }
  ?>
  </div>
  
  <!-- NOTIFICATIONS -->
  <div class="content">
  <h2> Notifications: (Top 10 most recent notifications only!) </h2>
  <?php
  
    $sql = "SELECT * FROM notifications WHERE user_id = '".$_SESSION['user_id']."' ORDER BY notifications_id DESC LIMIT 10";
    $results = $db->query($sql);
    
    while($row = $results->fetchArray()) {
	$description = $row['description'];
	echo "<p>".$description."</p>";
    }
  
  ?>
  </div>
  
  </body>
  
</html>



