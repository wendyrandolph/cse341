<?php


function checkEmail($clientEmail){ 
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
return $valEmail; 
}

//Check password for a minimum of 8 characters
//At least 1 capital letter, at least 1 number and
//at least 1 special character
function checkPassword($clientPassword){ 
$pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
return preg_match($pattern, $clientPassword);
}

function navigation($classifications){ 
 // Get the array of classifications
 $classifications = getClassifications();
 //var_dump($classifications);
 //exit;

 // Build a navigation bar using the $classifications array
 $navList = '<ul>';
 $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
 foreach ($classifications as $classification) {
     $navList .= "<li><a href='/phpmotors/vehicles/?action=classifications&classificationName=".urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
 }
 $navList .= '</ul>';
return $navList;  
 echo $navList;
 exit;
}


// Build the classifications select list 
function buildClassificationList($carClassifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($carClassifications as $carClassifications) { 
     $classificationList .= "<option value='$carClassifications[classificationId]'>$carClassifications[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }
 
//This will build a display of vehicles in an unordered list. 
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2><a href='/phpmotors/vehicles/?action=getCarInfo&invId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }

function buildModelDisplay($carInfo){ 
    $md = '<ul id="v-display">'; 
    foreach($carInfo as $carsInfo) { 
       $md .= '<li>';
       $md .= "<img src='$carsInfo[invImage]' alt='Image of $carsInfo[invMake] $carsInfo[invModel] on phpmotors.com'>"; 
       $md .= '<hr>'; 
       $md .= "<h2> $carsInfo[invMake]$carsInfo[invModel]</h2>"; 
       $md .= '<hr>'; 
       $md .= "<span>$carsInfo[invDescription]</span>"; 
       $md .= '<hr>'; 
       $md .= "<span>$carsInfo[invPrice]</span>"; 
       $md .= '<hr>'; 
       $md .= "<span>$carsInfo[invStock]</span>"; 
       $md .= '<hr>'; 
       $md .= "<span>$carsInfo[invColor]</span>"; 
       $md .= '</li>'; 
    }
     $md .= '</ul>'; 
     return $md; 
}

?> 