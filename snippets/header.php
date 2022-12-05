<div id="logoImgBox" >
        <img id="pageLogo" src="/phpmotors/images/site/logo.png" alt="PHP Page Logo">

        <div id ="welcomeInfo">
        <?php 
        
        if(!isset($_SESSION["loggedin"]))
        {
                echo "<a id='accountLink' href='/phpmotors/accounts/index.php?action=loginPage'>My Account</a>";
        }
        else
        {
           if(isset($_SESSION['clientData']['clientFirstname']))
           {
           
           echo "<a id= 'adminLink' href='/phpmotors/accounts/'>Welcome, ".$_SESSION['clientData']['clientFirstname']."</a>";
           } 

           echo "<a id='accountLink' href='/phpmotors/accounts/index.php?action=Logout'>Log Out</a>";

           

        }

        echo "<a id='searchLink' href='/phpmotors/vehicles/index.php?action=searchVehicles'> Search</a>";
        ?>

        </div>

</div>