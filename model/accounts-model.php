<?php 
/*
 * Accounts Model
 */



 //Register a new client

    function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
        // Create  a connection object using the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement 
        $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
            
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        // Then next four lines reaplace the placeholders in the SQL
        // statement with the actual values in the variables
        //and tekks tge database the type of data it is 
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

        //return the indicator of success (Rows changed)
        return $rowsChanged;

    }

    //Funtion to check if the email exist in the database
    function EmailChecking($clientEmail) {
        // Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement 
        $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';

        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);

        // Insert the data
        $stmt->execute();

        //check if the email exist in the database
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);

        // Close the database interaction
        $stmt->closeCursor();

        if(empty($matchEmail)){
            return 0;
        } else {
            return 1;
        }
    }

    // Get client data based on an email address
    function getClient($clientEmail){
        $db = phpmotorsConnect();
        $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->execute();
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
    }

    // Update clientFirstname, clientLastname, clientEmail
    function updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail) {
        // Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement 
        $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (Rows changed)
        return $rowsChanged;
    }

    // Get client data based on clientId
    function getClientById($clientId){
        $db = phpmotorsConnect();
        $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
        $stmt->execute();
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
    }

    // Update clientPassword
    function updateClientPassword($clientId, $clientPassword) {
        // Create a connection object using the phpmotors connection function
        $db = phpmotorsConnect();
        // The SQL statement 
        $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
        $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (Rows changed)
        return $rowsChanged;
    } 
?>