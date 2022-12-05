<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <title>Add Vehicle</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    
    <nav>
        <?php echo $navList; ?> 
    </nav>

    </header>

    <main>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/library/connections.php';?>
    
    <div class="formBox">
        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>
        <form id="loginForm" action="/phpmotors/vehicles/index.php" method="post">
            <h1>Add Vehicle</h1>
            <?php echo $classificationList; ?> 
            <label for="invMake">Make:<input id="invMake" name="invMake" type="text" 
            <?php if(isset($invMake)){ echo "value='$invMake'"; } ?> required></label>

            <label for="invModel">Model:<input id="invModel" name="invModel" type="text" 
            <?php if(isset($invModel)){ echo "value='$invModel'"; } ?> required></label>

            <label for="invDescription">Description:<input id="invDescription" name="invDescription" type="text" 
            <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required></label>


            <label for="invImage">Image:<input id="invImage" name="invImage" type="text" 
            <?php if(isset($invImage)){echo "value='$invImage'";}else{echo "value='/phpmotors/images/no-image.png'";}?> required></label>


            <label for="invThumbnail">Image Thumbnail:<input id="invThumbnail" name="invThumbnail" type="text"
            <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}else{echo "value='/phpmotors/images/no-image.png'";}?> required></label>

            <div class="passwordInfo">
            Have at most two decimal places for the price!
            </div>

            <label for="invPrice">Price:<input id="invPrice" name="invPrice" type="text"  
            required pattern="^\d*\.?\d+$" <?php if(isset($invPrice)){echo "value='$invPrice'";}?>></label>

            <div class="passwordInfo">
            Whole Numbers for Stock
            </div>

            <label for="invStock">Stock:<input id="invStock" name="invStock" type="text" 
            <?php if(isset($invStock)){echo "value='$invStock'";}?> required pattern = "^[\d]*"></label>
                <label for="invColor">Color:<input id="invColor" name="invColor" type="text" 
            <?php if(isset($invColor)){echo "value='$invColor'";}?> required pattern="^[a-zA-Z]+$"></label>

            <input class='submit' type="submit" value="Add Vehicle">
            <input type="hidden" name="action" value="addVehicle">
        </form>
        
    </div>


    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>