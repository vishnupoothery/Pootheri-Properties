<?php

session_start();

if( isset($_SESSION['user_id']) ){
    header("Location: index.php");
}

require 'database.php';

if(!empty($_POST['username']) && !empty($_POST['password'])):

$records = $conn->prepare('SELECT id,fname,sname,username,email,password FROM users WHERE username = :username');
$records->bindParam(':username', $_POST['username']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$message = '';

if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
    $_SESSION['username'] = $results['username'];
    $_SESSION['fname'] = $results['fname'];
    $_SESSION['sname'] = $results['sname'];
    $_SESSION['email'] = $results['email'];
    $_SESSION['user_id'] = $results['id'];
    header("Location: index.php");

} else {
    $message = 'Sorry, those credentials do not match';
}

endif;

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="manifest" href="manifest.json">

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
    <body>

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

        <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
        <?php endif; ?>

        <h1 class="center-align">Login</h1>

        <form action="login.php" method="POST">
            <div class="container row">
                <div class="col s12 m6"><input type="text" placeholder="Enter your username" name="username"></div>
                <div class="col s12 m6"><input type="password" placeholder="and password" name="password"></div>
                <div class="col s12 center-align"><input class="btn" type="submit"></div>
            </div>



        </form>

    </body>
</html>