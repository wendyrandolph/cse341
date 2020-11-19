<?php
if(!$_SESSION['loggedin'] == TRUE AND $_SESSION['clientData']['clientLevel']  < 3 ){ 
   //var_dump($_SESSION['loggedin']); 
   //var_dump($_SESSION['clientData']['clientLevel']); 
   header('Location: /phpmotors/index.php');
 } ?><!DOCTYPE html>
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
            <h2>Add a Car Classification</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form class="add" action="/phpmotors/vehicles/index.php" method="post">
                <label>Classification Name:</label><br>
                <input name="classificationName" class="classificationName" required><br><br>
                <input type="submit" class="classificationName" value="Add a Classification"><br><br>

                <!--Add the action name - value pair -->
                <input type="hidden" name="action" value="addClass">
            </form>
        </div>
    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>