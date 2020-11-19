<?php
 
//Sup3rU$er
if ($_SESSION['loggedin'] == TRUE and $_SESSION['clientData']['clientLevel']  < 2) {
    //var_dump($_SESSION['loggedin']); 
    //var_dump($_SESSION['clientData']['clientLevel']); 
    header('Location: /phpmotors');
}

// Build the select list to make it sticky 
$classificationList = getClassifications();
$list = '<select name="classificationId"> ';
foreach ($classificationList as $classificationList) {
    $list .= "<option value='$classificationList[classificationId]'";
    if (isset($classificationId)) {
        if ($classificationList['classificationId'] === $classificationId) {
            $list .= ' selected ';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classificationList['classificationId'] === $invInfo['classificationId']) {
            $list .= ' selected ';
        }
    }
    $list .= ">$classificationList[classificationName]</option>";
}
$list .= '</select>';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Modify $invMake $invModel";
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

    <h1 id="title">
        <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
        } ?>
    </h1>


    <main>
    
        <div class="add">
            <h2>Modify a Vehicle</h2>


            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>



            <form action="/phpmotors/vehicles/index.php" method="post">
                <label>Which classification does it belong to : </label><br>
                <?php echo $list ?>
                <br>
                <label>Make:</label><br>
                <input type="text" class="input" name="invMake" required <?php if (isset($invMake)) {
                                                                                echo "value='$invMake'";
                                                                            } elseif (isset($invInfo['invMake'])) {
                                                                                echo "value='$invInfo[invMake]'";
                                                                            } ?>> <br> <br>
                <label>Model:</label><br>
                <input type="text" name="invModel" id="invModel" required <?php if (isset($invModel)) {
                                                                                echo "value='$invModel'";
                                                                            } elseif (isset($invInfo['invModel'])) {
                                                                                echo "value='$invInfo[invModel]'";
                                                                            } ?>> <br><br>
                <label>Description:</label><br><br>
                <textarea name="invDescription" id="invDescription" required> <?php if (isset($invDescription)) {
                                                                                    echo $invDescription;
                                                                                } elseif (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                } ?></textarea><br><br>
                <label>Image Path:</label><br>
                <input type="text" class="input" name="invImage" required <?php if (isset($invImage)) {
                                                                                echo "value='$invImage'";
                                                                            } elseif (isset($invInfo['invImage'])) {
                                                                                echo "value='$invInfo[invImage]'";
                                                                            } ?>> <br> <br>
                <label>Thumbnail Path:</label><br>
                <input type="text" class="input" name="invThumbnail" required <?php if (isset($invThumbnail)) {
                                                                                    echo "value='$invThumbnail'";
                                                                                } elseif (isset($invInfo['invThumbnail'])) {
                                                                                    echo "value='$invInfo[invThumbnail] '";
                                                                                } ?>> <br> <br>
                <label>Price:</label><br>
                <input type="text" class="input" name="invPrice" required <?php if (isset($invPrice)) {
                                                                                echo "value='$invPrice'";
                                                                            } elseif (isset($invInfo['invPrice'])) {
                                                                                echo "value='$invInfo[invPrice]'";
                                                                            } ?>><br> <br>
                <label>Stock:</label><br>
                <input type="text" class="input" name="invStock" required <?php if (isset($invStock)) {
                                                                                echo "value='$invStock'";
                                                                            } elseif (isset($invInfo['invStock'])) {
                                                                                echo "value='$invInfo[invStock]'";
                                                                            } ?>>
                <label>Color:</label><br>
                <input type="text" class="input" name="invColor" required <?php if (isset($invColor)) {
                                                                                echo "value='$invColor'";
                                                                            } elseif (isset($invInfo['invColor'])) {
                                                                                echo "value='$invInfo[invColor]'";
                                                                            } ?>> <br> <br>
                <input type="submit" value="Update Vehicle" class="add_vehicle"><br><br>
                <!--Add the action name - value pair -->
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="
                <?php if (isset($invInfo['invId'])) {
                    echo $invInfo['invId'];
                } elseif (isset($invId)) {
                    echo $invId;
                } ?>">




            </form>


        </div>

    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>