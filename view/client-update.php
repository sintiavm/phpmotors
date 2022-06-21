<!DOCTYPE html>
<?php
    if ($_SESSION['loggedin'] != TRUE ) {
        header('Location: /phpmotors/');
    }

    $userFirstname = $_SESSION['clientData']['clientFirstname'];
    $userLastname = $_SESSION['clientData']['clientLastname'];
    $userEmail = $_SESSION['clientData']['clientEmail'];
    $clientId = $_SESSION['clientData']['clientId'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/small.css">

    <link rel="stylesheet" href="../css/header/header.css">
    <link rel="stylesheet" href="../css/header/header-small.css">

    <link rel="stylesheet" href="../css/navigation/nav.css">
    <link rel="stylesheet" href="../css/footer/footer.css">
    
    <link rel="stylesheet" href="../css/home/home.css">
    <link rel="stylesheet" href="../css/home/home-small.css">

    <link rel="stylesheet" href="../css/forms/form.css">
    <link rel="stylesheet" href="../css/forms/form-small.css">

    <title>Update Client</title>
</head>
<body class="page-wrapper">
    <div class="page-container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/inner-header.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/navigation.php'; ?>

        <?php 
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
        ?>
        <?php 
            if (isset($message)) {
                echo $message;
            }
        ?>

        <main>

            <form action="/phpmotors/accounts/index.php" method="post">
                <fieldset class="accounts-update-styles-wrapper">

                    <legend>Update Client Info</legend>
                    
                    <div class="accounts-update-styles">
                        <label for="firstname">First name:</label>
                        <input 
                            type="text" 
                            id="firstname" 
                            name="clientFirstname" 
                            placeholder="First Name" 
                            <?php echo "value='$userFirstname'" ; ?>
                            required
                        >
                        
                        <label for="lastname">Last name:</label>
                        <input 
                            type="text" 
                            id="lastname" 
                            name="clientLastname" 
                            placeholder="Last Name" 
                            <?php echo "value='$userLastname'"; ?>
                            required
                        >
                        
                        <label for="email">Email:</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="clientEmail"
                            placeholder="Email" 
                            <?php echo "value='$userEmail'"; ?>
                            required
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" 
                        >
                    </div>
                </fieldset>
                <div class="btn-wrapper">
                    <input class="update-btn" type="submit" name="submit" id="regbtn" value="Update Client Info">
                    <input type="hidden" name="action" value="updateClientInfo">
                    <input type="hidden" name="clientId" value=" <?php if(isset($clientId)){ echo $clientId;} else ( $clientId = '' )?>" >
                </div>
            </form>

            <form action="/phpmotors/accounts/index.php" method="post">
                <fieldset class="accounts-update-styles-wrapper">
                    <legend>Update Password</legend>
                    <p>Once changed, the effect is irrevocable</p>
                    
                    <div class="accounts-update-styles">
                        <label for="password">Password:</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="clientPassword" 
                            placeholder="Password" 
                            required
                            pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        >
                    </div>

                    <span class="password-requirements-update">
                        <b>Passwords must be at least 8 characters and contain at least 1 number,
                        1 capital letter and 1 special character</b>
                    </span>
                </fieldset>
                <div class="btn-wrapper">
                    <input class="update-btn" type="submit" name="submit" id="btn" value="Update Password">
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId" value=" <?php if(isset($clientId)){ echo $clientId;} else ( $clientId = '' )?>" >
                </div>
            </form>

        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; ?>
    </div>
</body>
</html>