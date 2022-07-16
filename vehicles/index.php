<?php
    require_once '../library/connections.php';
    require_once '../model/main-model.php';
    require_once '../model/vehicles-model.php';
    require_once '../model/accounts-model.php';
    require_once '../model/uploads-model.php';
    require_once '../library/functions.php';

    // Create or access a Session
    session_start();
    if (empty($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = FALSE;
    }



    $classifications = getClassifications();

    // $registrationLink = '<a href="index.php?action=registration" title="Register for an account">Click here to register</a>';
    $loginLink = '<a href="/phpmotors/accounts/index.php?action=login" title="Login to your account">My account</a>';
    // links value pairs to add files
    $add_class = '<a href="/phpmotors/vehicles/index.php?action=add-class" title="Add a new classification">Add a new classification</a>';
    $add_vehicle = '<a href="/phpmotors/vehicles/index.php?action=add-vehicle" title="Add a new vehicle">Add a new vehicle</a>';

    //create a navigation bar using $classifications array
    $navList = navList($classifications);

    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL){
    $action = filter_input(INPUT_POST, 'action');
    }

    switch ($action){
        case 'add-class':
            include '../view/add-classification.php';
            break;
        case 'add-vehicle':
            include '../view/add-vehicle.php';
            break;
        case 'adding-class':
            //Filter the data
            $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

            //Check for missing data
            if (empty($classificationName)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/add-classification.php';
                exit;
            }

            //Send the data to the model
            $addClassOutcome = addClassification($classificationName);

            //Check and report the result
            if ($addClassOutcome === 1) {
                $message = "<p>$classificationName was added correctly .</p>";
                //redirect to the index page
                header('location: /phpmotors/vehicles/index.php?action=add-class');
                // include '../view/add-classification.php';
                exit;
            } else {
                $message = "<p>Error: $classificationName can't be added.</p>";
                header('location: /phpmotors/vehicles/index.php?action=add-class');
                exit;
            }
            break;
        case 'adding-vehicle':
            //Filter the data
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

            //Check for missing data
            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/add-vehicle.php';
                exit;
            }
            //Send the data to the model
            $addVehicleOutcome = addInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

            //Check and report the result
            if ($addVehicleOutcome === 1) {
                $message = "<p>$invMake $invModel was added correctly .</p>";
                //redirect to the index page
                include '../view/add-vehicle.php';
                exit;
            } else {
                $message = "<p>Error: $invMake $invModel can't be added.</p>";
                include '../view/add-vehicle.php';
                exit;
            }
            break;

                /* * **********************************
        * Get vehicles by classificationId
        * Used for starting Update & Delete process
        * ********************************** */
        case 'getInventoryItems':
            // Get the classificationId
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            // Fetch the vehicles by classificationId from the DB
            $inventoryArray = getInventoryByClassification($classificationId);
            // Convert the array to a JSON object and send it back
            echo json_encode($inventoryArray);
        break;

        case 'mod':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);

            // echo json_encode($invInfo);
            // exit;

            if (count($invInfo) < 1) {
                $message = 'Sorry, no product information could be found.';
            }
            include '../view/vehicle-update.php';
            exit;
        break;

        case 'updateVehicle':

            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
                $message = '<p>Please complete all information for the Updated! Double check the classification of the item.</p>';
                include '../view/vehicle-update.php';
                exit;
            }
            $updateResult = updateVehicle( $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId,  $invId);
            if ($updateResult) {
                $message = "<p>Congratulations, the $invMake $invModel was successfully updated.</p>";
                // include '../view/vehicle-management.php';
                if ($updateResult) {
                    $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /phpmotors/vehicles/');
                    exit;
                }

                exit;
            } else {
                $message = "<p>Error. The new vehicle was not updated.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
        break;

        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if (count($invInfo) < 1) {
                $message = 'Sorry, no product information could be found.';
            }
            include '../view/vehicle-delete.php';
            exit;
        break;

        case 'deleteVehicle':
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

            // $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='notice'>Error: $invMake $invModel was not
            deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }
            break;

        case 'classification':

            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if (!count($vehicles)) {
                $message = "<p>Sorry, no vehicles were found for $classificationName.</p>";
            } else {
                // echo the array
                // echo json_encode($vehicles);
                // exit;

                $vehiclesDisplay = buildVehicleDisplay($vehicles);
            }
            include '../view/classification.php';
        break;

        case 'details':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            $thumbnail = getThumbnailInf($invId);
            // $thumbnail = getThumbnailInf($invId)

            if (count($invInfo) < 1) {
                $message = 'Sorry, no product information could be found.';
            } else {
                // echo json_encode($invInfo["imgName"]);
                // exit;
                $invDisplay = buildVehicleDetails($invInfo, $thumbnail );

            }
            include '../view/vehicle-details.php';
            exit;

        default:
            $classificationList = buildClassificationList($classifications);



            include '../view/vehicle-management.php';
            break;

    }
?>