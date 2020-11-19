<?php
if ($_SESSION['loggedin'] == TRUE and $_SESSION['clientData']['clientLevel']  < 3) {
    //var_dump($_SESSION['loggedin']); 
    //var_dump($_SESSION['clientData']['clientLevel']); 
    header('Location: /phpmotors/index.php');
}

// Build the select list to make it sticky 
$classificationList = getClassifications();
$list = '<select name="classificationId"> ';
foreach ($classificationList as $classificationList) {
    $list .= "<option value=$classificationList[classificationId]";
    if (isset($classificationId)) {
        if ($classificationList['classificationId'] === $classificationId) {
            $list .= ' selected ';
        }
    }

    $list .= ">$classificationList[classificationName]</option>";
}
$classificationName = $classificationList["classificationId"];
$list .= '</select>';
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        <?php if (isset($_SESSION['clientData']))
            echo "Welcome to PHP Motors " . $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?>
    </h1>


    <main>
        <div class="add">
            <h2>Add a Vehicle</h2>


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
                <input type="text" class="input" name="invMake" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                }  ?> required><br><br>
                <label>Model:</label><br>
                <input type="text" class="input" name="invModel" <?php if (isset($invModel)) {
                                                                        echo "value='$invModel'";
                                                                    }  ?> required><br><br>
                <label>Description:</label><br>
                <input type="text" class="input" name="invDescription" <?php if (isset($invDescription)) {
                                                                            echo "value='$invDescription'";
                                                                        }  ?> required><br><br>
                <label>Image Path:</label><br>
                <input type="text" class="input" name="invImage" <?php if (isset($invImage)) {
                                                                        echo "value='$invImage'";
                                                                    }  ?> required><br><br>
                <label>Thumbnail Path:</label><br>
                <input type="text" class="input" name="invThumbnail" <?php if (isset($invThumbnail)) {
                                                                            echo "value='$invThumbnail'";
                                                                        }  ?> required><br><br>
                <label>Price:</label><br>
                <input type="text" class="input" name="invPrice" <?php if (isset($invPrice)) {
                                                                        echo "value='$invPrice'";
                                                                    }  ?> required><br><br>
                <label>Stock:</label><br>
                <input type="text" class="input" name="invStock" <?php if (isset($invStock)) {
                                                                        echo "value='$invStock'";
                                                                    }  ?> required><br><br>
                <label>Color:</label><br>
                <input type="text" class="input" name="invColor" <?php if (isset($invColor)) {
                                                                        echo "value='$invColor'";
                                                                    }  ?> required><br><br>
                <input type="submit" value="Add Vehicle" class="add_vehicle"><br><br>
                <!--Add the action name - value pair -->
                <input type="hidden" name="action" value="add_vehicle">





            </form>


        </div>

    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>