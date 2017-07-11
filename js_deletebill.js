$(document).ready( function() { 
    $('button').click(function() {
	var balance = document.getElementById('balance').innerHTML;
	var id = (this.id);
	var html = "";
	$.post('process_deletebill.php', {"bill_id": id}, function(data) {
	  console.log(data);
	  if (data >= 0) {
	    html = "<font color=green>" + data + "</font>";
	  } else {
	    html = "<font color=red>" + data + "</font>";
	  }
	  console.log(html);
	  document.getElementById('balance').innerHTML = html;
	});
	
	//removes row
	$(this).parent().remove();
	return false;
    });
});