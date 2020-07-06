<?php
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';

  session_start();

  // Handle modal submission
  if (isset($_POST['sign-up'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwd-confirm'];
    $newUser = new UsersContr();
    $newUser->enterNewUser($username, $email, $pwd, $pwdRepeat);
  }

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Fermentation Station</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/carousel.css">

</head>

<!-- Nav bar -->
 <body>
  <div class="nav-bar-wrapper">
    <div class="nav-bar">
      <div>
        <h1 data-title="Fermentation Station" class="text-fill">Fermentation Station</h1>
        <span>All aboard!</span>
      </div>

      <div>
      <ul class="nav-items">
        <li><a href="index.php">Home</li></a>
        <li><a href="select.php">Fermentations</li></a>
        <?php 
       
          // shows admin link to admins
          if (isset($_SESSION['username']) && $_SESSION['user_type'] == 'admin') {
            echo '<li><a href="users.php">Admin</li></a>';
            echo '<li><a href="profile.php">Your profile</li></a>';
            echo '<li><a href="social.php">Social</li></a>';
          // shows profile link to logged in users
          } elseif (isset($_SESSION['username']) && $_SESSION['user_type'] == 'user') { 
            echo '<li><a href="social.php">Social</li></a>';
            echo '<li><a href="profile.php">Your profile</li></a>';
          } else {
            echo '<li><a href="social.php">Social</li></a>';

          }
        ?>
      </ul> 
      </div>
      <div class="social">
      <?php 
      // Shows logged in message
        if (isset($_SESSION['username'])) {
         $loggedIn = new UsersView();
         $loggedIn->loggedInDisplay();
      // Shows log in buttons
        } else {
         $loggedOut = new UsersView();
         $loggedOut->loggedOutDisplay();
        } 
      ?> 
<!-- /end Nav bar -->

      </div>
    </div>
    </div>

 

 
 

