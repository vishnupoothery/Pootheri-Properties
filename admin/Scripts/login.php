<?php

session_start();

if( isset($_SESSION['admin_logedin']) ){
    header("Location: ../MainPage/");
}

require '../Scripts/config.php';

if(!empty($_POST['username']) && !empty($_POST['password'])):

$records = $conn->prepare('SELECT id,username,password,name FROM pootheri_admin WHERE username = :username');
$records->bindParam(':username', $_POST['username']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$message = '';

if($results->num_row !=1){
    header("Location: ../login.php?Error");
}
if(!password_verify($_POST['password'], $results['password'])){
    header("Location: ../login.php?Error");
}
$_SESSION['admin_logedin'] = $results['id'];
    $_SESSION['admin_name'] = $results['name'];
    header("Location: ../MainPage/");

endif;

?>
