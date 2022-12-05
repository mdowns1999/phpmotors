<?php
//Get Connection
require_once('../library/connections.php');

//Add Funtion to add to classication View
function regClassification($classificationName)
{
    //Create Database Connection
    $db = createConnection();

    //The SQL Statement
    $sql = 'INSERT INTO carclassification (classificationName)
    VALUES (:classificationName)';

    //Create the prepared Statement
    $stmt = $db ->prepare($sql);

    //Replace the Placeholders with our actual value
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    //Insert Data
    $stmt->execute();

    //How Many Rows have changed?
    $rowsChanged = $stmt->rowCount();

    //CLose COnnection
    $stmt->closeCursor();

    //Return how many rows changed so we can see if we succeded
    return $rowsChanged;

}

//Add Funtion to add to Vehicle View
function regVehicles($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
    //Create Database Connection
    $db = createConnection();

    //The SQL Statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
    VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';

    //Create the prepared Statement
    $stmt = $db ->prepare($sql);

    //Replace the Placeholders with our actual value
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);


    //Insert Data
    $stmt->execute();

    //How Many Rows have changed?
    $rowsChanged = $stmt->rowCount();

    //CLose COnnection
    $stmt->closeCursor();

    //Return how many rows changed so we can see if we succeded
    return $rowsChanged;
}






// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
    $db = createConnection(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }

   // Get vehicle information by invId
function getInvItemInfo($invId){
 $db = createConnection();
 //$sql = 'SELECT * FROM inventory WHERE invId = :invId';
 //inv.invId, img.imgPath, inv.invMake, inv.invModel, inv.invPrice, inv.invColor, inv.invMiles, inv.invDescription
  $sql = "SELECT * FROM inventory inv JOIN images img ON img.invId = inv.invId WHERE inv.invId = :invId 
  && NOT img.imgPath REGEXP 'tn.jpg$'";
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
 $stmt->execute();
 $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $invInfo;
}
//SELECT inv.invId FROM inventory inv JOIN images img ON img.invId = inv.invId WHERE inv.invId = 2;img.imgPath REGEXP 'tn.jpg$';"

//Get Vehicle based off of search
function getInvInfo(){
    $db = createConnection();
    //$sql = 'SELECT * FROM inventory WHERE invId = :invId';
    //inv.invId, img.imgPath, inv.invMake, inv.invModel, inv.invPrice, inv.invColor, inv.invMiles, inv.invDescription
     $sql = "SELECT * FROM inventory";
    $stmt = $db->prepare($sql);
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }

   //Get Vehicle based off of search
function searchVehicleInfo($searchItem){
    //var_dump($searchItem);
    $searchItem = "%".$searchItem."%";
    $db = createConnection();

    $sql = "SELECT * FROM inventory inv JOIN carclassification class ON class.classificationId = inv.classificationId WHERE inv.invYear LIKE :searchItem
    ||inv.invMake LIKE :searchItem || inv.invModel LIKE :searchItem || inv.invDescription LIKE :searchItem || inv.invPrice LIKE :searchItem || inv.invMiles LIKE :searchItem
    || inv.invColor LIKE :searchItem|| class.classificationName LIKE :searchItem";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchItem', $searchItem, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }

//Get Vehicle based off of search
function countSearchVehicleInfo($searchItem){
    //var_dump($searchItem);
    $db = createConnection();
    $searchItem = "%".$searchItem."%";

    $sql = "SELECT * FROM inventory inv JOIN carclassification class ON class.classificationId = inv.classificationId WHERE inv.invYear LIKE :searchItem
    ||inv.invMake LIKE :searchItem || inv.invModel LIKE :searchItem || inv.invDescription LIKE :searchItem || inv.invPrice LIKE :searchItem || inv.invMiles LIKE :searchItem
    || inv.invColor LIKE :searchItem|| class.classificationName LIKE :searchItem";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchItem', $searchItem, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
   }



//UPDATE THE VEHICLES
function updateVehicles($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{
    //Create Database Connection
    $db = createConnection();

    //The SQL Statement
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';

    //Create the prepared Statement
    $stmt = $db ->prepare($sql);

    //Replace the Placeholders with our actual value
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);


    //Insert Data
    $stmt->execute();

    //How Many Rows have changed?
    $rowsChanged = $stmt->rowCount();

    //CLose COnnection
    $stmt->closeCursor();

    //Return how many rows changed so we can see if we succeded
    return $rowsChanged;
}

//DELETE VEHICLE
function deleteVehicles($invId)
{
    //Create Database Connection
    $db = createConnection();

    //The SQL Statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';

    //Create the prepared Statement
    $stmt = $db ->prepare($sql);

    //Replace the Placeholders with our actual value
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);


    //Insert Data
    $stmt->execute();

    //How Many Rows have changed?
    $rowsChanged = $stmt->rowCount();

    //CLose COnnection
    $stmt->closeCursor();

    //Return how many rows changed so we can see if we succeded
    return $rowsChanged;
}

function getVehiclesByClassification($classificationName){
    $db = createConnection();
    //img.imgPath, inv.invId, inv.invMake, inv.invModel, inv.invPrice
    //$sql = "SELECT * FROM inventory";
     $sql = "SELECT * FROM images img INNER JOIN inventory inv ON inv.invId = img.invId
     WHERE inv.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
     && img.imgPath REGEXP 'tn.jpg$';";


    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }


//    function getVehiclesByClassification($classificationName){
//     $db = createConnection();
//     $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
//     $stmt->execute();
//     $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $vehicles;
//    }
//SELECT img.imgId, inv.invId FROM images img INNER JOIN inventory inv ON inv.invId = img.imgId 
//SELECT img.imgId, inv.invId FROM images img INNER JOIN inventory inv ON inv.invId = img.imgId WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = "Van");
//SELECT img.imgId, inv.invId FROM images img INNER JOIN inventory inv ON inv.invId = img.imgId WHERE inv.classificationId= 2;
//SELECT inv.invId FROM inventory inv WHERE inv.classificationId IN (SELECT car.classificationId FROM carclassification car WHERE car.classificationName = "SUV");
//SELECT img.imgId, inv.invId FROM images img INNER JOIN inventory inv ON inv.invId = img.imgId WHERE inv.classificationId IN (SELECT car.classificationId FROM carclassification car WHERE car.classificationName = "SUV");

//SELECT img.imgId, inv.invId FROM images img INNER JOIN inventory inv ON inv.invId = img.invId WHERE inv.classificationId IN (SELECT car.classificationId FROM carclassification car WHERE car.classificationName = "Classic");


   // Get images information by invId
//    function getimagesInfo($invId){
//     var_dump($invId);
//     $db = createConnection();
//     $sql = 'SELECT * FROM images WHERE invId = :invId';
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
//     $stmt->execute();
//     $imgInfo = $stmt->fetch(PDO::FETCH_ASSOC);
//     $stmt->closeCursor();
//     return $imgInfo;
//    }

   //SELECT img.imgId inv.invId FROM images img INNER JOIN inventory inv ON inv.invId = img.imgId;
   //SELECT inv.invId FROM inventory inv;
   



?>