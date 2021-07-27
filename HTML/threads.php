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
    <title>Discussion Forum | questions</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<style>
#submit:hover {
    border-radius: 5px;
    border: 2px solid var(--clr-primary-1);
    font-size: 1rem;

    color: var(--clr-primary-1);

    background-color: transparent;
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
footer {
    clear: both;
    position: relative;
    margin-top: 140px;
}
</style>
<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
$url = $_SERVER['REQUEST_URI']; 
if ($url == "/Project/HTML/thread.php") {
  $_GET['subid'] = 0;
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
  $subid = $_GET['subid'];
  $subsql = "SELECT * FROM `subforum` WHERE `sub_id` = $subid";
  $result1 = mysqli_query($conn,$subsql);
  $subrow = mysqli_fetch_assoc($result1);
  //echo var_dump($_POST);
  if ($_SERVER['REQUEST_METHOD']== 'POST') {
    // after submitting question form
    $thread = $_POST['title'];
    $tag = $_POST['Tags'];
    $desc = $_POST['description'];
    $insert = 0;
    if ($_FILES['filename']['error'] != 4 ) {
        $img_name = $_FILES['filename']['name'];
        $img_size = $_FILES['filename']['size'];
        $tmp_name = $_FILES['filename']['tmp_name'];
        $error = $_FILES['filename']['error'];

        if ($error === 0) {
            if ($img_size > 125000000) {
                $em = "Sorry, your file is too large.";
                header("Location: error.php?error=$em");
                exit();
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = '/Applications/XAMPP/xamppfiles/htdocs/Project/HTML/threads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $insert = 1;
                    // header("Location: view.php");
                }else {
                    $em = "You can't upload files of this type only jpg jpeg and png are allowed";
                    header("Location: error.php?error=$em");
                }
            }
        }else {
            $em = "unknown error occurred!";
            header("Location: error.php?error=$em");
        }
    }
    if ($_FILES['filename']['error'] == 4 or $insert == 1) {
    
    $sql = "INSERT INTO `threads` (`sub_id`, `thread`, `thread_desc`, `tag_id`, `user_id`, `timestamp`) VALUES ('$subid', '$thread', '$desc','0', '$uid', current_timestamp())";
    $result = mysqli_query($conn,$sql);

    $sqla = "SELECT * FROM `threads`ORDER BY timestamp DESC";
    $resulta = mysqli_query($conn,$sqla);
    $rowa = mysqli_fetch_assoc($resulta);
    $thid = $rowa['thread_id'];
   if ($insert == 1) {
        // Insert into Database  or 
        $sql = "INSERT INTO `images` (`content_id`, `image_url`, `timestamp`) VALUES ('$thid', '$new_img_name', current_timestamp())";
        $re = mysqli_query($conn, $sql);
   }
      
    // if statement
    $sqle = "SELECT * FROM `tags` WHERE `tag_name` = '$tag'";
    $resulte = mysqli_query($conn,$sqle);
    if ($resulte == true) {
        $sqlb = "INSERT INTO `tags` (`thread_id`,`tag_name`, `timestamp`) VALUES ('$thid','$tag', current_timestamp())";
        $resultb = mysqli_query($conn,$sqlb);

        $sqlc = "SELECT * FROM `tags` ORDER BY timestamp DESC";
        $resultc = mysqli_query($conn,$sqlc);
        $rowc = mysqli_fetch_assoc($resultc);
        $tagid = $rowc['tag_id'];
    }
    else {
        $rowe = mysqli_fetch_assoc($resulte);
        $tagid = $rowe['tag_id'];
    }

    $sqld = "UPDATE `threads` SET `tag_id` = '$tagid' WHERE `threads`.`thread_id` = $thid";
    $resultd = mysqli_query($conn,$sqld);
    if ($result) {
        $none = "'none'";
      echo '<div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='.$none.';">&times;</span>
      <div><span  style="font-size:18px;margin:15px"><strong><i class="far fa-check-circle"></i> Success!</strong> Your question is submitted successfully.</span></div>
    </div>'; // { alert box for data submission }
    }
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
                    <li class="nav-items"><a href="/Project/HTML/home.php">Home</a></li>
                    <li class="nav-items"><a href="/Project/HTML/subforum.php?yr=<?php echo $uid[0];?>">Subforum</a>
                    </li>
                    <li class="nav-items"><a href="/Project/HTML/profile.php?profileid=<?php echo $uid;?>">Profile</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div style="padding-top:2px">
        <hr>
        <center>
            <h4 style="padding-top:12px;padding-bottom:-20px">Welcome to <?php echo $subrow['sub_name'];?> forum</h4>
        </center>
        <hr>
    </div>
    <!-- rules and question btn -->
    <section class="buttons clearfix">
        <article class="rules">
            <h3 class="rules__title">Rules to be followed:</h3>
            <ul class="rules__main">
                <li class="rule">
                    No Spam / Advertising / Self-promote in the forums
                </li>
                <li class="rule">Do not post copyright-infringing material</li>
                <li class="rule">Do not post “offensive” posts, links or images</li>
                <li class="rule">Remain respectful of other users at all times</li>
            </ul>
        </article>
        <article class="question">
            <h3 class="question__title">Want to ask a question ?</h3>
            <p>
                Ask your question and the community is here to help you. Before you
                post, search the site to make sure your question hasn’t been answered.
            </p>
            <button class="question__btn modal-open">Ask a question</button>
        </article>
    </section>
    <!-- Question modal -->
    <div class="modal hide">
        <form action="<?php echo $url;?>" class="modal__form" method="POST" enctype="multipart/form-data">
            <button class="modal-close"><i class="fas fa-times"></i></button>
            <label for="title" class="modal__label">Title </label>
            <p>Be specific with question.</p>
            <input type="text" name="title" id="title" placeholder="Title" class="modal__input">
            <label for="tags" class="modal__label">Tags</label>
            <p>Provide tags to describe what your question is about</p>
            <input type="text" name="Tags" id="Tags" placeholder="e.g.( python c++)" class="modal__input" list="tagname" autocomplete="off">
            <datalist id="tagname">
            <?php
            $sql = "SELECT DISTINCT `tag_name` FROM `tags`";
            $result = mysqli_query($conn,$sql);
            while ($row = mysqli_fetch_assoc($result)) {
            $tags = $row['tag_name'];
            echo '<option value="'.$tags.'">';
            }
            ?>
            </datalist>
            <label for="description" class="modal__label">Description</label>
            <p>
                Provide more information on the question so that it helps to answer
                it.
            </p>
            <textarea name="description" id="description" cols="30" rows="8" class="modal__input"
                placeholder="Describe More"></textarea>
            <!-- Add different files -->
            <details style="margin: 10px 10px">
                <summary>Attachment</summary>
                <input type="file" id="myFile" class="myFile" name="filename" value="Upload">
            </details>

            <!-- <a href="sample.php"> -->
            <input id="submit" type="submit" class="modal__input btn" value="Submit"
                style="width: 30%;margin-top: 0.5rem;">
            <!-- class=" modal__submit btn" -->
            <!-- </a> -->
        </form>
    </div>
    <!-- Overlay -->
    <div class="overlay hide"></div>
    <!-- Posted Question Table -->
    <div class="post_container">
        <table id="myTable" class="post section">
            <thead class="post__table">
                <tr class="post__head">
                    <th class="upvotes" style="margin-left:-1px">Sr No.</th>
                    <th class="questions">Question</th>
                    <th class="replies">Reply</th>
                    <th class="last-replies">Last Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php
          // display results query
          $count = 0;
          $num = 0;
          $sql = "SELECT * FROM `threads` WHERE `sub_id` = $subid";
          $result = mysqli_query($conn,$sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $num+=1;
            $thid = $row['thread_id'];
            $count+=1;
            $user = $row['user_id'];
            $query = "SELECT * FROM `users` WHERE `Id` = $user";
            $res = mysqli_query($conn,$query);
            $asker = mysqli_fetch_assoc($res);
            if ($asker['username'] == $name) {
               $nam = "You";
            }
            else {
                $nam = $asker['username'];
            }
             $commentquery = "SELECT * FROM `comments` WHERE `thread_id` = $thid ORDER BY `timestamp` DESC";
             $resultofcommentquery = mysqli_query($conn,$commentquery);
             $com =  mysqli_num_rows($resultofcommentquery);// biggest trap of project is here
             // echo $com; to check this trap
             if ($com == null) {
                $com = 0;
             }
             else {
            $data = mysqli_fetch_assoc($resultofcommentquery);
            $com = mysqli_num_rows($resultofcommentquery);
            $userid = $data['user_id'];
            $time = $data['timestamp'];
            $tim = substr($time,0,-8);
            $year = $tim[0].$time[1].$tim[2].$tim[3];
            $month = $tim[5].$tim[6];
            $date = $tim[8].$tim[9];
            $dt = DateTime::createFromFormat('!m', $month);
            $monthname =  $dt->format('F');
            $quer = "SELECT * FROM `users` WHERE `Id` = $userid";
            $resu = mysqli_query($conn,$quer);
            $aske = mysqli_fetch_assoc($resu);
            if ($aske['username'] == $name) {
               $nami = "You";
            }
            else {
                $nami = $aske['username'];
            }
             }
            
            echo '<!-- Start of a row -->
            <tr class="post__row">
              <th class="upvote">';
        //  <button class="upvote--btn" id="upvote--btn">
        //           <i class="fas fa-arrow-up"></i></button>
        //         <span class="upvote--count">0</span>
        echo $num;
             echo  '</th>
              <th class="question_">
                <a href="comments.php?threadid='.$row['thread_id'].'">'.$row['thread'].' </a>
                <br />
                by <a href="/Project/HTML/profile.php?profileid='.$user.'">'.$nam.'</a>
              </th>
              <th class="reply">'."$com";
            if ($com == 1) {
             echo ' reply';
             } else {
                  echo ' replies';
              }
              echo '</th>';
              if($com == 0){
              echo'
              <th class="last-reply">
              no comment yet
              </th>';}
              else {
                echo'
                <th class="last-reply">
                Last reply on <br>'.
                $date.' '.$monthname.' <br />
                  by <a href="/Project/HTML/profile.php?profileid='.$userid.'">'.$nami.'</a>
                </th>';
              }
              echo '
            </tr>
            <!-- End of a row -->';
          }
          ?>
            </tbody>
        </table>
    </div>

    <!-- footer -->
    <?php
    if ($count<2) {
        echo '<div style="min-height:130px"></div>';
    }
    elseif ($count<3) {
        echo '<div style="min-height:65px"></div>';
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
        <div class="footer__text">
            &copy;<span id="date"></span> 2A92021 All Rights Reserved
        </div>
    </footer>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Database script -->
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#myTable").DataTable();
    });
    $.extend($.fn.dataTable.defaults, {
        // searching: false,
        autofill: true,
        ordering: false,
    });
    </script>
</body>

</html>