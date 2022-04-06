<?php
include_once("./src/includes/header.php");
include_once("./src/includes/navbar.php");

switch ($page) {

    case "course":
        include("./src/views/course/course.php");
        break;

    case "dashboard":
        include("./src/views/admin_dashboard/dashboard.php");
        break;

    case "upload_training":
        include("./src/views/admin_dashboard/trainings/upload_training.php");
        break;

    case "edit_training":
        include("./src/views/admin_dashboard/trainings/edit_training.php");
        break;

    case "delete_training":
        include("./src/views/admin_dashboard/trainings/delete_training.php");
        break;

    case "manage_training":
        include("./src/views/admin_dashboard/trainings/manage_trainings.php");
        break;

    case "all_trainings":
        include("./src/views/home/homepage.php");
        break;        

    default:
        include("./src/views/admin_dashboard/dashboard.php");
        break;
}

include_once("./src/includes/footer.php");
