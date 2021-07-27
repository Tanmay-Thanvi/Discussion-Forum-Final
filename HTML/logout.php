<?php
require "subfiles/_dbconnect.php";
error_reporting(E_ALL); 
ini_set('display_errors','1'); // used to show errors
// logiut using sessions
session_start();
session_unset();
session_destroy();
if ($_SERVER['REQUEST_METHOD']== 'POST') {
$feedback = $_POST['comment'];
$rating = $_POST['rating'];
$sql = "INSERT INTO `feedbacks` (`rating`, `feedback`) VALUES ('$rating', '$feedback')";
$result = mysqli_query($conn,$sql);
if ($result) {
  // alert box
  echo '
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Thank you!</strong> your Feedback submitted successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  ';
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link to loggedout.css -->
    <link rel="stylesheet" href="/Project/CSS/loggedout.css" />
    <!-- Poppins -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap"
      rel="stylesheet"
    />
    <!-- link to date js -->
    <script defer src="/Project/JS/date.js"></script>
    <title>Discussion Forum | Logout</title>
  </head>
  <body>
    <!-- Main content of the page -->
    <div class="main">
      <!-- Start of the image division -->
      <article class="main__img">
        <img src="/Project/IMAGES/imgLogout.jpg" alt="" />
      </article>
      <!-- End of the image division -->
      <!-- Start of the image division -->
      <article class="logout section-center">
        <h2>You have successfully logged out</h2>

        <h4>Still have some questions?</h4>
       <div style="padding:10px;"> <a href="signin_signup.php"> <button class="signin__btn">Sign In</button></a> </div>
        <div class="logout__divider"></div>
        <h3>or</h3>
        <h4>
          Please help us improve our website by giving us feedback. For feedback
          scroll down and fill the form. Thankyou.
        </h4>
      </article>
      <!-- End of the image division -->
    </div>
    <!-- End of the main content of the page -->
    <div class="divider"></div>
    <!-- Start of the feedback division  -->
    <div class="feedback">
      <!-- Start of the feedback__img -->
      <article class="feedback__img">
        <img src="/Project/IMAGES/thankyou.jpg" alt="" />
      </article>
      <!-- End of the feeback img -->
      <!-- Start of the feedback form -->
      <article class="feedback__form section-center">
        <h2>Feedback</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <h4>How was your experience with our website?</h4>
          <input type="radio" id="bad" name="rating" value="Bad" />
          <label for="bad">Bad</label><br />
          <input type="radio" id="good" name="rating" value="good" />
          <label for="good">Good</label><br />
          <input type="radio" id="very good" name="rating" value="very good" />
          <label for="very good">Very Good</label>
          <br />
          <input type="radio" id="excellent" name="rating" value="excellent" />
          <label for="excellent">Excellent</label>
          <h4>Please tell us more about your experience</h4>
          <textarea
            name="comment"
            id="comment"
            cols="30"
            rows="8"
            placeholder="We love feedback.Write your comment here ..."
          ></textarea>

          <button type="submit" class="submit__btn">Submit</button>
        </form>
      </article>
      <!-- End of the feedback form -->
    </div>
    <!-- End of the feedback division -->
    <!-- footer -->
    <footer>
      <div class="footer__text">
        &copy;<span id="date"></span> 2A92021 All Rights Reserved
      </div>
    </footer>
  </body>
</html>
<?php
mysqli_close($conn);
?>
