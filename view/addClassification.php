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
    <title>Add Classification</title>
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
        <form id="classForm" action="/phpmotors/vehicles/index.php" method="post">
            <h1>Add Classificaion</h1>
            <label for="classificationName">Classification Name:<input id="classificationName" name="classificationName" type="text" placeholder="SUV" 
            maxlength="30" required></label>

            <p>Classification Names can only be 30 characters long!</p>
            <input class='submit' type="submit" value="Add Classification">
            <input type="hidden" name="action" value="addClassification">
        </form>
    </div>



    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>