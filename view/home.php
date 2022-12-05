<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;500&display=swap">
    <title>Enhancement One</title>
</head>


<body>
    <!-- <div id="bodyBackground"> -->
    <div id="bodyContainer">
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    
    <nav>
    <!-- require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';  -->
        <?php echo $navList; ?>
    </nav>

    </header>

    <main>
        <h1 id="welcomeHeading" >Welcome to PHP Motors!</h1>
        <div id="welcomeBox">
        <!-- <img id="bfCar" src="/phpmotors/images/vehicles/1982-dmc-delorean" alt="Delorean Car"> -->
            <img id="bfCar" src="/phpmotors/images/vehicles/1982-dmc-delorean.jpg" alt="Delorean Car">
        </div>

        <div id="welcomeBoxInfo">
            <h1>DMC Delorean</h1>
            <p>3 Cup Holders</p>
            <p>Superman Doors</p>
            <p>Fuzzy Dice!</p>
        </div>

        <div id="actionPicBox">
            <img src="/phpmotors/images/site/own_today.png" id="actionPic" alt="Action Pic">
        </div>


        <div id="aboutSection">
            <div id="cardsBox">
                <div id="upgradeBox1">
                    <div id="upgrade1" class="boxDesign">
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
                    </div>
                    <a href="#">Flux Capacitor</a>
                </div>

                <div id="upgradeBox2">
                    <div id="upgrade2" class="boxDesign">
                        <img class = "upgradeImgs" id="flameImg" src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decal">
                    </div>
                    <a href="#">Flame Decals</a>
                </div>

                <div id="upgradeBox3">
                    <div id="upgrade3" class="boxDesign">
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                    </div>
                    <a href="#">Bumper Stickers</a>
                </div>

                <div id="upgradeBox4">
                    <div id="upgrade4" class="boxDesign">
                        <img id="capImg" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Cap">
                    </div>
                    <a href="#">Hub Caps</a>
                </div>
            </div>
            <div id="reviewBox">
                <h2 id="reviewHeading">DMC Delorean Reviews</h2>
                <ul id="reviewsList">
                    <li>"So fast its almost like traveling through time" (4/5)</li>
                    <li>"Coolest ride on the road." (5/5)</li>
                    <li>"I'm feeling Marty Mcfly!" (5/5)</li>
                    <li>"The most futuristic rid of our day" (4/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </div>
        </div>
    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
    </div>
    <!-- </div> -->
</body>
