<?php
function addBillToUser($email, $amount, $date, $description, $emailblob) { 
    global $db;
    session_start();
    // fetch user_id from email
    $row = $db->querySingle("SELECT * FROM users WHERE email='$email'");
    $id = $row['user_id'];
    
    
    //fetch author name
    $row = $db->querySingle("SELECT * FROM users WHERE user_id=".$_SESSION['user_id']."");
    $authorname = $row['name'];

    // add bill to user
    $sql = $db->prepare("INSERT INTO bills VALUES(NULL, :user_id, :author_id, :amount, :due_date, :description, :pending)");
    $sql->bindValue(":user_id", $id, SQLITE3_INTEGER);
    $sql->bindValue(":author_id", $_SESSION['user_id'], SQLITE3_INTEGER);
    $sql->bindValue(":amount", $amount, SQLITE3_INTEGER);
    $sql->bindValue(":due_date", $date, SQLITE3_TEXT);
    $sql->bindValue(":description", $description, SQLITE3_TEXT);
    $sql->bindValue(":pending", 1, SQLITE3_INTEGER);
    $sql->execute();
    
    // add notification to users
    if ($id == $_SESSION['user_id']) {
	$new_description = "You have just added a new bill: ".$description." with £".$amount." owed.";
    } else if ($id != $_SESSION['user_id']) {
	$new_description = "You owe ".$authorname." a bill: ".$description." with £".$amount." due.";
	if($emailblob == 1) {
	    $email_description = $new_description." click on link to settle payment: http://cs139.dcs.warwick.ac.uk/~u1500212/cs139/BillSplitter/index.php";
	    mail($email, "CatSplitter, new bill!" , $email_description, "FROM CATSPLITTER");
	}
    }
    
    $sql = $db->prepare("INSERT INTO notifications VALUES(NULL, :user_id, :description, :notification_date)");
    $sql->bindValue(":user_id", $id, SQLITE3_INTEGER);
    $sql->bindValue(":description", $new_description, SQLITE3_TEXT);
    $sql->bindValue(":notification_date", $date, SQLITE3_NUM);
    $sql->execute();
}

?>