<?php
if($_SESSION['clientData']['clientLevel'] < 2){
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
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
            <h1><?php if(isset($invInfo['invMake'])){ 
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            <label for="invMake">Make:<input id="invMake" name="invMake" type="text" 
            <?php
            if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>readonly></label>

            <label for="invModel">Model:<input id="invModel" name="invModel" type="text" 
            <?php
            if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> readonly></label>

            <label for="invDescription">Description:<input id="invDescription" name="invDescription" type="text" 
            <?php
            if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
            ?> readonly></label>

            
            <input class='submit' type="submit" value="Delete Vehicle">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){
            echo $invInfo['invId'];} ?>
            ">
        </form>
        
    </div>


    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>