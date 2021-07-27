<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('44629813496-9so3oiu28vd8v8gtgg727jitjb4bhbch.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('C0DFqiTPK6WBgxQ0ESSyhpsY');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/Project/HTML/signin_signup.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 