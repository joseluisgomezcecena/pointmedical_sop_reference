<?php
ob_start();

date_default_timezone_set("America/Tijuana");

$page = isset($_GET['page']) ? $_GET['page'] : "";

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'point_reference_videos';


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$connection){
    die("DB Connection Failed  :(");
}
