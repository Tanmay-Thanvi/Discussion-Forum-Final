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
    <link rel="stylesheet" href="/Project/CSS/home.css" />
    <title>Discussion Forum || Home</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<script>
function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}
</script>
<style>
#more {
    display: none;
}

#myBtn {
    border: 2px solid black;
    background-color: #0077b6;
    color: black;
    padding: 12px 24px;
    font-size: 16px;
    cursor: pointer;
}

#myBtn {
    font-family: "Poppins", sans-serif;
    border-radius: 30px;
    border-color: transparent;
    color: whitesmoke;
    transition: all .3s ease-in-out;
}

#myBtn:hover {
    border-radius: 35px;
    background: #0077b6;
    color: white;
    box-shadow: 0 5px 15px #003459;
}

.padding {
    padding-left: 2px;
    padding-right: 2px;
}

.line {

    /* Increase this as per requirement 
    padding-bottom: 2px;
    border-bottom-style: solid;
    border-bottom-width: 1.1px;
    width: fit-content;*/
}

.alert {
    font-family: "Poppins", sans-serif;
    padding: 20px;
    background-color: #f54949;
    /* Red */
    color: white;
    margin-bottom: 0.5px;
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
</style>

<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
$url = $_SERVER['REQUEST_URI']; 
if ($url == "/Project/HTML/home.php") {
  $_GET['alert'] = 0;
}
include "subfiles/_dbconnect.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
 header("location: signin_signup.php");
  exit;
}
  $uid = $_SESSION['id'];
  $sql = "SELECT * FROM `users` WHERE `Id` = $uid";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['username'];
  $alert = $_GET["alert"]; 
  if ($alert == 1) {
      $none = "'none'";
    echo '<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='.$none.';">&times;</span>
    <p>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/White_alert_icon.svg/2560px-White_alert_icon.svg.png" width="20px" height="15px"> You dont have access to this forum.</p>
  </div>'; // use alert box here
  }
  $sqla = "SELECT * FROM `users`";
  $resulta = mysqli_query($conn,$sqla);
  $numa = mysqli_num_rows($resulta);
  $sqlb = "SELECT * FROM `threads`";
  $resultb = mysqli_query($conn,$sqlb);
  $numb = mysqli_num_rows($resultb);
  $sqlc = "SELECT * FROM `subforum`";
  $resultc = mysqli_query($conn,$sqlc);
  $numc = mysqli_num_rows($resultc);
  $sqld = "SELECT * FROM `comments`";
  $resultd = mysqli_query($conn,$sqld);
  $numd = mysqli_num_rows($resultd);
?>

<body>
    <nav>
        <input type="checkbox" id="check" />
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">
            <a href="../HTML/home.php"> DISCUSSION FORUM </a>
        </label>
        <ul>
            <li><a class="active" href="../HTML/home.php">Home</a></li>
            <li><a href="team.php"> Our Team</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="/Project/HTML/profile.php?profileid=<?php echo $uid; ?>">Welcome, <span class=" padding"><span
                            class="line"><?php echo $name; ?></span></span></a>
            </li>
        </ul>
    </nav>
    <div class="welcome center">
        <h1>Welcome To The Discussion Forum</h1>
        <p class="center" style="padding:0rem 5rem">
            As seen in this day and age, many
            students face problems with respect to clarification of doubts in their
            curriculum even if it is in college, that is offline, or online mode.


            It becomes difficult for faculties to solve doubts of every student
            separately in that short time span. Various reasons prevent students
            from asking their doubts such as lack of self esteem or overestimating
            their understanding during the time of learning, or even unavailability
            of proper resources.<span id="dots">...</span> <br /><br /><span id="more"> We, therefore, propose a website
                named ‘Online
                Discussion Forum' which will enhance the knowledge of students/users by
                sharing their doubts and views on this platform by having discussions
                with other users. This process will also be less time consuming .
                <br /><br />
                The main purpose of this website is to develop a one roof platform for
                the effective interaction, exposure for the students and a right
                direction toward communication.<br><br>
            </span>
            <button onclick="myFunction()" id="myBtn">Read more</button>
        </p>
    </div>
    <?php
    $time = time();
    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="heading">
        <h1>Forum Stats</h1>
    </div>
    <div class="wrapper">
        <div class="outer">
            <div class="card" style="--delay: -1">
                <div class="content">
                    <div class="img"><img src="../Images/avatar.svg" alt="" /></div>
                    <div class="details">
                        <span class="name">Total Users : <?php echo $numa;?></span>
                        <p>Number of members of the FAMILY.</p>
                    </div>
                </div>
                <a href="#">Share</a>
            </div>
            <div class="card" style="--delay: 0">
                <div class="content">
                    <div class="img"><img src="../Images/active.svg" alt="" /></div>
                    <div class="details">
                        <span class="name">Active Users</span>
                        <p>Let's have some chit chat with them.</p>
                    </div>
                </div>
                <a href="users.php">Users</a>
            </div>


            <div class="card" style="--delay: 1">
                <div class="content">
                    <div class="img"><img src="../Images/questions.svg" alt="" /></div>
                    <div class="details">
                        <span class="name">Number of questions : <?php echo $numb;?></span>
                        <p>Let's answer them!!!</p>
                    </div>
                </div>
                <a href="subforum.php?yr=<?php echo $uid[0];?>">Answer</a>
            </div>
            <div class="card" style="--delay: 2">
                <div class="content">
                    <div class="img"><img src="../Images/questions.svg" alt="" /></div>
                    <div class="details">
                        <span class="name">Number of subjects in each forum : <?php echo $numc;?></span>
                        <p>Lets discover them</p>
                    </div>
                </div>
                <a href="subforum.php?yr=<?php echo $uid[0];?>">Lets Go</a>
            </div>
            <div class="card" style="--delay: 2">
                <div class="content">
                    <div class="img"><img src="../Images/questions.svg" alt="" /></div>
                    <div class="details">
                        <span class="name">Number of comments : <?php echo $numd;?></span>
                        <p>Have a look on opinions of others</p>
                    </div>
                </div>
                <a href="#">Lets see</a>
            </div>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM `users` WHERE `Id` = '$uid'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $status = $row["Status"];
    if ($status !== "Other") {
      $yr = $uid[0];
    }
    $alert = false;
    ?>
    <?php
    $sqli = "SELECT * FROM `threads` ORDER BY timestamp DESC";
    $resulti = mysqli_query($conn,$sqli);
    $num = mysqli_num_rows($resulti);
    $rowi = mysqli_fetch_assoc($resulti);
    $id = $rowi['user_id'];
    $sqlj = "SELECT * FROM `users` WHERE `Id` = $id";
   $resultj = mysqli_query($conn,$sqlj);
   $rowj = mysqli_fetch_assoc($resultj);
    $namj = $rowj['username'];
    ?>
    <div class="heading">
        <h1>Forums</h1>
    </div>
    <div class="container">
        <div class="box">
            <div class="info">
                <h1>01</h1>
                <h3>First Year</h3>
                <p>
                    First year students can ask their academic related questions here.
                    <br /><br />
                    <span> Number of questions: <?php echo $num;?> </span>
                    <br />
                    <span> last question by: <a href="profile.php?profileid=<?php echo $id;?>"><?php echo $namj;?></a>
                    </span>
                </p><a class="link" href="
                <?php
                if ($status == "Other") {
                    echo $_SERVER['PHP_SELF']."?alert=1";
                }
                else {
                if ($yr == 1) {
                  
                  echo "/Project/HTML/subforum.php?yr=1";
                }
                else {
                  echo $_SERVER['PHP_SELF']."?alert=1";
                }
                }
                ?>
                ">Lets Go!</a>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <h1>02</h1>
                <h3>Second Year</h3>
                <p>
                    Second year students can ask their academic related questions here.
                    <br /><br />
                    <span> Number of questions: 10 </span>
                    <span> last question by: <a href="#">User</a> </span>
                </p>
                <a class="link" href="
                <?php
                if ($status == "Other") {
                  echo $_SERVER['PHP_SELF']."?alert=1";
                }
                else {
                if ($yr == 2) {
                  echo "/Project/HTML/subforum.php?yr=2";
                }
                else {
                 echo $_SERVER['PHP_SELF']."?alert=1";
                }
                }
                ?>
                ">Lets Go!</a>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <h1>03</h1>
                <h3>Third Year</h3>
                <p>
                    Third year students can ask their academic related questions here.
                    <br /><br />
                    <span> Number of questions: 10 </span>
                    <span> last question by: <a href="#">User</a> </span>
                </p>
                <a class="link" href="
                <?php
                if ($status == "Other") {
                  echo $_SERVER['PHP_SELF']."?alert=1";
                }
                else {
                  if ($yr == 3) {
                    echo "/Project/HTML/subforum.php?yr=3";
                  }
                  else {
                    echo $_SERVER['PHP_SELF']."?alert=1";
                  }
                }
                ?>
                ">Lets Go!</a>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <h1>04</h1>
                <h3>Fourth Year</h3>
                <p>
                    Fourth year students can ask their academic related questions here.
                    <br /><br />
                    <span> Number of questions: 10 </span>
                    <span> last question by: <a href="#">User</a> </span>
                </p>
                <a class="link" href="
                <?php
                // if ($status == "Other") {
                //   echo $_SERVER['PHP_SELF']."?alert=1";
                // }
                // else {
                //   if ($yr == 3) {
                //     echo '<a class="link" href="/Project/HTML/subforum.php?yr=4">Lets Go!</a>';
                //   }
                //   else {
                //     echo $_SERVER['PHP_SELF']."?alert=1";
                //   }
                // }
                if ($status == "Other") {
                    echo $_SERVER['PHP_SELF']."?alert=1";
                  }
                  else {
                    if ($yr == 3) {
                      echo "/Project/HTML/subforum.php?yr=4";
                    }
                    else {
                      echo $_SERVER['PHP_SELF']."?alert=1";
                    }
                  }
                ?>
                ">Lets Go!</a>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <h1>05</h1>
                <h3>General discussion</h3>
                <p>
                    Anyone can discuss about any topic here.
                    <br /><br />
                    <span> Number of questions: 10 </span>
                    <span> last question by: <a href="#">User</a> </span>
                </p>
                <a class="link" href="
                <?php
                  echo "/Project/HTML/subforum.php?yr=gen";
                ?>
                ">
                    Lets Go!</a>
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
        <div class="center">
            <!-- Copyright &copy; www.pictdiscussionforum.com reserved -->
            ©2021 2A92021 All Rights Reserved
        </div>
    </footer>
    <div class="classes"></div>
</body>

</html>