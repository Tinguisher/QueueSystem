<?php
// make a session variable
session_start();

// if there is session
if (isset($_SESSION['id']) || isset($_SESSION['authtype'])) {
    // access database
    $mysqli = require_once "../contexts/database.php";

    // make a string for sql to be used
    $sql = "SELECT CONCAT(firstname,' ', lastname) AS name
        FROM `users`
        WHERE id = ?
            AND authtype = ?";

    // prepare the statement
    $stmt = $mysqli->prepare($sql);

    // bind the parameters to the statement
    $stmt->bind_param('is', $_SESSION['id'], $_SESSION['authtype']);

    // execute the statement
    $stmt->execute();

    // get the result from the statement
    $result = $stmt->get_result();

    // get only one from the executed statement
    $user = $result->fetch_assoc();

    // if there is no user found
    if (!$user) {
        // destroy each data in session
        session_unset();

        // destroy the sessions made
        session_destroy();
    }

    // free data and close statement and database
    $result->free();
    $stmt->close();
    $mysqli->close();
}

?>