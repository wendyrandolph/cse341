<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">

</head>

<body>

    <header id="page_header">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    </header>

    <nav id="page_nav">

        <?php echo $getnavigation; ?>

    </nav>




    <main>
        <div class="add_1">
            <h1 class="title">

                <?php if (isset($_SESSION['clientData']))
                    echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname'];
                ?>

            </h1>

      
            <?php
            if (isset($_SESSION['message_1'])) {
                echo  $_SESSION['message_1'];
            }
            ?>

            <h3>
                <?php
                if ($_SESSION['loggedin'] === TRUE) {
                    echo '<p class="login"> You are now logged in. </p>';
                } ?>
            </h3>
                    <ul> 
                        <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
                        <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
                        <li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
            <h4> Account Management</h4>
            <?php
            if (isset($_SESSION['loggedin']) AND ($_SESSION['clientData']['clientLevel'] > 1 ) OR  ($_SESSION['clientData']['clientLevel'] < 3)) {
                
                echo '<p class="vehicles">Use this link to manage your account information.</p>';
                echo '<p class="vehicles"><a  href="/phpmotors/accounts/?action=update" class="vehicles">Update Account</a></p>';
                
            }
            ?>

          
            <?php
             
            if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<h4> Inventory Management</h4>'; 
                echo '<p class="vehicles">Use this link to manage the inventory.</p>';
                echo '<p class="vehicles"><a class="vehicles" href="/phpmotors/vehicles/index.php"> Vehicle Management</a></p>';
                
            }
            ?>
        </div>

    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>

<?php unset($_SESSION['message_1']); ?>