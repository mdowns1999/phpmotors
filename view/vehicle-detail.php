<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <title>Vehicle Details</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    
    <nav>
        <?php echo $navList; ?>
    </nav>

    </header>

    <main>
    <h1 id="vehDescriptionHeading">Vehicle Description:</h1>
        <?php if(isset($message)){
        echo $message; }
        ?>

        <!-- <section id="vehicleDisplayBox"> -->
        <?php if(isset($displayVehicle)){
        echo $displayVehicle;
        } ?>
        <!-- </section> -->


    <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/library/connections.php';?>
    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>

</html>