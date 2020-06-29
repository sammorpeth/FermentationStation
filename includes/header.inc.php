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
    echo $username, $email, $pwd, $pwdRepeat;

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
          if (!isset($_SESSION['username'])) {
            echo '<li><a href="signup.php">Sign Up</li></a>';
          } else { 
            echo '<li><a href="profile.php">Your profile</li></a>';
            echo '<li><a href="users.php">Admin</li></a>';
            echo '<li><a href="social.php">Social</li></a>';
      
          }
        ?>
      </ul> 
      </div>
      <div class="social">
      <?php 
        if (isset($_SESSION['username'])) {
         $loggedIn = new UsersView();
         $loggedIn->loggedInDisplay();
         
        } else {
         $loggedOut = new UsersView();
         $loggedOut->loggedOutDisplay();
        } 
      ?> 
<!-- /end Nav bar -->

<!-- Need to figure out a better place to put this because it interferes
with the sign up modal. I could put the sign up in a CTA button and not in the header. -->
<!-- Modal -->
 <!-- <div class="modal-container" id="modal">
  <div class="modal">
    <button class="close-btn" id="close-modal">X</button>
    <div class="modal-header">
      <h3>Sign Up</h3>
    </div>
    <div class="modal-content">
      <p>Sign up today for great recipes, new friends and more</p>
      <form action="index.php" method="post" class="modal-form">
        <div>
          <label for="name">Name</label>
          <input name="username" type="text" id="name" placeholder="Enter Name" class="form-input">
        </div>
        <div>
          <label for="email"  >Email</label>
          <input name="email" type="email" id="email" placeholder="Enter Email"  class="form-input">
        </div>
        <div>
          <label for="password">Password</label>
          <input name="pwd" type="password" id="password" placeholder="Enter Password"  class="form-input">
        </div>
        <div>
          <label for="password2">Confirm password</label>
          <input name="pwd-confirm" type="password" id="password2" placeholder="Confirm Password"  class="form-input">
        </div>
        <input class="btn-orange" type="submit" name="sign-up" value="Submit"> 

      </form>
    </div>
  </div>
</div> 
    -->

      </div>
    </div>
    </div>

 

 
 

