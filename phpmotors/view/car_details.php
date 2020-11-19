<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo [$invMake][$invModel]; ?> vehicles | PHP Motors, Inc.</title>
    <link rel="stylesheet" href=" /phpmotors/css/main.css" media="screen">

</head>

<body>

    <header id="page_header">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>

    <nav id="page_nav">
        <!--<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?> -->
        <?php echo $getnavigation; ?>

    </nav>
    <h1>

        <?php if (isset($_SESSION['clientData']))
            echo "Welcome " . $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?>
    </h1>

    <main>
   
    <h1 class="classification"><?php echo "$carInfo[invModel]"?></h1> 
    <?php if (isset($message)) {
        echo $message;
    }
    ?>
    
 
    <main>
        
<!--Vehicle Display if any vehicles exist -->
<?php if (isset($carDisplay)) {
        echo $carDisplay;
    } ?>


    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>