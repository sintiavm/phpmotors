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



?>