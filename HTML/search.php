<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link to Css-->
    <link rel="stylesheet" href="/Project/CSS/post.css" />
    <!-- fontawesome icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet" />
    <!-- Databases css -->
    <link rel="stylesheet" href="  //cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    <!-- link to js -->
    <script defer src="/Project/JS/post.js"></script>
    <script defer src="/Project/JS/pagination.js"></script>
    <title>Discussion Forum | Search</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
$url = $_SERVER['REQUEST_URI']; 
if ($url == "/Project/HTML/search.php") {
  $_GET['query'] = '';
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
  $nam = $row['username'];
?>
<style>
    .containerno{
        margin:40px;
        padding : 40px;
    }
    .link{
        color:black;
    }
    .link:hover{
        color: blue;
    }
    #span:hover{
        text-decoration:underline;
    }
    .containe{
        margin-left:80px;
        margin-right:75px;
    }
    .container1{
        margin:40px;
    }
    /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
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
                    <li class="nav-items"><a href="/Project/HTML/home.php">Home</a></li>
                    <li class="nav-items"><a href="/Project/HTML/subforum.php?yr=<?php echo $uid[0];?>">Subforum</a>
                    </li>
                    <li class="nav-items"><a href="/Project/HTML/profile.php?profileid=<?php echo $uid;?>">Profile</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div style="padding-top:2px">
        <center>
            <h4 style="padding-top:12px;padding-bottom:-20px">Welcome to Search page</h4>
        </center>
        <hr>
    </div>
    <br>
    <div class="container2" style="">
        <h4 style="padding-left:30px">Search Results for <em>" <?php echo $_GET["query"];?> "</em></h4>
    </div>


    
<div class="tab container1">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Subforum</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Questions</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Comments</button>
</div>

<div id="London" class="tabcontent container1">
  <h3>Subforum</h3>
  <p><?php
    //ALTER TABLE subforum ADD FULLTEXT(`sub_name`,`sub_descp`)
    $query = $_GET['query'];
    $sql = "SELECT * FROM `subforum` WHERE MATCH (sub_name, sub_descp) against ('$query') ORDER BY `sub_id` ASC";
    $result = mysqli_query($conn,$sql);
    $n = mysqli_num_rows($result);
    if (!$n == 0) {
    echo '<div class="container1">';
    echo $n." search results found<br> <hr>";
    echo '</div>';
}
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['sub_name'];
        $desc = $row["sub_descp"];
        $tid = $row["sub_id"];
       echo '
       <div class="results container1" >
       
       
       '.$no.'. 
   <a href="threads.php?subid='.$tid.'" class="link" >&nbsp;
   <span id="span">
        '.$title.'
        </a>
        </span>
        <p>&nbsp
        &nbsp
        &nbsp
        '.$desc.'
        </p>
   </div><hr class="container1">';
   $no++;
} 
   if ($no == 1) {
       echo '<div class="jumbotron bg-light text-dark m-5 p-4 containerno" style="background-color: #F8F9FA;border:2px">
       <h4 class="display-5">No results found</h4>
       <hr class="my-4">
       <p>Suggestions:
       <ul>
       <li>Make sure that all words are spelled correctly.</li>
       <li>Try different keywords.</li>
       <li>Try more general keywords.</li>
       </ul>
       </p>
   </div>
';
   }
?></p>
</div>

<div id="Paris" class="tabcontent container1">
  <h3>Questions</h3>
  <p><?php
    //ALTER TABLE threads ADD FULLTEXT(`thread`,`thread_desc`)
    $query = $_GET['query'];
    $sql = "SELECT * FROM `threads` WHERE MATCH (thread, thread_desc) against ('$query') ORDER BY `thread_id` ASC";
    $result = mysqli_query($conn,$sql);
    $n = mysqli_num_rows($result);
    if (!$n == 0) {
    echo '<div class="container1">';
    echo $n." search results found<br> <hr>";
    echo '</div>';
}
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread'];
        $desc = $row["thread_desc"];
        $tid = $row["thread_id"];
        $descid = $row['user_id'];
        $sqli = "SELECT * FROM `users` WHERE `Id` = $descid";
        $resulti = mysqli_query($conn,$sqli);
         $row1 = mysqli_fetch_assoc($resulti);
        $name = $row1['username'];
        if ($name == $nam) {
            $name = "You";
         }
         else {
             $name = $row1['username'];
         }
       echo '
       <div class="results container1" >
       <details><summary>
       
       '.$no.'. 
   <a href="comments.php?threadid='.$tid.'" class="link" >&nbsp;
   <span id="span">
        '.$title.'
        </span>
        </a>
        </summary>
        <p>&nbsp
        &nbsp
        &nbsp;
        &nbsp;
        '.$desc.'<br> &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        Asked by ' .$name.'
        </p></details> 
   </div><hr class="container1">';
   $no++;
} 
   if ($no == 1) {
       echo '<div class="jumbotron bg-light text-dark m-5 p-4 containerno" style="background-color: #F8F9FA;">
       <h4 class="display-5">No results found</h4>
       <hr class="my-4">
       <p>Suggestions:
       <ul>
       <li>Make sure that all words are spelled correctly.</li>
       <li>Try different keywords.</li>
       <li>Try more general keywords.</li>
       </ul>
       </p>
   </div>
';
   }
?></p> 
</div>

<div id="Tokyo" class="tabcontent container1">
  <h3>Comments</h3>
  <p><?php
    //ALTER TABLE comments ADD FULLTEXT(`comment`)
    $query = $_GET['query'];
    $sql = "SELECT * FROM `comments` WHERE MATCH (comment) against ('$query') ORDER BY `comment_id` ASC";
    $result = mysqli_query($conn,$sql);
    $n = mysqli_num_rows($result);
    if (!$n == 0) {
    echo '<div class="container1">';
    echo $n." search results found<br> <hr>";
    echo '</div>';
}
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['comment'];
        $tid = $row["thread_id"];
        $descid = $row['user_id'];
        $sql = "SELECT * FROM `users` WHERE `Id` = $descid";
     $result = mysqli_query($conn,$sql);
      $row1 = mysqli_fetch_assoc($result);
     $name = $row1['username'];
     if ($name == $nam) {
        $name = "You";
     }
     else {
         $name = $row1['username'];
     }
       echo '
       <div class="results container1" >
       
       
       '.$no.'. 
   <a href="comments.php?threadid='.$tid.'" class="link">
   <span id="span"> '.$title.' </span>
        
        </a>
        
        <p>&nbsp
        &nbsp
        &nbsp
        Comment by 
        '.$name.'
        </p>
   </div><hr class="container1">';
   $no++;
} 
   if ($no == 1) {
       echo '<div class="jumbotron bg-light text-dark m-5 p-4 containerno" style="background-color: #F8F9FA;border:2px">
       <h4 class="display-5">No results found</h4>
       <hr class="my-4">
       <p>Suggestions:
       <ul>
       <li>Make sure that all words are spelled correctly.</li>
       <li>Try different keywords.</li>
       <li>Try more general keywords.</li>
       </ul>
       </p>
   </div>
';
   }
?></p>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<div style="min-height:350px"></div>
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
        <div class="footer__text">
            &copy;<span id="date"></span> 2A92021 All Rights Reserved
        </div>
    </footer>
</body>

</html>