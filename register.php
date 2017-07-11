<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css" type="text/css" charset="utf-8">
    <script src='jquery-3.1.1.min.js'></script>
    <script src='js_register.js'></script>
    <title></title>
  </head>
  
  <body>
  
  <h1>Register on CatSplitter</h1>
    
    <div class="hiddencontent">
    <p><b> When you enter an email that already exists, Catsplitter redirects you back here.</b></p>
    <p><b> Please enter more than 5 characters for each field!</b></p>
    </div>
    
    <div class="loginregistercontent">
    <div class="form">
    
    <!-- action='process_register.php' replaced with onsubmit="return checkRegister()" -->
    <form action='process_register.php' id='form' method='POST'>
      <table>
      <img src="pusheen_register.png" style="width:200px;height:150px">
      <tr>
      <th><label> Email: </label></th> 
      <th><input type='text' id='email' name='email'><br/></th>
      </tr>
      
      <tr>
      <th><label> Password: </label></th>
      <th><input type='password' id='password' name='password'><br/></th>
      </tr>
      
      <tr>
      <th><label> Re-enter Password: </label></th>
      <th><input type='password' id='passwordre' name='passwordre'><br/></th>
      </tr>
      
      <tr>
      <th><label> Name: </label></th>
      <th><input type='text' id='name' name='name'><br/></th>
      </tr>
      
      </table>
      <input type='submit' value='register'>
    </div>
    

    <font color="red"><center><p><div id="errorBox"></div></p></center></font>
    
    </form>
    
    <a href="index.php" class="button">Back</a>
    </div>
  </body>
</html>
