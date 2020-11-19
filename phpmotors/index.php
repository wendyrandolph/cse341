 <?php

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    // Create or access a Session
    session_start();
    $_SESSION['loggedin'] = FALSE;


    // Get the database connection file
    require_once 'library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once 'model/main-model.php';
    // Get the functions library
    require_once 'library/functions.php';

    // Get the array of classifications
    $classifications = getClassifications();

    $getnavigation = navigation($classifications);



    switch ($action) {
        case ' ':
            break;
        
       default: 
         include '../phpmotors/view/home.php';
            break;
    }


    ?> 