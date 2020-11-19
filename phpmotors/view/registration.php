<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
        


        <div id="register_2">
        <h2 id=register_1>Register for an account</h2>
            <!-- div  is for styling purposes only -->
            <p> *Note all fields are required </p> 
            <?php 
            if(isset($message)) { 
                echo $message; 
            }
            ?>

            <form action="/phpmotors/accounts/" method="post" >
                <label >First Name:</label><br>
                <input  type="text" name="clientFirstname"  class="input" id="clientFirstName" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br><br>
                <label >Last name:</label><br>
                <input type="text" class="input" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required><br><br>
                <label >Email:</label><br>
                <input type="email" class="input" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required><br><br>
                <span> The password needs to be 8 characters long, contain at least 1 uppercase character, 1 number and 1 special character</span> <br>
                <label >Password:</label><br>
                <input type="password" class="input" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
                <input type="submit" value="Register" class="register" ><br><br>
                <!--Add the action name - value pair --> 
                <input type="hidden" name="action" value="register"> 

                
            
            </form>

        </div>
    </main>
    <footer id="page_footer">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>