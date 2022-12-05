<?php 

// Create or access a Session
session_start();

//Get Functions
require_once "../phpmotors/library/functions.php";

// Get the database connection file
require_once ('../phpmotors/library/connections.php');
// Get the PHP Motors model for use as needed
require_once ('../phpmotors/model/main-model.php');

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array

$navList = buildNav($classifications);

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
   $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 
 switch ($action) {
    case 'management':
    include 'view/vehicles-management.php';
    break;
    default:
     include 'view/home.php';
     break;
   }

?>