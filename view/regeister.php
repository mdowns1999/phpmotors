
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <title>Enhancement One</title>
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
        <form id="registrationForm" method="post" action="/phpmotors/accounts/index.php">
            <h1>Registration Form</h1>
            <label for="clientFirstname">First Name:<input id="clientFirstname" name="clientFirstname" placeholder = "John" type="text" 
            <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}?> required></label>
            <label for="clientLastname">Last Name:<input id="clientLastname" name="clientLastname" placeholder="Smith" type="text"
            <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required></label>
            <label for="clientEmail">Email:<input id="clientEmail" name="clientEmail" type="email" placeholder="example@gmail.com" 
            <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required></label>

            <div class="passwordInfo">
            Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character
            </div>
            
            <label for="password">Password:<input id="password" name="clientPassword" placeholder="Password" type="password" 
            required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
            <input class='submit' name="submit" type="submit" value="Register">
            <input type="hidden" name="action" value="register">
        </form>
    </div>


    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>