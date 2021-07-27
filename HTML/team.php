<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- link to team.css -->
    <link rel="stylesheet" href="/Project/CSS/team.css" />
    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet" />
    <!-- link to date.js -->
    <script defer src="/Project/JS/date.js"></script>
    <title>Discussion Forum | Our Team</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<style>
.button {
  border-radius: 4px;
  background-color: #ffffff;
  border: none;
  color: #000000;
  text-align: center;
  font-size: 14px;
  padding: 10px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  border-radius:200px;
  border: 0.5px solid black;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00AB';
  position: absolute;
  opacity: 0;
  top: 0;
  left: -70px;
  transition: 0.5s;
}

.button:hover span {
  padding-left: 20px;
  text-decoration: underline;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
<body>
<button onclick="goBack()" class="button" style="margin-top:20px;margin-left:20px"><span>Go Back</span></button>
<script>
function goBack() {
  window.history.back();
}
</script>

    <div class="page__title section-center">
        <h2 style="margin:0px;">Meet Our Team</h2>
    </div>
    <!-- FRONTEND TEAM -->
    <!-- teams -->
    <section class="section-center teams">
        <div class="clearfix">
            <div class="team-text">
                <h2>Frontend</h2>
                <h4>
                    A front end developer reads a design file and creates a plan to turn
                    that design into valid HTML, CSS, and JavaScript code.
                </h4>
            </div>

            <!-- team1 -->
            <article class="team">
                <div class="img-container-team">
                    <img src="/Project/IMAGES/shubham.jpeg" alt="" class="img-team" />
                </div>
                <div class="team-info">
                    <h3>Shubham Pitale</h3>
                    <p>
                        Shubham has worked on the Frontend by using technologies or
                        languages like Html, Css,JavaScript and jQuery. He has created
                        pages like subforum,question,comment and much more. <br />
                        Roll no : <span>10906</span>
                    </p>
                </div>
            </article>
            <!-- end of team 1 -->
            <!-- team 2-->
            <article class="team">
                <div class="img-container-team">
                    <img src="/Project/IMAGES/sunandan.jpeg" alt="" class="img-team" />
                </div>
                <div class="team-info">
                    <h3>Sunandan Gupta</h3>
                    <p>
                        Sunandan has worked on the Frontend by using technologies or
                        languages like Html, Css and JavaScript. He has worked on pages
                        like sign-up, home, profile and much more. <br />
                        Roll no : <span>10903</span>
                    </p>
                </div>
            </article>
            <!-- end of team 2 -->
        </div>
    </section>
    <!-- end of teams -->
    <!-- BACKEND TEAM-->
    <!-- teams -->
    <section class="section-center teams">
        <div class="clearfix">
            <div class="team-text">
                <h2>Backend</h2>
                <h4>
                    A back-end developer is someone who builds and maintains the
                    technology needed to power the components which enable the
                    user-facing side of the website to exist.
                </h4>
            </div>

            <!-- service1 -->
            <article class="team">
                <div class="img-container-team">
                    <img src="/Project/images/tanmay3.jpeg" alt="" class="img-team" />
                </div>
                <div class="team-info">
                    <h3>Tanmay Thanvi</h3>
                    <p>
                        Tanmay has worked on the Backend by using
                        languages like PHP. He has given Backend to
                        pages like signup-login, Landing page, subforum and much more. <br />
                        Roll no : <span>10909</span>
                    </p>
                </div>
            </article>
            <!-- end ofteam 1 -->
            <!--team 2-->
            <article class="team">
                <div class="img-container-team">
                    <img src="/Project/images/tanvi.jpeg" alt="" class="img-team" />
                </div>
                <div class="team-info">
                    <h3>Tanvi Khare</h3>
                    <p>
                        Tanvi has worked on the Backend by using
                        languages like PHP. She has given Backend to
                        pages like question, comment and much more. <br />
                        Roll no : <span>10913</span>
                    </p>
                </div>
            </article>
            <!-- end ofteam 2 -->
            <!--team 3-->
            <article class="team">
                <div class="img-container-team">
                    <img src="/Project/images/sejal.jpeg" alt="" class="img-team" />
                </div>
                <div class="team-info">
                    <h3>Sejal Khilari</h3>
                    <p>
                        Sejal has worked as researcher as well Backend developer in PHP.Her research work like working
                        with API's and using Ajax
                        proved one of the best part in webpages.<br />
                        Roll no : <span>10914</span>
                    </p>
                </div>
            </article>
            <!-- end ofteam 3-->
        </div>
    </section>
    <!-- end of teams -->
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
</body>

</html>