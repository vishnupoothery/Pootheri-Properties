<?php

session_start();

if( isset($_SESSION['user_id']) ){
    header("Location: index.php");
}

require 'database.php';

$message = '';

if(!empty($_POST['username']) && !empty($_POST['password'])):

// Enter the new user in the database
$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':username', $_POST['username']);
$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

if( $stmt->execute() ):
$message = 'Successfully created new user';
else:
$message = 'Sorry there must have been an issue creating your account';
endif;

endif;
?>

<!DOCTYPE html>
<html>
    <head>

        <link rel="manifest" href="manifest.json">

        <meta name="description" content="Pootheri properties website">
        <meta name="keywords" content="pootheri,properties,vishnu poothery,calicut,kozhikode">
        <meta name="author" content="Vishnu Poothery">
        <meta name="robots" content="index,follow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Pootheri Properties</title>

        <!-- CSS  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="https://fonts.googleapis.com/css?family=Poiret+One|Abel|Spectral|Forum" rel="stylesheet"> 
    </head>

    <div class="navbar-fixed">
        <nav class="teal accent-4" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo hide-on-med-and-up" style="font-family: 'Poiret One', cursive">PootheriProperties</a>
                <a id="logo-container" href="#" class="brand-logo hide-on-small-only" style="font-family: 'Poiret One', cursive">Pootheri Properties</a>
                <ul class="right hide-on-med-and-down" style="font-family: 'Abel', cursive">
                    <li><a href="index.html" >Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>


                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <ul id="nav-mobile" class="sidenav" style="font-family: 'Abel', cursive">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
    <body>

        <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
        <?php endif; ?>

        <h1 class="center-align">Register</h1>

        <form action="register.php" method="POST">
            <div class="container row">
                <div class="col s12 m6"><input type="text" name="fname" placeholder="Enter First Name"> </div>
                <div class="col s12 m6"><input type="text" name="sname" placeholder="Enter Second Name"> </div>
                <div class="col s12"><input type="text" name="username" placeholder="Enter username"> </div>
                <div class="col s12 m6"><input type="text" name="email" placeholder="Enter Email"> </div>
                <div class="col s12 m6"><input type="text" name="mobile" placeholder="Enter Mobile"> </div>
                <div class="col s12 m6"><input type="password" name="password" placeholder="Enter Password"> </div>
                <div class="col s12 m6"><input type="password" name="password" placeholder="Re-Enter Password"> </div>
                <div class="col s12"><input type="text" name="address" placeholder="Enter Address">  </div>
                <br>
                <div class="col s12 center-align"><input class="btn btn-primary" type="submit"></div>
            </div>
            

        </form>

    </body>
</html>