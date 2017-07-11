<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css" type="text/css" charset="utf-8">
    <script src='jquery-3.1.1.min.js'></script>
    <script src='js_login.js'></script>
    <title></title>
  </head>
  
  <body>
  
  <h1>Welcome to CatSplitter</h1>
  
  <div class="hiddencontent">
  <center><b>
  <p>New Cat in town? Click register to get started!</p>
  <p>Forgot your password? Click forgot password to retrieve it!</p>
  <p> CatSplitter protects you against SQL Injections and XSS attacks.</p>
  </center></b>
  </div>
  
    <div class="loginregistercontent">

      <div class="form">
	<form action='process_login.php' onsubmit='return checkLogin()' method='POST'>
	  <table>
	  
	  <tr>
	  <th><label> Email: </label></th> 
	  <th><input type='text' id='email' name='email'><br/></th>
	  </tr>
	  
	  <tr>
	  <th><label> Password: </label></th>
	  <th><input type='password' id='password' name='password'><br/></th>
	  </tr>
	  
	  </table>
	  <input type='submit' value='login'>
	</form>
	<img src="pusheen_index.png" style="width:300px;height:250px">
	
      </div>
      <font color="red"><center><p><div id="errorBox"></div></p></center></font>
      <center>
	<a href="register.php" class="button">Register</a>
	<a href="resetpassword.php" class="button">Forgot Password?</a>
      </center>
    </div>

  </body>
</html>
