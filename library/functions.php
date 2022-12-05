<?php
//Validate Email
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }

   //This will build the Nav Bar
   function buildNav($classifications)
   {
      $navList = '<ul id="navigation">';
      $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
      foreach ($classifications as $classification) {
      $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
      .urlencode($classification['classificationName']).
      "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
      }
      $navList .= '</ul>';

      return $navList;
   }

   //Build Classification List
   function buildClassificationsList($classifications)
   {
// Build the classifications option list
   $classifList = '<select name="classificationId" id="classificationList">';
   $classifList .= "<option>Choose a Car Classification</option>";
   foreach ($classifications as $classification) {
   $classifList .= "<option value='$classification[classificationId]'";
   if(isset($classificationId)){
   if($classification['classificationId'] === $classificationId){
      $classifList .= ' selected ';
   }
   } elseif(isset($invInfo['classificationId'])){
   if($classification['classificationId'] === $invInfo['classificationId']){
   $classifList .= ' selected ';
   }
   }
   $classifList .= ">$classification[classificationName]</option>";
   }
   $classifList .= '</select>';

      return $classifList;
   }


   //Check Classification
   function checkClassificationName($classificationName)
   {
   $pattern = '/^[a-zA-Z]*$/';
   return preg_match($pattern, $classificationName);
   }

//Check Valid Stock Number
function checkStock($invStock)
{
   //[^\d\.]
   // $pattern = "^[\d]*";
   $pattern = '/^\d+(\.\d+)?$/D';
   return preg_match($pattern, $invStock);
}


// Check For Valid Price
function checkPrice($invPrice)
{
   $pattern = '/^\d+(\.\d+)?$/D';
   return preg_match($pattern, $invPrice);
}


//Check for Valid Color
function checkColor($invColor)
{
   $pattern = "/^[a-zA-Z]+$/";
   return preg_match($pattern, $invColor);
}

   // Build all th edisplays for vehicles
  function buildVehiclesDisplay($vehicles){
   //var_dump($vehicles);
   $dv = '<ul id="inv-display">';
   foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'> ";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>$$vehicle[invPrice]</span>";
     //$dv .= "<a href='/phpmotors/vehicles/index.php?action=displayVehicle&invId=3'>View Vehicle Details</a>";
    $dv .= "<a href='/phpmotors/vehicles/index.php?action=displayVehicle&invId=".$vehicle['invId']."'>View Vehicle Details</a>";
     $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv;
  }


  //Build One Vehicle Display
  function buildSingleVehiclesDisplay($vehicle){
   $dv = '<section id="vehicleDisplayBox">';
    $dv .= "<div id='vehicleImageBox'>";
    $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'> ";
    $dv .= "</div>";
    $dv .= "<div id='vehicleDetailsBox'>";
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<h2>Price:</h2>";
    $dv .= "<span>$$vehicle[invPrice]</span>";
    $dv .= "<h2>Description:</h2>";
    $dv .= "<p>$vehicle[invDescription]</p>";
    $dv .="<p>Miles: $vehicle[invMiles]</p>";
    $dv .="<p>Color: $vehicle[invColor]</p>";
    $dv .= "</div>";
    $dv .= "</section>";
   return $dv;
  }

  function buildSearchDisplay($results){
   $dv = '<ul id="searchDisplay">';
   foreach ($results as $result) {

    $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/index.php?action=displayVehicle&invId=".$result['invId']."'><h2> $result[invYear] $result[invMake] $result[invModel]</h2></a>";
     $dv .= "<p>$result[invDescription]</p>";
     $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv;
  }

//Build Search Page Numbers
  function buildSearchNumbers($results, $pageNum, $searchValue){
   $pageCount = ceil(count($results)/10);
   $nextPage = intval($pageNum) + 1;
   $prevPage = intval($pageNum) - 1;



   $dv = '<ul id="pageNum">';

   //For Page 1
   if($pageNum < $pageCount && $pageNum == 1)
   {
      //echo $pageNum;
      $dv .= '<li>1<li>';
      for($i = 2; $i <= $pageCount; $i++)
      {
         $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$i&searchValue=$searchValue'>$i</a><li>";
      }
      $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$nextPage&searchValue=$searchValue'>>>></a><li>";
   }

   //For Middle Pages
   else if($pageNum < $pageCount && $pageNum > 1)
   {  //echo $pageNum;
      $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$prevPage&searchValue=$searchValue'><<<</a><li>";
      for($i = 1; $i < $pageNum; $i++)
      {
         $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$i&searchValue=$searchValue'>$i</a><li>";
      }
      $dv .= "<li>$pageNum<li>";
      for($i = $pageNum + 1; $i < $pageNum; $i++)
      {
         $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$i&searchValue=$searchValue'>$i</a><li>";
      }

      $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$nextPage&searchValue=$searchValue'>>>></a><li>";
   }

   //For Last Page
   else if($pageNum == $pageCount && $pageNum > 1)
   {
      //echo $pageNum;
      $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$prevPage&searchValue=$searchValue'><<<</a><li>";
      for($i = 1; $i < $pageNum; $i++)
      {
         $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=nextPage&pageNum=$i&searchValue=$searchValue'>$i</a><li>";
      }
      $dv .= "<li>$pageNum<li>";
   }
   

   $dv .= '</ul>';
   return $dv;
  }

?>