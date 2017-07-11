<?php
session_start();
// check whether you have access
require 'access.php';
if (loggedIn() == false) header('Location: index.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css" type="text/css" charset="utf-8">
    <title></title>
  </head>
  
  <body>
  
    <h1>CatSplitter: Add Bill</h1>
    
      <div class="hiddencontent">
      
      <p><b>
      After you add a bill, CatSplitter splits the bill evenly between the number of cats!<br>
      CatSplitter sends a notification to your feline friends to pay as well.<br>
      If you want to send an e-mail to your feline friends, just tick the box below!<br>
      NOTE: Cats don't have fingers, so no coins accepted!</b></p>
      </div>
  
      <div class="content">
	<div class="form">
	<form action='process_addbill.php' method='POST'>
	  <table>
	  <center><img src="pusheen_addbill.png" style="width:120px;height:125px"></center>
	  <tr><h2>Select cats to split bill.</h2></tr>
	  
	  <?php
	  require 'database.php';
	  $db = new Database();
	  
	  $query = "SELECT * FROM users WHERE(user_id != '".$_SESSION['user_id']."')";
	  $results = $db->query($query);
	  while ($row = $results->fetchArray()) {
	    $user_id = $row['user_id'];
	    $name = $row['name'];
	    $email = $row['email'];
	    echo "<tr><th>".$email." (".$name.")</th><th><input type='checkbox' value='".$email."' name='users[]'></th></tr>";
	  }
	  ?>
	  
	  <tr>
	  <th><label><h2> Amount: £(no coins accepted)</h2></label><br/></th>
	  <th><input type='number' name='amount'><br/></th>
	  </tr>
	  
	  <tr>
	  <th><label><h2> Due date:</h2></label><br/></th>
	  <th><input type='date' name='date'><br/></th>
	  </tr>
	  
	  <tr>
	  <th><label><h2> Enter a description: </h2></label></th>
	  <th><input type='text' name='description'><br/></th>
	  </tr>
	 
	  <tr>
	  <th><label> Send e-mail to cats to notify them?<label></th>
	  <th><input type='checkbox' value='1' name='emailblob'></th>
	  <tr>
	  
	  </table>
	  <input type='submit' value='ENTER'>
	  
	</div>
	</form>
	
	<center></center>
	<a href="bill.php" class="button">Back</a>
      </div>

  </body>
</html>
