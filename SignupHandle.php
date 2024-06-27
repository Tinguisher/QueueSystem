<?php

echo 'Why press me';

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: NotFound.html");
}

?>