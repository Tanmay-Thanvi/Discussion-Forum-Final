<?php

//index.php

//Include Configuration File

include "subfiles/_dbconnect.php";
include('config.php');
?>
<?php
//    if($login_button == '')
//    {
//     echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
//     echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
//     echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
//     echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
//     echo '<h3><a href="logoutt.php">Logout</h3></div>';
//    }
//    else
//    {
//     echo '<div align="center">'.$login_button . '</div>';
//    }
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/581e5b9e69.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/signin_signup.css" />
    <link rel="stylesheet" href="/Project/HTML/subfiles/dismissible.css" />
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <title>Discussion Forum || SignIn-SignUP</title>
    <script src="/Project/HTML/subfiles/dismissible.js"></script>
</head>

<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
$url = $_SERVER['REQUEST_URI']; 
if ($url == "/Project/HTML/signin_signup.php") {
  $_GET['userid'] = "";
  $_GET['password'] = "";
}
  if ($_SESSION['loggedin'] = true) {
    //  header("location: home.php"); not to redirect on this page after login
  }
$time = time();
if ($_SERVER['REQUEST_METHOD']== 'POST') {
  // signup form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $cpass = $_POST['cpass'];
  if ($name == "" or $email == "" or $pass == "") {
    null;
  }
  else{
  $existsql = "SELECT * FROM `users` WHERE user_id = '$email'";
 $result = mysqli_query($conn,$existsql);
  $row = mysqli_num_rows($result);
    if ($row > 0) {
      echo "
      <div id='dismissible-container' style='z-index: 50'></div><script>
      const container = document.querySelector('#dismissible-container');
      const dismissible = new Dismissible(container);
      dismissible.info('Userid already exist. Please try with another one');
  </script>"; // issue is in alert banner 
  
    }
    else {
      if ($pass == $cpass) {
        $sqli = "SELECT * FROM `users` WHERE `Status` = 'Other'";
        $res = mysqli_query($conn,$sqli);
        $num = mysqli_num_rows($res);
        $id = $num + 1 ;
        $id = "0" . $id;
        $hash = password_hash($pass,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`Status`,`Id`, `username`, `user_id`, `user_pass`, `last_login`) VALUES ('Other','$id', '$name', '$email', '$hash', '0')";
        $result = mysqli_query($conn,$sql);
        
        if ($result) {
          echo "<div id='dismissible-container' style='z-index: 50'></div><script>
          const container = document.querySelector('#dismissible-container');
          const dismissible = new Dismissible(container);
          dismissible.success('You have signed up successfully. pls login now'); 
      </script>";
        }
        else {
          echo "<div id='dismissible-container' style='z-index: 50'></div><script>
          const container = document.querySelector('#dismissible-container');
          const dismissible = new Dismissible(container);
          dismissible.error('Technical Error! Something went wrong. Please try after some time ');
      </script>";
        }
      }
      else {
        echo "<div id='dismissible-container' style='z-index: 50'></div><script>
        const container = document.querySelector('#dismissible-container');
        const dismissible = new Dismissible(container);
        dismissible.error('Passwords do not match try once again ');
    </script>";
      }
  }
}
}



if ($_SERVER['REQUEST_METHOD']== 'GET') {
  // lets make login system
  if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];

 



  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
  $userid = $data['email'];
  $sql = "SELECT * FROM `users` WHERE user_id = '$userid'";
  $resulta = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($resulta);
  if ($row == null) {
        echo "
    <div id='dismissible-container' style='z-index: 50'></div><script>
    const container = document.querySelector('#dismissible-container');
    const dismissible = new Dismissible(container);
    dismissible.info('Userid do not exist. Please signup!');
</script>"; // issue is in alert banner 
 }
  else {
    if ($row['user_id'] == $userid) {
        $uid = $row['Id'];
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $uid;
        $time=time()+10;
        $res=mysqli_query($conn,"update users set last_login=$time where id=".$_SESSION['id']);
        header("location: home.php");
      }
  }
 }
}
else {
  $userid = $_GET['userid'];
  $pass = $_GET['password'];
  if ($userid == "" or $pass == "") {
    null;
  }
  else {
  $sql = "SELECT * FROM `users` WHERE user_id = '$userid'";
  echo $sql;
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  if ($row == null) {
      $row['user_pass'] = " ";
  }
  if (password_verify($pass,$row['user_pass'])) {
    $uid = $row['Id'];
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $uid;
    $time=time()+10;
    $res=mysqli_query($conn,"update users set last_login=$time where id=".$_SESSION['id']);
    header("location: home.php");
  } 
  else {
      echo "<div id='dismissible-container'style='z-index: 50'></div><script>
      const container = document.querySelector('#dismissible-container');
      const dismissible = new Dismissible(container);
      dismissible.error('Incorrect userid or password. please try again');
  </script>";

  }
}
}
}
?>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="signin_signup.php" class="sign-in-form" method="GET">
                    <img src="../Images/avatar.svg" class="avatar" alt="" />
                    <h2 class="title">Login In</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="userid" placeholder="User id" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" value="Login In" class="btn solid" />
                    <p class="social-text"><span>
                            <center>Or</center>
                        </span><span>login in with GOOGLE</span></p>
                    <div class="social-media">

                            <!-- <i class="fab fa-google"></i> -->
                            <?php
                            echo '<a href="'.$google_client->createAuthUrl().'" class="social-icon"> <img src="../Images/google.png" height="40px" width="40px"> </a>';
                            ?>
                        
                    </div>
                </form>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" class="sign-up-form" method="post">
                    <!-- <img src="../Images/avatar.svg" class="avatar" alt="" /> -->
                    <h2 class="title">Sign Up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="pass" placeholder="Password" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="cpass" placeholder="Confirm Password" />
                    </div>
                    <input type="submit" class="btn" value="Sign Up" />
                    <p class="social-text"><span>
                            <center>Or</center>
                        </span><span>sign up with GOOGLE</span></p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <!--<i class="fab fa-google"></i>-->
                            <img src="../Images/google.png" height="40px" width="40px">
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Don't have an account ?</h3>
                    <p>
                       Welcome to online Discussion forum of PICT.
                       Don't have account Register as a new user
                    </p>
                    <button class="btn transparent" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="../Images/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Already have an account ?</h3>
                    <p>
                    Welcome to online Discussion forum of PICT.
                       Already have account Login to our website.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">Login In</button>
                </div>
                <img src="../Images/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>
    <footer>
        <div class="center">
            <!-- Copyright &copy; www.pictdiscussionforum.com reserved -->
            ©2021 2A92021 All Rights Reserved
        </div>
    </footer>
    <script src="../JS/signin_signup.js"></script>
</body>

</html>