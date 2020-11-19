
<?php
// This is the Vehicles Model 


//This function will handle site registrations 
function addNewclass($classificationName)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO carclassification (classificationName)
      VALUES (:classificationName)';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

function add_vehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invStock, $invPrice, $invColor, $classificationId)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invStock, invPrice, invColor, classificationId)
     VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invStock, :invPrice, :invColor, :classificationId)';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}


// Get vehicles by classificationId 
function getInventoryByClassification($classificationId)
{
  $db = phpmotorsConnect();
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
  $stmt->execute();
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $inventory;
}




//This function will update a vehicle
function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'UPDATE inventory 
  SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invStock = :invStock, invPrice = :invPrice, invColor = :invColor, classificationId = :classificationId
    WHERE invId = :invId';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}


//This function will delete a vehicle
function deleteItem($invId, $invMake, $invModel)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'DELETE FROM inventory WHERE invId = :invId';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

//Get a list of vehicles based on the classification
function getVehiclesByClassification($classificationName)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory 
  WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $vehicles;
}

function  getCarInfo($invId)
{ 
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'SELECT * FROM inventory 
  WHERE invId =  :invId';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();

  $carInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $carInfo;
}



?>