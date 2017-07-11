/*
function checkRegister() {
    errorCount = 0;
    errorBox.innerHTML = ""; // resets errorBox
    
    var email = $('#email').val();
    var password = $('#password').val();
    var passwordre = $('#passwordre').val();
    var name = $('#name').val();
         
    if (email.length == 0) {
	errorBox.innerHTML += "please enter your email. <br>";
	errorCount++;
    }
     
    if (password.length == 0) {
	errorBox.innerHTML += "please enter your password. <br>";
	errorCount++;
    } else if (password.length < 5) {
	errorBox.innerHTML += "password must be more than 5 characters. <br>";
	errorCount++;
    }  
    if (passwordre != password) {
	errorBox.innerHTML += "password does not match, please re-enter. <br>";
	errorCount++;
    }
    
    if (name.length == 0) {
	errorBox.innerHTML += "please enter your name. <br>";
	errorCount++;
    } else if (name.length < 5) {
	errorBox.innerHTML += "name must be more than 5 characters. <br>";
	errorCount++;
    }
    
    if(errorCount > 0)
      return false;
    else 
      return true
}*/
$(document).ready( function() {
    
    $('#form').submit(function() {
	errorCount = 0;
	errorBox.innerHTML = ""; // resets errorBox
	
	var email = $('#email').val();
	var password = $('#password').val();
	var passwordre = $('#passwordre').val();
	var name = $('#name').val();
	    
	if (email.length == 0) {
	    errorBox.innerHTML += "please enter your email. <br>";
	    errorCount++;
	}
	
	if (password.length == 0) {
	    errorBox.innerHTML += "please enter your password. <br>";
	    errorCount++;
	} else if (password.length < 5) {
	    errorBox.innerHTML += "password must be more than 5 characters. <br>";
	    errorCount++;
	}  
	if (passwordre != password) {
	    errorBox.innerHTML += "password does not match, please re-enter. <br>";
	    errorCount++;
	}
	
	if (name.length == 0) {
	    errorBox.innerHTML += "please enter your name. <br>";
	    errorCount++;
	} else if (name.length < 5) {
	    errorBox.innerHTML += "name must be more than 5 characters. <br>";
	    errorCount++;
	}
	
	if(errorCount > 0)
	  return false;
	else 
	  return true 
    });
});