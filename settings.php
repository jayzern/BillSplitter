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
  
    <h1>CatSplitter: Settings</h1>
    
      <div class="hiddencontent">
      <p><b>Leave one box empty and Catsplitter won't change just that one box!</b></p> 
      </div>
  
      <div class="content">
	<div class="form">
	<form action='process_settings.php' method='POST'>
	  <table>
	  
	  <tr><h2>Change account settings</h2></tr>
	  
	  <tr>
	  <th><label><h2> New name: </h2></label><br/></th>
	  <th><input type='text' name='name'><br/></th>
	  </tr>
	  
	  <tr>
	  <th><label><h2> New password: </h2></label><br/></th>
	  <th><input type='password' name='password'><br/></th>
	  </tr>
	  
	  <tr>
	  <th><label><h2> Re-enter password: </h2></label><br/></th>
	  <th><input type='password' name='passwordre'><br/></th>
	  </tr>
	  
	  </table>
	  <input type='submit' value='ENTER'>
	  
	</div>
	</form>
	
	<center><img src="pusheen_settings.png" style="width:200px;height:150px"></center>
	<a href="bill.php" class="button">Back</a>
      </div>

  </body>
</html>