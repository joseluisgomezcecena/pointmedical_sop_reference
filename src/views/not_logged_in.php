<?php
include_once("./src/includes/header.php");
include_once("./src/includes/navbar.php");

if (!empty($page)) {
    switch ($page){

        case "login":
            include ("./src/views/login/login.php");
            break;

        case "all_trainings":
            include ("./src/views/home/homepage.php");
            break;

        case "course":
            include ("./src/views/course/course.php");
            break;

        default:
            include("./src/views/home/homepage.php");
            break;
    }
}else{
    include ("./src/views/home/homepage.php");
}
include_once("./src/includes/footer.php");
