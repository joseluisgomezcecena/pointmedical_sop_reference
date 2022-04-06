<?php
require_once("./config/db.php");

require_once("./classes/Login.php");

$login = new Login();

require_once ("./functions/upload.php");

if ($login->isUserLoggedIn() == true) {
    include("./src/views/logged_in.php");
} else {
    include("./src/views/not_logged_in.php");
}
