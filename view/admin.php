<?php 
if(!isset($_SESSION["loggedin"]))
{
    header("Location: /phpmotors/index.php");
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <title>Admin Page</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    
    <nav>
        <?php echo $navList; ?>
    </nav>

    </header>

    <main>
    <?php
        if (isset($message)) {
        echo $message;
        }
        ?>
        <?php

        if(isset($_SESSION['clientData']))
            
        {   
            $adminList = "<div id='userAdminBox'>";
            $adminList .= "<h1>User Information </h1>";
            $adminList .= "<ul id='userAdminInfoList'>";
            $adminList .= "<li> First Name: ".$_SESSION['clientData']['clientFirstname']."</li>";
            $adminList .= "<li> Last Name: ".$_SESSION['clientData']['clientLastname']."</li>";
            $adminList .= "<li> Email: ".$_SESSION['clientData']['clientEmail']."</li>";
            $adminList .= "<li> STATUS: LOGGED IN</li>";
            // $adminList .= "<li> Client Level: ".$_SESSION['clientData']['clientLevel']."</li>";
            $adminList .= "</ul>";
            $adminList .= "</div>";

        }
        //SHow User's info
        echo $adminList;

        //If the Level is greater than 1 then we display a paragraph showing that they have access to add vehicles
        if($_SESSION['clientData']['clientLevel'] > 1)
        {
            echo "<div>
            <h2 id ='adminHead'>Administrative Page to Add Vehicles</h2>
            <p  id ='adminPara'>Click to add Vehicle: <a id='addVehLink' href='/phpmotors/vehicles/'>Edit</a></p>
            </div>";
        }
       
        echo "<p id ='editAccountsLink'>Click to edit our Account: 
        <a id='addVehLink' href='/phpmotors/accounts/index.php?action=updateClientInfo&clientId=".$_SESSION['clientData']['clientId']."'>Edit</a></p>";


        ?>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/library/connections.php';?>
    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>