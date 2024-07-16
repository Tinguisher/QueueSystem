<?php

session_start();
if ( isset($_SESSION['id']) ){

    $response = [
        'status' => "success",
        'loggedin' => true
    ];
    exit (json_encode($response));
}

// fetch ('../contexts/emanuel.php')
    // .then (response => response.json())
    //     .then (data => {
    //         console.log (data);
    //         const sessiontext = document.getElementById("sessiontext");

    //         if (data.loggedin){
                
                
    //             // change the value of text
    //             sessiontext.textContent = "Logout";
    //         }

    //         else{
    //             // change the value of text
    //             sessiontext.textContent = "Sign in";
    //         }
    //     })

exit (json_encode('haha'));
?>