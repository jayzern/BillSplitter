function checkLogin() {
    var errorCount = 0;
    errorBox.innerHTML = "";
    
    var email = $('#email').val();
    var password = $('#password').val();
     
    if (email.length == 0) {
	errorBox.innerHTML += "please enter email. <br>";
	errorCount++;
    }
      
    if (password.length == 0) {
	errorBox.innerHTML += "please enter password. <br>";
	errorCount++;
    }
      
    if(errorCount > 0)
	return false;
    else
	return true
      
}