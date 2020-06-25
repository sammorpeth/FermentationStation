<?php 
  session_start();
  if (!isset($_SESSION) && $_SESSION['user_type'] == 'admin') {
    header('Location: login.php');
  }
?>