<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
  // if user is NOT logged in, redirect them to login page
  if (!isset($_SESSION['user_id'])) {
    header("location: {$site_url}/login.php");
  }
  
  //if user is logged in and this user is NOT an admin user, redirect them to landing page
  if (isset($_SESSION['email']) && $_SESSION['role'] != 'admin') {
    header("location: {$site_url}/index.php");
  }
?>