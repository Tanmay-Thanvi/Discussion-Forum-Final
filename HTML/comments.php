
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- link to css -->
    <link rel="stylesheet" href="/Project/CSS/thread.css" />
    <!-- link to alert css -->
    <link rel="stylesheet" href="/Project/CSS/alert.css" />

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet" />
    <!-- link to js -->
    <script defer src="/Project/JS/thread.js"></script>
    <!-- link to alert js -->
    <script defer src="/Project/JS/alert.js"></script>

    <title>Discussion Forum | Comments</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<style>
  .threadview{
    color:black;
  }
  .threadview:hover{
    color: #90E0EF;
  }
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
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
footer {
    clear: both;
    position: relative;
    margin-top: 100px;
}
</style>
<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors

$url = $_SERVER['REQUEST_URI'];
if ($url == "/Project/HTML/comment.php") {
  $_GET['threadid'] = 0;
}
$threadid = $_GET['threadid'];
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
  if ($_SERVER['REQUEST_METHOD']== 'POST') {
  $comment = $_POST['comment'];
  $com = "INSERT INTO `comments` (`thread_id`, `comment`, `user_id`, `timestamp`) VALUES ('$threadid','$comment', '$uid', current_timestamp());";
  $resu = mysqli_query($conn,$com);
  if ($resu) {
    // show success alert
    $none = "'none'";
    echo '<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='.$none.';">&times;</span>
    <div><span  style="font-size:18px;margin:15px"><strong><i class="far fa-check-circle"></i> Success!</strong> Your response is submitted successfully.</span></div>
  </div>'; // { alert box for data submission }
  }
  }
?>
<body>
    <header class="header">
        <!-- Navbar -->
        <nav>
            <div class="container">
                <div class="nav-toggle nav-btn">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="logo">Discussion Forum</div>
                <ul class="nav-list">
                    <li class="nav-items"><a href="home.php">Home</a></li>
                    <li class="nav-items"><a href="threads.php?subid=<?php
                    $sql = "SELECT * FROM `threads` WHERE `thread_id` = $threadid";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                     echo $row['sub_id'];
                     ?>">Questions</a></li>
                    <li class="nav-items"><a href="/Project/HTML/profile.php?profileid=<?php echo $uid;?>">Profile</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Content of the thread page -->
    <?php

    $sql = "SELECT * FROM `threads` WHERE `thread_id` = $threadid";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $user = $row['user_id'];
    $tagid = $row['tag_id'];
    $query = "SELECT * FROM `users` WHERE `Id` = $user";
    $res = mysqli_query($conn,$query);
    $asker = mysqli_fetch_assoc($res);
    if ($asker['username'] == $name) {
         $nam = "You";
    }
    else {
           $nam = $asker['username'];
     }
    $time = $row['timestamp'];
    $tim = substr($time,0,-8);
    $year = $tim[0].$time[1].$tim[2].$tim[3];
    $month = $tim[5].$tim[6];
    $date = $tim[8].$tim[9];
    $dt = DateTime::createFromFormat('!m', $month);
    $monthname =  $dt->format('F');
    $sqle = "SELECT * FROM `tags` WHERE `tag_id` = $tagid";
    $resulte = mysqli_query($conn,$sqle); 
    $tag = mysqli_fetch_assoc($resulte);
    $tagname = $tag['tag_name'];
    $sql = "SELECT * FROM `images` WHERE `content_id` = $threadid ";
    $re = mysqli_query($conn,  $sql);
    if (mysqli_num_rows($re) > 0) {
      $rowimage = mysqli_fetch_assoc($re);
    }
    echo '
    <div class="thread_container">
      <div class="head">
        <div class="author">Author</div>
        <!--here we will have name of the subform  -->
        <div class="content">Topic: PHP</div>
      </div>
      <div class="body">
        <div class="author">
          <div class="user"><a href="/Project/HTML/profile.php?profileid='.$user.'">'.$nam.'</a></div>
          <div class="user__info">
            Posted on <br />
            '.$date.' '.$monthname.'
          </div>
        </div>
        <div class="content">
          <a href="threads.php?subid='.$row['sub_id'].'" class="threadview">'.$row['thread'].'</a>
          <br />
          '.$row['thread_desc'].'
          <br />
          <br />

          <hr
            style="
              height: 2px;
              border-width: 0;
              color: #0077b6;
              background-color: #0077b6;
            "
          />
          <div class="tags" style="margin-bottom:10px">'.$tagname.'</div><br>'; // add tag here

          echo '<details style="margin: 10px 10px">
          <summary>Attachment</summary>';
          if (mysqli_num_rows($re) > 0) {
            echo '<div><img src="threads/'.$rowimage['image_url'].'" id="myImg" style="width:100px;height:100px"></div>
            <!-- The Modal -->
            <div id="myModal" class="modal">
              <span class="close">&times;</span>
              <img class="modal-content" id="img01">
              <div id="caption"></div>
            </div>
            
            <script>
            // Get the modal
            var modal = document.getElementById("myModal");
            
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById("myImg");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
              modal.style.display = "block";
              modalImg.src = this.src;
              captionText.innerHTML = this.alt;
            }
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() { 
              modal.style.display = "none";
            }
            </script>';
          }
          else {
            echo 'No Attachment found';
          }
          echo "</details>";
          // insert comment query
          echo '
          <div class="comment">
            <button onclick="showComment()" class="btn">Comment</button>
          </div>
        </div>
      </div>
      <div class="comment-area hide">
      <form action="'.$url.'" method="post">
        <textarea name="comment" id="" placeholder="Comment..."></textarea>

        <div class="btns">
          <input type="submit" value="Submit" class="btn" />
          <button class="cancel_btn btn">Cancel</button>
       </form>   
        </div>
      </div>
    </div>';
    ?>
    <!-- Comment container -->
    <div class="comment_container section">
        <div class="head">
            <div class="author">Users</div>

            <div class="content">Comments</div>
        </div>
        <?php
        $count = 0;
        $sql = "SELECT * FROM `comments` WHERE `thread_id` = $threadid";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
        $count+=1;
        $user = $row['user_id'];
        $query = "SELECT * FROM `users` WHERE `Id` = $user";
        $res = mysqli_query($conn,$query);
        $asker = mysqli_fetch_assoc($res);;
        if ($asker['username'] == $name) {
             $nam = "You";
        }
        else {
               $nam = $asker['username'];
         }
         $time = $row['timestamp'];
         $tim = substr($time,0,-8);
            $year = $tim[0].$time[1].$tim[2].$tim[3];
            $month = $tim[5].$tim[6];
            $date = $tim[8].$tim[9];
            $dt = DateTime::createFromFormat('!m', $month);
            $monthname =  $dt->format('F');
        echo '<div class="comment_body">
        <div class="author">
            <div class="user"><a href="/Project/HTML/profile.php?profileid='.$user.'">'.$nam.'</a></div>
            <div class="user__info">
                Commented <br />
                on '.$date.' '.$monthname.'
            </div>
        </div>
        <div class="content">
            <div class="comment_content">
                '.$row['comment'].'
            </div>
        </div>
    </div>';
    
        }
        ?>
        <?php
    if ($count == 0) {
      
     echo' <br><br><div>
     No comments found
     </span>
     </div>';
    }
    ?>
    </div>
    <?php
    if ($count<1) {
        echo '<div style="min-height:120px"; text-align: center;></div>';
    }elseif ($count<2) {
      echo '<div style="min-height:83px"></div>';
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
    <!-- footer -->
    <footer>
        <div class="footer__text">
            &copy;<span id="date"></span> 2A92021 All Rights Reserved
        </div>
    </footer>
    <!-- Keep this element between *** on the page where you want this alert and also don't forget to link css, jss on html file. -->
    <!-- After that when you want an  success alert Just put in echo <script> showAlert(true)</script> and for failure replace by false -->
    <!-- ********************************************************** -->
    <!-- <div class="alert__container">
        <div class="alert__info">
            <h3 id="alert__title">Success</h3>
            <p id="alert__p">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur,
                iste.
            </p>
        </div>
        <div class="alert__button">
            <button class="alert__button--close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>  -->
</body>

</html>