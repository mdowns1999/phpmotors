
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
        // if (isset($_SESSION['message'])) {
        //     echo $_SESSION['message'];
        // }
        ?>
        <form id="loginForm" action="/phpmotors/accounts/index.php" method="post">
            <h1>Login Form</h1>
            <label for="clientEmail">Email:<input id="clientEmail" name="clientEmail" type="email" placeholder="example@gmail.com"
            <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required></label>
            
            <div class="passwordInfo">
            Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character
            </div>

            <label for="password">Password:<input id="password" name="clientPassword" placeholder="Password" type="password" required
            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
            <input type="hidden" name="action" value="login">
            <input class='submit' type="submit" value="Send Message">
        </form>
        <h1 id="signUpLine">No account? <a id ="signUpBtn" href="../accounts/index.php?action=registerform">Sign Up!</a></h1>
    </div>



    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>