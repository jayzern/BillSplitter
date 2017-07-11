<?php

function getName($user_id) {
    global $db;
    
    // fetch name from id
    $sql = $db->query("SELECT * FROM users WHERE user_id=$user_id");
    $row = $sql->fetchArray();
    $name = $row['name'];

    return $name;
}

?>