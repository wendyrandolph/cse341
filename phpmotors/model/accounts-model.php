<?php

// This is the accounts model page 




//This function will handle site registrations 
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
      VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

//This function will check for existing email address 
function checkExistingEmail($clientEmail)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement

  $sql = "SELECT  clientEmail FROM clients WHERE clientEmail = '" . $clientEmail . "'";
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  // Check the data
  $stmt->execute();
  $emailMatch = $stmt->fetch(PDO::FETCH_NUM);

  if (empty($emailMatch)) {
    return 0;
    // echo 'Nothing found';
  } else {
    return 1;
    //echo 'Match found';
  }
  $stmt->closeCursor();
}
// Get client data based on an email address
function getClient($clientEmail)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
  exit;
}


//This function will handle site registrations 
function updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail){
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'UPDATE clients 
      SET clientFirstname = :clientFirstname
      , clientLastname = :clientLastname
      , clientEmail = :clientEmail 
      WHERE clientId = :clientId';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}

function passwordUpdate($clientPassword, $clientId)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'UPDATE clients 
    SET  clientPassword = :clientPassword 
    WHERE clientId = :clientId; ';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is

  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
}
