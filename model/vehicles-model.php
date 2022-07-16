<?php
//here arethe function to add data to the database

    //funtion to add data to the classification table 
    function addClassification($classificationName) {
        // Create  a connection object using the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement
        $sql = 'INSERT INTO carclassification (classificationName)
            VALUES (:classificationName)';

        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        //the next lines replace the placeholders in the SQL statement with the actual values in the variables
        //and tekks tge database the type of data it is
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

        // Insert the data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction
        $stmt->closeCursor();

        //return the indicator of success (Rows changed)
        return $rowsChanged;

    }


    //funtion to add data to the inventory table
    function addInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
        // Create  a connection object using the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement
        $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
            VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';

        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        //the next lines replace the placeholders in the SQL statement with the actual values in the variables
        //and tekks tge database the type of data it is
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);

        // Insert the data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction
        $stmt->closeCursor();

        //return the indicator of success (Rows changed)
        return $rowsChanged;

    }

    // Get vehicles by classificationId 
    function getInventoryByClassification($classificationId){ 
        $db = phpmotorsConnect(); 
        $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
        $stmt = $db->prepare($sql); 
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
        $stmt->execute(); 
        $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $stmt->closeCursor(); 
        return $inventory; 
    }

    // Get vehicle information by invId
    function getInvItemInfo($invId){
        $db = phpmotorsConnect();
        $sql = 'SELECT * FROM inventory 
            JOIN images ON inventory.invId = images.invId
            WHERE inventory.invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

    // Update a vehicle
	function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
        $db = phpmotorsConnect();
        $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    // Delete a vehicle
    function deleteVehicle($invId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
       }

    // get a list of vehicles based on the classification
    function getVehiclesByClassification($classificationName){
        $db = phpmotorsConnect();
        // $sql = 'SELECT * FROM inventory JOIN images WHERE classificationId IN 
        // (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $sql = 'SELECT * FROM inventory 
            INNER JOIN images 
            ON inventory.invId = images.invId'
            . ' WHERE imgName LIKE "%tn.jpg"'
            . ' AND classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
       }


    // Get information for all vehicles
    function getVehicles() {
        $db = phpmotorsConnect();
        $sql = 'SELECT invId, invMake, invModel FROM inventory';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

?>