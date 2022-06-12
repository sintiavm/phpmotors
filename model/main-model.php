<?php
    //main controller for the site
    function getClassifications(){
        //create a connection to the database
        $db = phpmotorsConnect();
        //set up the SQL command to be executed
        $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC';
        //creates the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        //executes the prepared statement
        $stmt->execute();
        //fetches all of the rows from the executed statement
        $classifications = $stmt->fetchAll();
        //closes the database connection
        $stmt->closeCursor();
        //returns the array of classifications
        return $classifications;
    }
?>