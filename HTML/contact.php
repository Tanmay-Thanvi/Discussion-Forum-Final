<?php
require '../PHPMailer/PHPMailerAutoload.php';
require 'credentials.php';
  $errors=[];
  $errorMessage='';
  if(!empty($_POST)){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['Message'];
    $emailSubject=$_POST['subject'];

    if(empty($name)){
      $errors[]='Name is required';
      $error_name="Please enter your name!";
  }
  if(empty($email)){
    $errors[]='Email is empty';
    $error_Email="Email is required";
}
  else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[]='Email is invalid';
    $error_invalid="Email is invalid";
    
}
if(empty($emailSubject)){
  $errors[]='Subject is required';
  $error_subject= "Subject is required";
}
if(empty($message)){
    $errors[]='Message is empty';
    $error_message='Message is empty';
   
}
if(empty($errors) && isset($_POST['send'])){
    $name=$_POST['name'];
$to=$_POST['email'];
$subject=$_POST['subject'];
$msg=$_POST['Message'];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAILID;                 // SMTP username
$mail->Password = PASSWORD;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom($to);
$mail->addAddress(EMAILID, 'PICT Discussion Forum');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo($to);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $msg;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    $errorMessage= 'Oops,something went wrong.Please try again later';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('location:contact.php?success=1');  //add success alert
}
}
}

if(!empty($_POST)){
    $to=$_POST['email'];
if(isset($_POST['send']) && empty($errors)){
    $name=$_POST['name'];
    $to=$_POST['email'];
    $subject=$_POST['subject'];
    $msg=$_POST['message'];
    
    $mail = new PHPMailer;
    
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = EMAILID;                 // SMTP username
    $mail->Password = PASSWORD;                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    
    $mail->setFrom(EMAILID, 'PICT Discussion Forum');
    $mail->addAddress($to);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo(EMAILID,'PICT Discussion Forum');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Subject = 'Thank you';
    $mail->Body    = "Thank you for visiting our website. We will be in touch shortly.I appreciate your consideration/guidance/help/time.";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if(!$mail->send()) {
        $errorMessage= 'Oops,something went wrong.Please try again later';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        header('location:contact.php?success=1'); 
    }
    }
}
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
    <title>Discussion Forum || Contact Us</title>
    <link rel="stylesheet" href="../CSS/contact.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<style>
     .alert {
font-family: "Poppins", sans-serif;
  padding: 25px;
  background-color: #59C25E; /* Green */
  color: white;
  margin-bottom: 0.5px;
  align-items: center;
  justify-content:center;
  min-height:80px;
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: all 0.6s ease-in-out;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
}
</style>
<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
include "subfiles/_dbconnect.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
 header("location: signin_signup.php");
  exit;
}
  $uid = $_SESSION['id'];
  ?>
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
            <li><a href="../HTML/team.php">About Us</a></li>
            <li><a class="active" href="../HTML/contact.php">Contact Us</a></li>
            <li><a href="../HTML/profile.php?profileid=<?php echo $uid;?>">Profile</a></li>
        </ul>
    </nav>
    <?php
    $url = $_SERVER['REQUEST_URI']; 
    if ($url == "/Project/HTML/contact.php") {
         $_GET['success'] = 0;
      }
    if ($_GET['success'] == 1) {
        $none = "'none'";
        echo '<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='.$none.';">&times;</span>
    <div><span  style="font-size:18px;margin:15px"><strong><i class="far fa-check-circle"></i> Success!</strong> Thank you for your response.</span></div>
  </div>'; // { alert box for data submission }
    }?>
    <div class="heading">
        <h1>We'd love to hear from you</h1>
        <h4>
            For any question, discussion, feedback or anything else feel free to
            contact us.
        </h4>
    </div>


    <div class="main">
        <img src="../Images/contact.svg" alt="photo" />
        <div id="contact">
            <div id="contact-box">
                <form action="contact.php" method="post">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="name" name="name" placeholder="Enter your name" />
                        <p style="color:red"><?php 
              if(isset($error_name)){
                echo $error_name;
              }
              ?>
                        </p>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Email">Email: </label>
                        <input type="email" name="email" placeholder="Enter your Email" />
                        <p style="color:red"><?php 
              if(isset($error_Email)){
                echo $error_Email;
              }
              else if(isset($error_invalid)){
                echo $error_invalid;
              }
              ?>
                        </p>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Subject">Subject: </label>
                        <input type="text" name="subject" placeholder="Enter Subject" />
                        <p style="color:red"><?php 
              if(isset($error_subject)){
                echo $error_subject;
              }
              ?>
                        </p>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea type="text" name="Message" id="message" cols="30" rows="10"
                            placeholder="Type your message here..."></textarea>
                        <p style="color:red"><?php 
              if(isset($error_message)){
                echo $error_message;
              }
              ?>
                        </p>
                    </div>
                    <br>
                    <div id="button">
                        <input type="submit" name="send" value="Send message" class="btn" />
                    </div>
                </form>
               
            </div>
        </div>
    </div>
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