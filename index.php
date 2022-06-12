<?php 
    require_once 'library/connections.php';
    require_once 'model/main-model.php';
    require_once 'library/functions.php';

    // Create or access a Session
    session_start();
    $_SESSION['loggedin'] = FALSE;


    $classifications = getClassifications();

    // echo '<pre>';
    // var_dump($classifications);
    // echo '</pre>';
    // exit;

    //create a navigation bar using $classifications array
    $navList = navList($classifications);

    //main controller for the site
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL){
    $action = filter_input(INPUT_POST, 'action');
    }

    switch ($action){
        case 'template':
            include 'view/template.php';
            break;
        default:
            //display a greet message using the value from cookie in the browser site
            if(isset($_COOKIE['firstname'])) {
                $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            include 'view/home.php';
            break;
    }

?>