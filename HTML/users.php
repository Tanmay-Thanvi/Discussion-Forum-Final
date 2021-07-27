<?php
error_reporting(E_ALL); ini_set('display_errors','1'); // used to show errors
include "subfiles/_dbconnect.php";
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
 header("location: signin_signup.php");
  exit;
}
  $uid = $_SESSION['id'];
  $sql = "SELECT * FROM `users` WHERE `Id` = $uid";
  $resu = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($resu);
  $name = $row['username'];
  $time = time();
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
    <link rel="stylesheet" href="/Project/CSS/user.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <title>Discussion Forum || Users</title>
    <link rel="stylesheet" href="/Project/table/css/style.css">
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

/* #card {
  padding:10px 20px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);
  max-width: 300px;
  margin: 20px 50px;
  text-align: center;
  font-family: arial;
  transition: all .3s ease-in-out;
  border-radius: 10px;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none; 
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #0C3459;
  border-radius:4px;
  text-align: center;
  cursor: pointer;
  /* width: 100%;*/
/* font-size: 18px;
  transition: all .3s ease-in-out;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
  transition: all .3s ease-in-out;
}

button:hover, a:hover {
transform: scale(0.95)
}
#card:hover {
    opacity: 1.2;
   box-shadow: rgba(0, 0, 0, 0.9) 0px 25px 50px -12px;    transform: scale(1.05); 
    border-radius: 30px;
    /*content: url('#'); make this as dynamic
    */
}

/*.box {
  display: flex;
  align-items: center;
  justify-content: center;
}
img {
    transition: all .6s ease-in-out;
}
img:hover{
    transform: scale(0.9);
} */
</style>

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
            <li><a href="../HTML/home.php" style="color:white">Home</a></li>
            <li><a href="../HTML/team.php" style="color:white">Our Team</a></li>
            <li><a href="../HTML/contact.php" style="color:white">Contact Us</a></li>
            <li><a href="../HTML/profile.php?profileid=<?php echo $uid;?>" style="color:white">Profile</a></li>
        </ul>
    </nav>
    <div style="padding:40px">
        <img src="/Project/images/img-unscreen.gif" height="200px" width="250px" style="padding-bottom:10px;float:right;width: 250px;
/* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
text-align: center;*/">
        <br>
        <h2 style="padding-left:50px">Hi <?php echo $name;?> 👋</h2>
    </div>
    <div style="min-height:600px;display: flex;
  justify-content: center;
  align-items: center;width:100%">
        <!-- <div class="box">
        <div id="card">
            <br>
            <img src="https://www.w3schools.com/w3images/team2.jpg" alt="John" style="width:200px;border-radius:10px">
            <br><br>
            <h2>John Doe</h2>
            <p class="title">First Year student</p>
            <p>Harvard University</p>
            <br>
            <p><button>Contact</button></p><br>
        </div>
        <br>
        <div id="card">
            <br>
            <img src="https://www.w3schools.com/w3images/team2.jpg" alt="John" style="width:200px;border-radius:10px">
            <br><br>
            <h2>John Doe</h2>
            <p class="title">First Year student</p>
            <p>Harvard University</p>
            <br>
            <p><button>Contact</button></p><br>
        </div>
    </div> -->
        <?php
    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    ?>
        <div class="table-wrap">
            <table class="table table-striped" style="border:0.5px solid black;text-align:center">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Student</th>
                        <th>Roll No.</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="user_grid">
                    <?php
                              $i = 1;  
                                while($row = mysqli_fetch_assoc($result)){ 
                                    $status = "Offline";
                                      $class = "danger";
                                     if ($time < $row['last_login']) {
                                         $status = "Online";
                                         $class = "success";
                                     }
                                     if ($status == "Online") {
                                        echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$row['username'].'</td>
                                        <td>'.$row['Id'].'</td>
                                        <td><a href="#" class="btn btn-'.$class.'">'.$status.'</a></td>
                                      </tr>';
                                      $i++;
                                      $_SESSION['active'] = $i;
                                     }
                                }
                                ?>
                </tbody>
            </table>
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

    </div>
    <footer>
        <div class="center">
            <!-- Copyright &copy; www.pictdiscussionforum.com reserved -->
            ©2021 2A92021 All Rights Reserved
        </div>
    </footer>
    <div class="classes"></div>
</body>

</html>