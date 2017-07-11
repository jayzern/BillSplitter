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
    <script src='js_deletebill.js'></script>
    <title></title>
  </head>
  
  <body>
  
  <h1>CatSplitter: Settled bills </h1>
  
  <center><img src="pusheen_settledbills.png" style="width:250px;height:175px"></center>
  
  <div class="hiddencontent">
  <p><b>Note: it turns green if its a surplus; red if its a deficit!</b></p>
  </div>
  
  <div class="content">
  <?php 
  require 'function_balance.php';
  $balance = findBalance($_SESSION['user_id'], 0);
  if($balance >= 0) {
      echo "<h1>Total Paid: £<font color=green><div id='balance'>".$balance."</div></font></h1>";
  } else {
      echo "<h1>Total Paid: £<font color=red><div id='balance'>".$balance."</div></font></h1>";
  }
  ?>
  </div>
  
  <div class="hiddencontent">

  <p><b>Be careful, once you delete a bill, there is no way to retrieve it!</b></p>
  </div>
  
  <div class="content">
  <h2>Settled bills:</h2>
  
  <?php
  $billquery = "SELECT * FROM bills WHERE user_id = '".$_SESSION['user_id']."' AND pending = 0";
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
    echo "<p>".$status." &nbsp;&nbsp;&nbsp;&nbsp;<b>Author:</b> ".$name." <b>Amount:</b> £".$amount." <b>Bill:</b> ".$description." <b>Due on:</b> ".$due_date."<button style='float: right;' id=".$bill_id ."> DELETE </button><br/></p>";
  }
  ?>
  <a href="bill.php" class="button">Back</a>
  </div>
  
  </body>
  
</html>



