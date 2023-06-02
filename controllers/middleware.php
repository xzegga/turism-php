<?php

  // if user is NOT logged in, redirect them to login page
  if (!isset($_SESSION['user_id'])) {
    header("location: ./login.php");
  }
  
  //if user is logged in and this user is NOT an admin user, redirect them to landing page
  if (isset($_SESSION['email']) && $_SESSION['role'] != 'admin') {
    header("location: ./index.php");
  }

  function isAdmin() {
    if($_SESSION['role'] == 'admin' && isset($_SESSION['email'])){
      return true;
    } else {
      return false;
    }
  }

?>