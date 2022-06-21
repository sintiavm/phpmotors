<?php 
    //Account Controller

    require_once '../library/connections.php';
    require_once '../model/main-model.php';
     // Get the accounts model
    require_once '../model/accounts-model.php';
    // Get the checkEmail function from library/functions.php
    require_once '../library/functions.php';

    // Create or access a Session
    session_start();
    if (empty($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = FALSE;
    }

    //variables used for the view
    $linkToUpdateUserInfo = '<a class="management" href="/phpmotors/accounts?action=client-update">Update User Info</a>';


    $classifications = getClassifications();


    // create a navigation bar using the navList funtion array
    $navList = navList($classifications);


    $registrationLink = '<a href="index.php?action=registration" title="Register for an account">Click here to register</a>';
    $loginLink = '<a href="index.php?action=login" title="Login to your account">My account</a>';


    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL){
    $action = filter_input(INPUT_POST, 'action');
    }

    switch ($action){
        case 'login':
            include '../view/login.php';
            break;
        case 'registration':
            include '../view/registration.php';
            break;
        case 'register':
            // Filter and store the data 
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname' , FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $validEmail = checkEmail($clientEmail);
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $validPassword = checkPassword($clientPassword);

            // Checking for existing email
            $existingEmail = EmailChecking($clientEmail);
            if ($existingEmail) {
                $_SESSION['message'] = "<p class='notice'>That email address already exists. Please try again.</p>";
                // $message = "<p class='notice'>The email address $clientEmail is already in use. Do you want to log in instead?</p>";
                include '../view/registration.php';
                exit;
            }

            // check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($validEmail) || empty($validPassword)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit;
            }
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            
            
            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            // Check and report the result 
            if ($regOutcome === 1) {
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
                // include '../view/login.php';
                header('location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                // $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                $_SESSION['message'] = "Sorry $clientFirstname, but the registration failed. Please try again.";
                include '../view/registration.php';
                exit;
            }
        case 'log-in':
            // Filter and store the data
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $validEmail = checkEmail($clientEmail);
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $validPassword = checkPassword($clientPassword);
            // check for missing data
            if (empty($validEmail) || empty($validPassword)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/login.php';
                exit;
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($validEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't math, create an error
            // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="error">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include '../view/admin.php';
            exit;

        case 'logout':
            // Destroy the session
            session_destroy();
            // Recreate the session
            session_start();
            $_SESSION['loggedin'] = FALSE;
            // clear the cookie
            setcookie('firstname', '', time() -3600, '/');
            // Set the logout message
            $_SESSION['message'] = '<p class="notice">You have been logged out. Come back soon!</p>';
            // Send them to the root controler
            header ('location: /phpmotors/');
            exit;

        case 'client-update':
            include '../view/client-update.php';
        break;

        case 'updateClientInfo':
            // Filter and store the data
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

            // Checking for existing email
            $existingEmail = EmailChecking($clientEmail);
            if ($existingEmail) {
                $_SESSION['message'] = "<p class='notice'>That email address already exists. Please try again.</p>";
                // $message = "<p class='notice'>The email address $clientEmail is already in use. Do you want to log in instead?</p>";
                include '../view/client-update.php';
                exit;
            }

            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }
            $updateCliResult = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail);
            if ($updateCliResult) {

                $_SESSION['message'] = "<p class='notice'>Congratulations, $clientFirstname $clientLastname, your account information has been successfully updated.</p>";
                //update the $_SESSION['clientData']
                $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
                $_SESSION['clientData']['clientLastname'] = $clientLastname;
                $_SESSION['clientData']['clientEmail'] = $clientEmail;

                header('location: /phpmotors/accounts/?action=client-update');
                exit;
            } else {
                $_SESSION['message'] = "<p class='notice'>Error: $clientFirstname $clientLastname, your account information has not been updated.</p>";
                include '../view/client-update.php';
                exit;
            }

        case 'updatePassword':
            // Filter and store the data
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $validPassword = checkPassword($clientPassword);
            // check for missing data
            if (empty($validPassword)) {
                $message = '<p class="error">Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            $updatePassResult = updateClientPassword($clientId, $hashedPassword);
            if ($updatePassResult) {
                $_SESSION['message'] = "<p class='notice'>Congratulations,  your password has been successfully updated.</p>";
                header('location: /phpmotors/accounts/?action=client-update');
                exit;
            } else {
                $_SESSION['message'] = "<p class='notice'>Error: , your password has not been updated.</p>";
                include '../view/client-update.php';
                exit;
            }
            
        default:
            include '../view/admin.php';
            break;
    }

?>

