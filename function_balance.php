<?php

function findBalance($user_id, $pending) { 
    global $db;
    $totalamount = 0;
    
    // fetch user_id from email
    $sql = $db->query("SELECT * FROM bills WHERE user_id=$user_id AND pending=$pending");
    while ($row = $sql->fetchArray()) {
	$author_id = $row['author_id'];
	// if bill is GREEN
	if($user_id == $author_id) {
	    $totalamount += $row['amount'];
	} else {
	    $totalamount -= $row['amount'];
	}
    }
    return $totalamount;
}

?>