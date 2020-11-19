<?php
if ($_SESSION['loggedin'] == TRUE and $_SESSION['clientData']['clientLevel']  < 2) {
    //var_dump($_SESSION['loggedin']); 
    //var_dump($_SESSION['clientData']['clientLevel']); 
    header('Location: /phpmotors/index.php');
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">

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
        <h2 class="management">Vehicle Management</h2>

        <div class="add_1">
            <a href='../vehicles/index.php/?action=classification'>Add Car Classification</a> <br> <br>

            <a href='../vehicles/index.php/?action=vehicle'> Add a Vehicle </a>

            <?php

            if (isset($classificationList)) {
                echo '<h2>Vehicles By Classification</h2>';
                echo '<p>Choose a classification to see those vehicles</p>';
                echo $classificationList;
            }
            ?>
            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>



        </div>
    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
<script src="../js/inventory.js"></script>

</html>
<?php unset($_SESSION['message']); ?>