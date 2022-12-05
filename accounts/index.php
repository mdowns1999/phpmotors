<?php 
//Accounts Controller

// Create or access a Session
session_start();


// Get the functions library
require_once '../library/functions.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the database connection file
require_once ('../library/connections.php');
// Get the PHP Motors model for use as needed
require_once ('../model/main-model.php');

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


switch ($action) {
  case 'loginPage':
    include '../view/login.php';
    break;

    case 'Logout':
      // A valid user exists, log them in
      $_SESSION['loggedin'] = FALSE;

      // Destory Session
      session_destroy();

      header("Location: /phpmotors/index.php");
      break;


    case 'login':
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

      //Validate email
      $clientEmail = checkEmail($clientEmail);

      //Validate Password
      $checkPassword = checkPassword($clientPassword);

      if (empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/login.php';
        exit;
      }

      //NEW INFO HERE
      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view
      include '../view/admin.php';
      exit;


    break;

    case 'registerform':
        include '../view/regeister.php';
     break;

     case 'register':
        // Filter and store the data
          $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
          $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        

        //Check for an Exsisting Email
        $exsistingEmail = checkExistingEmail($clientEmail);

        if($exsistingEmail)
        {
          $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
          include '../view/login.php';
          exit;
        }


          //Validate email
          $clientEmail = checkEmail($clientEmail);

          //Validate Password
          $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
          $message = '<p>Please provide information for all empty form fields.</p>';
          include '../view/regeister.php';
          exit;
        }
        
        
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        
        // Check and report the result
        if($regOutcome === 1){
          setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
          $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
          //$_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
          include '../view/login.php';
          header('Location: /phpmotors/accounts/?action=login');
          exit;
        } else {
          $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
          include '../view/regeister.php';
          exit;
        }
        break;


        case "updateClientInfo":
          $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $clientInfo = getclientItemInfo($clientId);
          include '../view/client-update.php';
          break;

        //UPDATE THE ACCOUNT
        case "updateAccount":
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //Check for an Exsisting Email
        $exsistingEmail = checkExistingEmail($clientEmail);

        if($exsistingEmail && !$_SESSION['clientData']['clientEmail'])
        {
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/client-update.php';
        exit;
        }


        //Validate email
        $clientEmail = checkEmail($clientEmail);


        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/client-update.php';
        exit;
        }
        else{
          $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
          $_SESSION['clientData']['clientLastname'] = $clientLastname;
          $_SESSION['clientData']['clientEmail'] = $clientEmail;
        }


        // Send the data to the model
        $regOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);



        // Check and report the result
        if($regOutcome === 1){
        //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        $message = "<p class='notice'>Thanks for Updating your Account</p>";
        //$_SESSION['message'] = "Thanks for Updating your Account";
        include '../view/admin.php';
        //header('Location: /phpmotors/accounts/?action=login');
        exit;
        } else {
        $message = "<p class='notice'>Sorry.  The Update Has failed.  Please try again.</p>";
        include '../view/client-update.php';
        exit;
        }
          break;

         

        case "updatePassword":
          // Filter and store the data
          $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

          //Validate Password
          $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($checkPassword)){
          $message = '<p>Please provide information for all empty form fields.</p>';
          include '../view/client-update.php';
          exit;
        }
        
        
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = updatePassword($hashedPassword, $clientId);
        
        // Check and report the result
        if($regOutcome === 1){
          //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
          
          $message = "<p class='notice'>Thanks for updaing your password.</p>";
          //$_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
          include '../view/admin.php';
          //header('Location: /phpmotors/accounts/?action=login');
          exit;
        } else {
          $message = "<p class='notice'>Sorry, but updating the password failed. Please try again.</p>";
          include '../view/client-update.php';
          exit;
        }
        break;
          break;
  


    case 'newsSignUp':

      if(isset($_SESSION["loggedin"]))
      {

    //Check for an Exsisting Email
    $exsistingEmail = checkExistingEmailNews($_SESSION['clientData']['clientEmail']);

    if($exsistingEmail)
    {
      $message = '<h1 class="notice">That email address already exists.  You might be receving the Newletter already</h1>';
      include '../view/congrats.php';
      exit;
    }

    
    // Send the data to the model
    $regOutcome = regClientNews($_SESSION['clientData']['clientFirstname'], $_SESSION['clientData']['clientLastname'], $_SESSION['clientData']['clientEmail']);
    
    // Check and report the result
    if($regOutcome === 1){

      $message = "<p>Thanks for registering!</p>";
      //$_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      include '../view/congrats.php';
      exit;
    } else {
      $message = "<p>Sorry, but the registration failed. Please try again.</p>";
      include '../view/signUp.php';
      exit;
    }
    break;
      }
      else 
      {
        include '../view/signUp.php';
      }
      break;


    case 'registerNews':
      // Filter and store the data
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

    //Check for an Exsisting Email
    $exsistingEmail = checkExistingEmail($clientEmail);

    if($exsistingEmail)
    {
      $message = '<p class="notice">That email address already exists.  You might be receving the Newletter already</p>';
      include '../view/signUp.php';
      exit;
    }


      //Validate email
      $clientEmail = checkEmail($clientEmail);


    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/signUp.php';
      exit;
    }
    
    // Send the data to the model
    $regOutcome = regClientNews($clientFirstname, $clientLastname, $clientEmail);
    
    // Check and report the result
    if($regOutcome === 1){

      $message = "<p class='notice'>Thanks for registering!</p>";
      //$_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      include '../view/congrats.php';
      exit;
    } else {
      $message = "<p class='notice'>Sorry, but the registration failed. Please try again.</p>";
      include '../view/signUp.php';
      exit;
    }
    break;
    

    default:
      include '../view/admin.php';
      break;
   }
?>