<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Update</title>
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
            echo "Welcome " . $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?>
    </h1>

    <main>

        <div class="add">
            <h2>Update Account Information</h2>
 
       
            <?php
            if(isset($message)){ 
                echo $message; 
            }
        

            if (isset($_SESSION['message_1'])) {
                echo $_SESSION['message_1'];
            }
            ?>

            <form action="/phpmotors/accounts/" method="post">
                <label>First Name:</label><br>
                <input type="text" name="clientFirstname" class="input" id="clientFirstName" required <?php if (isset($clientFirstname)) {
                                                                                                            echo "value = '$clientFirstname'";
                                                                                                        }elseif (isset($_SESSION['clientData'])) {
                                                                                                            echo 'value="' . $_SESSION['clientData']['clientFirstname'] .'" ';
                                                                                                        }?>> <br>
                <label>Last name:</label><br>
                <input type="text" name="clientLastname" class="input" id="clientLastname" required <?php if (isset($clientLastname)) {
                                                                                                            echo "value = '$clientLastname'";
                                                                                                        }elseif (isset($_SESSION['clientData'])) {
                                                                                                            echo 'value="' . $_SESSION['clientData']['clientLastname'] .'" ';
                                                                                                        }?>> <br>
                <label>Email:</label><br>
                <input type="email" name="clientEmail" class="input" id="clientEmail" required <?php if (isset($clientEmail)) {
                                                                                                            echo "value = '$clientEmail'";
                                                                                                        }elseif (isset($_SESSION['clientData'])) {
                                                                                                            echo 'value="' . $_SESSION['clientData']['clientEmail'] .'" ';
                                                                                                        }?>> <br>


                <input type="submit" value="Update Information" class="register"><br><br>
                <!--Add the action name - value pair -->
                <input type="hidden" name="action" value="clientUpdate">
                <input type="hidden" name="invId" value="
                <?php if (isset($clientId)) {
                    echo $clientId;
                } elseif (isset($_SESSION['clientData'])) {
                    $_SESSION['clientData']['clientId']; 
                } ?>">



            </form>

        </div>
        <div class="add">
            <form action="/phpmotors/accounts/" method="post">
                <h4> If you need to change your password, you can do that here </h4>
<?php
                if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }?>
                <p> This change can't be undone </p>
                <span> The password needs to be 8 characters long, contain at least 1 uppercase character, 1 number and 1 special character</span> <br>
                <label>Password:</label><br>
                <input type="password" class="input" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$";
               ><br> <br> 
                <input type="submit" value="Change Password" class="register"><br><br>
                <!--Add the action name - value pair -->
                <input type="hidden" name="action" value="password">
                <input type="hidden" name="invId" value="
                <?php if (isset($clientId)) {
                    echo $clientId;
                } elseif (isset($_SESSION['clientData'])) {
                    $_SESSION['clientData']['clientId']; 
                } ?>">


            </form>
        </div>

    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>
<?php unset($_SESSION['message']); ?>