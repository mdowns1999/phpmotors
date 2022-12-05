<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <title>Search</title>
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

    <h1>Search</h1>

    <?php 
    if(isset($errorMessage))
    {
        echo $errorMessage;
    } ?>

    <form id="searchForm" action="/phpmotors/vehicles/index.php" method="post">
            
            <label>What would you like to search for?: <input id="searchValue" name="searchValue" type="text" <?php if(isset($searchValue)){echo "value='$searchValue'";}?> required></label>
            <input class="submit" type="submit" value="Search">
            <input type="hidden" name="action" value="diplaySearchResults">
            <input type="hidden" name="pageNum" value= 1>
    </form>
    <?php if(isset($message)){
        echo $message; }
    ?>

    <?php if(isset($searchResults))
        {
            echo $searchResults;
        }
    ?>

<?php if(isset($pageNumbers))
        {
            echo $pageNumbers;
        }
    ?>







    </main>

    <footer> 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>

</body>

</html>