<?php

//Sup3rU$er
if ($_SESSION['loggedin'] == TRUE and $_SESSION['clientData']['clientLevel']  < 2) {
    //var_dump($_SESSION['loggedin']); 
    //var_dump($_SESSION['clientData']['clientLevel']); 
    header('Location: /phpmotors');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Delete $invMake $invModel";
            } ?> | PHP Motors</title>
    <link rel="stylesheet" href=" /phpmotors/css/main.css" media="screen">

</head>

<body>

    <header id="page_header">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>

    <nav id="page_nav">
        <!-- <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?> -->
        <?php echo $getnavigation; ?>

    </nav>


    <h1><?php if (isset($invInfo['invMake'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
        } ?> | PHP Motors</h1>
    </h1>
    
    <main>

    <?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
    ?>
        <div class="add">
            <h2> Confirm you want to delete this vehicle. Deleting is not reversable. </h2>

            <form method="post" action="/phpmotors/vehicles/">
                <fieldset>
                    <label for="invMake">Vehicle Make</label> <br>
                    <input type="text" readonly name="invMake" id="invMake" <?php
                                                                            if (isset($invInfo['invMake'])) {
                                                                                echo "value='$invInfo[invMake]'";
                                                                            } ?>><br> <br>

                    <label for="invModel">Vehicle Model</label><br>
                    <input type="text" readonly name="invModel" id="invModel" <?php
                                                                                if (isset($invInfo['invModel'])) {
                                                                                    echo "value='$invInfo[invModel]'";
                                                                                } ?>><br><br>

                    <label for="invDescription">Vehicle Description</label><br>
                    <textarea name="invDescription" readonly id="invDescription"><?php
                                                                                    if (isset($invInfo['invDescription'])) {
                                                                                        echo $invInfo['invDescription'];
                                                                                    }
                                                                                    ?></textarea><br><br>

                    <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                    echo $invInfo['invId'];
                                                                } ?>">




                </fieldset>
            </form>



        </div>

    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>