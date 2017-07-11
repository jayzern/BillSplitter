$(document).ready( function() { 

    $('button').click(function() {
	var id = (this.id);
	
	$.post('removeitem.php', {"item_id": id}, function(data) {
	  console.log("data from removeitem: " + data);
	});
	
	//removes row
	$(this).remove();
	return true;
	
    });
    
});