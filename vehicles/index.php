<?php

// Create or access a Session.  Here we store values we can use elsewhere in th eprogram for a cetain amount of time.
session_start();

//Get Functions function
require_once "../library/functions.php";

//Get Database Connections
require_once "../library/connections.php";

//Use Php,oters Model
require_once "../model/main-model.php";

//Use Vehicles Model
require_once "../model/vehicles-model.php";

// Get the array of classifications
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

// Build a Drop Down List using the $classifications array
$classificationList = buildClassificationsList($classifications);



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 
 switch ($action) {
    case "addVehiclePage":
    include '../view/addVehicle.php';
    break;

    case 'addVehicle':
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $vehArray = array($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);



        foreach($vehArray as $vehItem)
        {
          //Validate Price
          if($vehItem == $invPrice)
          {
            $vehItem = checkPrice($invPrice);
          }
          //Validate Stock
          else if($vehItem == $invStock)
          {
            $vehItem = checkStock($invStock);
          }
          else if($vehItem = $invColor)
          {
            $vehItem = checkColor($invColor);
          }


            // Check for missing data
            if(empty($vehItem)){
                //.print_r($_REQUEST,true
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/addVehicle.php';
                exit;
            }
        }


              // Send the data to the model
            $regOutcome = regVehicles($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
            
              // Check and report the result
            if($regOutcome === 1){
              $message = "<p>Congrats!  Your info was added to the database</p>";
                include '../view/vehicles-management.php';
                exit;
            } else {
                $message = "<p>Sorry.  The Info was not added to the database</p>";
                include '../view/addVehicle.php';
                exit;
            }
            break;

    case "addClassificationPage":
    include '../view/addClassification.php';
    break;

    case 'addClassification':
        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            // Check for missing data
            if(empty($classificationName) && strlen($classificationName) <= 30){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/addClassification.php';
                exit;
            }

              // Send the data to the model
            $regOutcome = regClassification($classificationName);
            
              // Check and report the result
            if($regOutcome === 1){
                header('Location: index.php');
                exit;
            } else {
                $message = "<p>Sorry.  $classificationName, was not added to classifications.</p>";
                include '../view/addClassification.php';
                exit;
            }
            break;


    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId); 
      // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray); 
      break;

      case 'updateVehicle':

        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    
        $vehArray = array($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
    
    
    
            foreach($vehArray as $vehItem)
            {
              //Validate Price
              if($vehItem == $invPrice)
              {
                $vehItem = checkPrice($invPrice);
              }
              //Validate Stock
              else if($vehItem == $invStock)
              {
                $vehItem = checkStock($invStock);
              }
              else if($vehItem = $invColor)
              {
                $vehItem = checkColor($invColor);
              }
    
    
                // Check for missing data
                if(empty($vehItem)){
                    //.print_r($_REQUEST,true
                    $message = '<p>Please provide information for all empty form fields.</p>';
                    include '../view/addVehicle.php';
                    exit;
                }
            }
    
    
                // Send the data to the model
                $updateResult = updateVehicles($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
                
                  // Check and report the result
                  if ($updateResult) {
                    $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /phpmotors/vehicles/');
                    exit;
                  } else {
                    $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";;
                    include '../view/updateVehicle.php';
                    exit;
                }
                break;




    case 'deleteVehicle':
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
  
              // Send the data to the model
              $deleteResult = deleteVehicles($invId);
              
              if ($deleteResult) {
                $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
              } else {
                $message = "<p class='notice'>Error: $invMake $invModel was not
              deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
              }
              break;




     //Modify Vehicle       
    case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/updateVehicle.php';
        exit;
      break;

    case 'del':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if (count($invInfo) < 1) {
          $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/deleteVehicle.php';
        exit;
        break;



      case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);

        if(!count($vehicles)){
          $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
          } else {
           $vehicleDisplay = buildVehiclesDisplay($vehicles);
          }


          include '../view/classification.php';
          break;


        case 'displayVehicle':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invInfo = getInvItemInfo($invId);
        
        if(!isset($invInfo)){
          $message = "<p class='notice'>Sorry, the vehicle could not be found.</p>";
          } else{
            $displayVehicle = buildSingleVehiclesDisplay($invInfo);
          }


          include '../view/vehicle-detail.php';
          break;


    case "searchVehicles":
      include '../view/searchPage.php';
        break;


    case "diplaySearchResults":
      $searchValue = $_POST['searchValue'];
      $searchValue = strip_tags($searchValue);
      $searchValue = trim(filter_var($searchValue, FILTER_SANITIZE_SPECIAL_CHARS));
      //$searchValue = filter_var($searchItem, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $pageNum = trim(filter_input(INPUT_POST, 'pageNum', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $startIndex = (10 * intval($pageNum)) - 10;
      var_dump($pageNum);

      // Check for missing data
      if(empty($searchValue)){
        $errorMessage = '<p class="notice">Please provide a value to search.</p>';
        include '../view/searchPage.php';
        exit;
    }

      $invInfo = searchVehicleInfo($searchValue);
      $invInfoCount = countSearchVehicleInfo($searchValue);

    //<script>alert('hacked');</script>
      if(!count($invInfo)){
        $message =  
        "<div>
        <h1> Returned $invInfoCount results for: $searchValue</h1>
        <p class='notice'>Sorry, no results could be found.</p>
        </div>";

        } else {
        $_SESSION['results'] = $invInfo;
        $message = "<h1> Returned $invInfoCount results for: $searchValue</h1>";
         //$searchResults = buildSearchDisplay($invInfo);
         $searchResults = buildSearchDisplay(array_slice($invInfo, $startIndex, 10, true));
         $pageNumbers = buildSearchNumbers($invInfo, intval($pageNum), $searchValue);
        }

      include '../view/searchPage.php';
      break;

      case "nextPage":
        //$results = $_SESSION['results'];
        
       $searchValue = trim(filter_input(INPUT_GET, 'searchValue', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       $pageNum = trim(filter_input(INPUT_GET, 'pageNum', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       $startIndex = (10 * intval($pageNum)) - 10;

        $results = $_SESSION['results'];
        
         $searchResults = buildSearchDisplay(array_slice($results, $startIndex, 10, true));
         $pageNumbers = buildSearchNumbers($results, $pageNum, $searchValue);

         include '../view/searchPage.php';
        break;

    default:

    $classificationList = buildClassificationsList($classifications);

    include '../view/vehicles-management.php';
    break;
  }


?>