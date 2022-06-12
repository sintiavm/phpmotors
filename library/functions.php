<?php
    // require_once '../model/main-model.php';
    

    function checkEmail($clientEmail){
        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $valEmail;
    }

    //Check the password for a minimum of 8 characters,
    // at least one 1 capital letter, at least 1 number and
    // at least 1 special character
    function checkPassword($clientPassword) {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
        return preg_match($pattern, $clientPassword);
    }


    //create a navigation bar using the navList funtion that takes an array as parameter
    //from the database
    function navList($classifications) {
        $navList = '<ul class="nav-container">';
        $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors hpme page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }
?>