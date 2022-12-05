<?php
//Check the connection to the database baased of th eusername and password.  
//vWe will then let the user through, if it fails, we will show a error page
function createConnection(){
    $server = 'localhost:3306';
    $dbname= 'phpmotors';
    $username = 'iClient';
    $password = 'PwuzdF_!aZd)E1Ow';
    //$password = 'w.vCOIFf_CVFbTWh';
    $dsn = "mysql:host=$server;dbname=$dbname";

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // Create the actual connection object and assign it to a variable
    try {
     $link = new PDO($dsn, $username, $password, $options);
     return $link;
   //   if(is_object($link))
   //   {
   //      echo "IT worked!";
   //   }
    } catch(PDOException $e) {
   //echo "<h1>Sorry, the connection failed</h1>";
      header('Location: /phpmotors/view/500.php');
      exit;
    }
   }

  createConnection();
?>