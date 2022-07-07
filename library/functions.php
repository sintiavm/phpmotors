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
        $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors hpme page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
            .urlencode($classification['classificationName']).
            "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }
    // function navList($classifications) {
    //     $navList = '<ul class="nav-container">';
    //     $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors hpme page'>Home</a></li>";
    //     foreach ($classifications as $classification) {
    //         $navList .= "<li><a href='/phpmotors/vehicles/?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    //     }
    //     $navList .= '</ul>';
    //     return $navList;
    // }


    // Build the classifications select list 
    function buildClassificationList($classifications){ 
        $classificationList = '<select name="classificationId" id="classificationList">'; 
        $classificationList .= "<option>Choose a Classification</option>"; 
        foreach ($classifications as $classification) { 
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
        } 
        $classificationList .= '</select>'; 
        return $classificationList; 
   }

   //build a display of vehicles whitin an unordered list
   function buildVehicleDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= "<a href='/phpmotors/vehicles?action=details&invId=$vehicle[invId]'>";
        $dv .= '<li class="vehicles-card">';
        $dv .= "<img src='/phpmotors$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$vehicle[invPrice]</span>";
        $dv .= "<span>this is the id$vehicle[invId]</span>";
        $dv .= '</li>';
        $dv .= '</a>';
    }
    $dv .= '</ul>';
    return $dv;
   }

   //create a funciton that render items from a vehicle id to a details page
    function buildVehicleDetails($invInfo){
        $dv = '<div class="inv-details">';
        $dv .= "<img src='/phpmotors$invInfo[invImage]' alt='Image of $invInfo[invMake] $invInfo[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$invInfo[invMake] $invInfo[invModel]</h2>";
        $dv .= "<p><b>Description</b>: $invInfo[invDescription]</p>";
        $dv .= "<p><b>Stock</b>: $invInfo[invStock]</p>";
        $dv .= "<p><b>Price</b>: $invInfo[invPrice]</p>";
        $dv .= '</div>';
        return $dv;
    }
?>

