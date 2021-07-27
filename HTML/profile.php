<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
$url = $_SERVER['REQUEST_URI']; 
if ($url == "/Project/HTML/profile.php") {
  $_GET['profileid'] = 0;
}
include "subfiles/_dbconnect.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
 header("location: signin_signup.php");
  exit;
}
  $uid = $_SESSION['id'];
  $profileid = $_GET['profileid'];
  $sql = "SELECT * FROM `users` WHERE `Id` = $profileid";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['username'];
  $email = $row['user_id'];
  if ($row['Status'] == "PICT") {
   $college = "Pune Institute Of Computer Technology";
  } else {
    $college = "Not updated yet";
  }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/581e5b9e69.js"
      crossorigin="anonymous"
    ></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../CSS/profile.css" />
    <script defer src="../JS/profile.js"></script>
    <title>Discussiom Forum || Profile Page</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check" />
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">
        <a href="../HTML/home.html"> DISCUSSION FORUM </a>
      </label>
      <ul>
        <li><a href="../HTML/home.php">Home</a></li>
        <li><a href="team.php">Our Team</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="logout.php" class="confirmation">Logout</a>
        <script type="text/javascript">
                    var elems = document.getElementsByClassName('confirmation');
                    var confirmIt = function(e) {
                        if (!confirm('Are you sure to logout?')) e.preventDefault();
                    };
                    for (var i = 0, l = elems.length; i < l; i++) {
                        elems[i].addEventListener('click', confirmIt, false);
                    }
                    </script></li>
        <li><a a class="active" href="../HTML/profile.html">Profile</a></li>
      </ul>
    </nav>
    
    <div class="profile">
      <div class="image">
      
        <img src="../Images/avatar.svg" alt="profile photos" />
      </div>
      <div class="msg">
      <?php
          if ($uid == $profileid ) {
          echo '<h4>Hello <span><?php echo $name;?></span>, Welcome to the DISCUSSION FORUM.</h4>';
          }
          ?>
        <h4 class="underline">
        <?php
          if ($uid == $profileid ) {
          echo 'Your';
          }
          ?> Profile</h4>
      </div>
      <div class="info">
        <div class="question">
          <div class="name">
            <h4>Name</h4>
          </div>
          <div class="email">
            <h4>Email/Username</h4>
          </div>
          <div class="clg">
            <h4>College</h4>
          </div>
          <?php
          if ($uid == $profileid ) {
          echo '<div class="ip">
          <h4>IP Address</h4>
        </div>';}
          ?>
        </div>
        <div class="ans">
          <div class="name">
            <p><?php echo $name;?></p>
          </div>
          <div class="email">
            <p><?php echo $email;?></p>
          </div>
          <div class="clg">
            <p><?php echo $college;?></p>
          </div>
          <?php
          
          @$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
          @$http_forwarded_for = $_SERVER['HTTP_FORWARDED_FOR'];
          $remote_addr = $_SERVER['REMOTE_ADDR'];
          if (!empty($http_client_ip)) {
            $ipaddress = $http_client_ip;
          }
          elseif (!empty($http_forwarded_for)) {
            $ipaddress = $http_forwarded_for;
          }
          elseif (!empty($remote_addr)) {
            $ipaddress = $remote_addr;
          }
          if ($ipaddress == "::1") {
          $ipaddress = "127.0.0.1";
          }
          
          if ($uid == $profileid ) {
          echo '<div class="ip">
          <p>'.$ipaddress.'</p>
        </div>';
          }
          ?>
          
        </div>
      </div>
    </div>
    <?php
          if ($uid == $profileid ) {
          echo '
    <button id="myBtn">Update Profile</button>
    
    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <form action="#" class="update">
          <img src="../Images/avatar.svg" class="avatar" alt="" />
          <h2 class="title">Update Profile</h2>
          <div class="input-field">
            <input type="text" placeholder="Your name" />
          </div>
          <div class="input-field">
            <input
              type="text"
              placeholder="Your college"
            />
          </div>
          <input type="submit" value="Update" class="btn solid" />
        </form>
      </div>
    </div>';
  }
  ?>
  <?php
          if ($uid != $profileid ) {
            echo '<div style="min-height:40px;"></div>';
          }
          ?>
          <script>
        function updateUserStatus() {
            jQuery.ajax({
                url: 'update_user_status.php',
                success: function() {

                }
            });
        }

        function getUserStatus() {
            jQuery.ajax({
                url: 'get_user_status.php',
                success: function(result) {
                    jQuery('#user_grid').html(result);
                }
            });
        }

        setInterval(function() {
            updateUserStatus();
        }, 3000);

        setInterval(function() {
            getUserStatus();
        }, 7000);
        </script>
    <footer>
      <div class="center">2A92021 All Rights Reserved</div>
    </footer>
  </body>
</html>
