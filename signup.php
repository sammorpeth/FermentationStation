<?php

  include 'includes/header.inc.php';
  include_once 'classes/dbh.class.php';
  include_once 'classes/users.class.php';
  include_once 'classes/usersview.class.php';
  include_once 'classes/userscontr.class.php';


  if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwd-repeat'];

    $newUser = new UsersContr();
    $newUser->enterNewUser($username, $email, $pwd, $pwdRepeat);
  }

?>
<div class="container">
<?php
  if (isset($_POST['submit'])) {
    echo '<h2>You successfully signed up!</h2>';
  }
?>


<form action="signup.php" method="post">
    Username: <input type="text" name="username"> <br>
    Email: <input type="text" name="email"> <br>
    Password: <input type="password" name="pwd"> <br>
    Repeat Password: <input type="password" name="pwd-repeat"> <br> <br>
    <input type="submit" name="submit" value="Submit"> 
  </form>

  </div>
<?php


  include 'includes/footer.inc.php';

?>