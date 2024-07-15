<?php

session_start();
if ( isset($_SESSION['id']) ){

    $response = [
        'status' => "success",
        'loggedin' => true
    ];
    exit (json_encode($response));
}


exit (json_encode('haha'));
?>