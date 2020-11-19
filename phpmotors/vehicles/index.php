<?php
// This is the Vehicles Controller 

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the vehicles-model.php as needed 
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

$getnavigation = navigation($classifications);





$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


//Switch statement 

switch ($action) {
    case 'add_vehicle':
        //Test if I'm getting to the register case. 
        //echo " This is the register case";
        //exit;

        // Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING, FILTER_SANITIZE_ADD_SLASHES);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING, FILTER_SANITIZE_ADD_SLASHES);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

        //test if the variables are being read 

        //echo "$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invStock, $invPrice, $invColor, $classificationName";
        //exit; 


        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invStock) || empty($invPrice) || empty($invColor) || empty($classificationId)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../phpmotors/vehicles/';
            break;
        }

        // Send the data to the model
        $addOutcome = add_vehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invStock, $invPrice, $invColor, $classificationId);


        // Check and report the result
        if ($addOutcome === 1) {
            $message = "<p>Thanks for adding the $invMake $invModel.</p>";
            include '../view/vehicle.php';
            exit;
        } else {
            //echo "This is the add a vehicle error message";
            $message = "<p>Sorry but the add vehicle form failed. Please try again.</p>";
            include '../view/vehicle.php';
            exit;
        }


    case 'addClass':
        //Test if I'm getting to the classification case. 
        //echo " This is the add_class case";
        //exit;

        //Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        //echo $classificationName; 
        //exit; 

        //Check for empty fields
        if (empty($classificationName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/classification.php';
            break;
        }



        // Send the data to the model
        $classOutcome = addNewclass($classificationName);
        //echo $classOutcome; 
        //exit; 

        //Check and view the result
        if ($classOutcome == 1) {
            $message = "";
            header('Location: /phpmotors/vehicles/index.php');
        } else {
            //echo "This is the add a vehicle error message";
            $message = "<p>Sorry you weren't able to add the new class. Please try again.</p>";
            include '../view/classification.php';
            exit;
        }




    case 'getInventoryItems':
        //Get the ClassificationId
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;



    case 'updateVehicle':
        // Filter and store the data
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING, FILTER_SANITIZE_ADD_SLASHES);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING, FILTER_SANITIZE_ADD_SLASHES);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invStock) || empty($invPrice) || empty($invColor) || empty($classificationId)) {
            $message = "<p class='notice'>Please provide information for all empty form fields.</p>";
            include '../view/vehicle-update.php';
            break;
        }

        // Send the data to the model
        $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);

        if ($updateResult) {
            if ($updateResult) {
                $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }
        } else {
            $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInventoryByClassification($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

    case 'deleteVehicle':
        // Filter and store the data

        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);


        // Send the data to the model
        $deleteResult = deleteItem($invId, $invMake, $invModel);

        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error. the $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /view/');
            exit;
        }
        break;

    case 'classifications':

        //filter, sanitize and store the second value being sent through the URL
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);

        // a variable to store the queried array
        $vehicles = getVehiclesByClassification($classificationName);


        //create a test to see if any vehicles were actually returned 
        if (!count($vehicles)) {
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        //echo $vehicleDisplay; 
        //exit; 
        include '../view/classifications.php';
        break;

    case 'getCarInfo':


        //filter, sanitize and store the second value being sent throught the URL
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        

        // a variable to store the car details
        $carInfo =  getCarInfo($invId);
        var_dump($carInfo); 
        //create a test to see if any vehicles were actually returned
        if (!count($carInfo)) {
            $message = "<p class='notice'> Sorry, no vehicles could be found.</p>";
            include  '../view/car_details.php';
        } else {
            $carDisplay = buildModelDisplay($carInfo);
            $_SESSION['carInfo'] = $carInfo;

            include  '../view/car_details.php';
        }

        break;

    case 'classification':

        include '../view/classification.php';
        break;

    case 'vehicle':
        include '../view/vehicle.php';
        break;

    default:

        $classificationList = buildClassificationList($classifications);

        include '../view/vehicle_management.php';
}
