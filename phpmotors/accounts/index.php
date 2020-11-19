 <?php
    // This is the Accounts Controller 

    // Create or access a Session
    session_start();
    $_SESSION['loggedin'] = FALSE;

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    //Get the accounts-model.php as needed 
    require_once '../model/accounts-model.php';
    // Get the functions library
    require_once '../library/functions.php';

    $classifications = getClassifications();

    $getnavigation = navigation($classifications);


    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }


    switch ($action) {

        case 'register':
            //Test if I'm getting to the register case. 
            //echo " This is the register case";
            //exit;

            // Filter and store the data
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);


            //Checking for an existing email address in the table
            $emailMatch = checkExistingEmail($clientEmail);
            if ($emailMatch === 1) {
                $message = "<p>This email is already registered, login to your account.</p>";
                include '../view/login.php';
                exit;
            }
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);


            exit;
            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit;
            }
            // Send the data to the model
            $hashed_password = password_hash($clientPassword, PASSWORD_DEFAULT);
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashed_password);



            // Check and report the result
            if ($regOutcome === 1) {
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), "/");

                $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header('Location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }

            break;

        case 'Login':

            //filter and store email and password
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientEmail = checkEmail($clientEmail);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            $checkPassword = checkPassword($clientPassword);

            //Check for empty fields 
            if (empty($clientEmail) || empty($checkPassword)) {
                $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
                include '../view/login.php';
                exit;
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // $_SESSION['message'] = implode(" ", $clientData);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;

            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);

            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include  '../view/admin.php';
            exit;
            break;



        case 'clientUpdate':
            $_SESSION['loggedin'] = TRUE;
            // Filter and store the data
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);

            var_dump($clientFirstname); 
            //Checking for an existing email address in the table
            $emailMatch = checkExistingEmail($clientEmail);
            // echo "$emailMatch"; 
            //exit; 
            if ($emailMatch === 1 && $clientEmail != $_SESSION['clientData']['clientEmail']) {
                $message = "<p>This email is already registered, login to your account.</p>";
                include '../view/client-Update.php';
                exit;
            }
             // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }
          $clientData = getClient($clientEmail);
            $clientUpdate = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);
            $message = var_dump($clientUpdate); 
              
            if ($clientUpdate === 1) {
                $_SESSION['message_1'] = "<p>Thanks for updating your account $clientFirstname.</p>";
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), "/");
                //drop the password 
                array_pop($clientData);
                //store clientData to the session
                $_SESSION['clientData'] = $clientData;

                include '../view/admin.php';
                exit;
            } else {
                $_SESSION['message_1'] = "<p>Sorry $clientFirstname, your account information has not been updated. Please try again.</p>";
                include '../view/admin.php';
                exit;
            }



            break;




            //Update the password
        case 'password':

            //echo 'This is the password case statement'; 
            // exit; 
            $_SESSION['loggedin'] = TRUE;
            //filter and store the password 
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);


            // Check for missing data
            if (empty($clientPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }
            $checkPassword = checkPassword($clientPassword);

            // Send the data to the model
            $hashed_password = password_hash($clientPassword, PASSWORD_DEFAULT);
            $passwordOutcome = passwordUpdate($hashed_password, $clientId);

            // Check and report the result
            if ($passwordOutcome === 1) {
                $_SESSION['message'] = "<p>Your password has been updated.</p>";
                include '../view/admin.php';
                exit;
            } else {
                $_SESSION['message'] = "<p>Sorry but your password has not updated. Please try again.</p>";
                include '../view/client-update.php';
                exit;
            }

            break;


        case 'update':
            $_SESSION['loggedin'] = TRUE;
            include '../view/client-update.php';
            break;

        case 'logout':

            $_SESSION['loggedin'] = FALSE;
            session_destroy();

            include '../view/home.php';
            break;
        case 'login':
            include '../view/login.php';
            break;
        case 'registration':
            include '../view/registration.php';
            break;

        default:
            include '../view/admin.php';
            break;
    }




    ?> 