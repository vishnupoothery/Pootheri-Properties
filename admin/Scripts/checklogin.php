<?php

session_start();

if( !isset($_SESSION['admin_logedin']) ){
    header("Location: ../login.php");
}

?>