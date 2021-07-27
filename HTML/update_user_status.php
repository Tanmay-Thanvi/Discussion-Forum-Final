<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
include "subfiles/_dbconnect.php";
session_start();
  $uid = $_SESSION['id'];
  $time = time() + 10;
  $sql = "UPDATE `users` SET `last_login` = $time WHERE `Id` = $uid";
  $result = mysqli_query($conn,$sql);
?>