<?php

function getusers(){
    $mysqli = require "../contexts/database.php";
    $sql = "SELECT * FROM `user`";
    $result = $mysqli->query($sql);
    $users = $result->fetch_all( MYSQLI_ASSOC );

    $usertable = "";

    foreach ($users as $user){

        $usertable = $usertable .
            "<div>
                <h1>ID: ". $user['id'] . " Email: ". $user['email'] ."</h1>
            </div>";
    }

    return $usertable;
}

?>