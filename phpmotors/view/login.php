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
    echo "Welcome " . $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?>
</h1>

    <main>
        

        <div id="login_2">
            <!-- div  is for styling purposes only -->
            <h2 id="login_1">Login to your account</h2>

            <?php 
           if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
           }
            ?>

            <form action="/phpmotors/accounts/index.php" method="post">
                <label >Email Address:</label><br>
                <input type="email" class="input" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br><br>
                <label >Password:</label><br>
                <span> The password needs to be 8 characters long, contain at least 1 uppercase character, 1 number and 1 special character</span> <br>
              
                <input type="password" class="input" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
                <input type="submit" name="submit" value="Sign In" id="submit"> <br> <br>
                <input type="hidden" name="action" value="Login">
                <p class="create"> If this is your first time visiting, please create a new account. </p>
                <a class="register" href= "/phpmotors/accounts/?action=registration" > Register </a>
                
            </form>
 
        </div>

       
        
    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>