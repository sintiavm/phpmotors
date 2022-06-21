<!DOCTYPE html>
<?php 
    if ($_SESSION['loggedin'] != TRUE ) {
        header('Location: /phpmotors/');
    }
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



    <title>Php Motors</title>
</head>
<body class="page-wrapper">
    <div class="page-container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/inner-header.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/navigation.php'; ?>

        <main class="admin-wrapper">
            <h4>User First Name</h4>
            <h5>
                <?php echo $_SESSION['clientData']['clientFirstname']; ?>
            </h5>
            <h4>Email Address</h4>
            <h5>
                <?php echo $_SESSION['clientData']['clientEmail']; ?>
            </h5>
            <h4>User role</h4>
            <h5>

            <?php if ($_SESSION['clientData']['clientLevel'] == 3 ) {
                    echo "Admin";
                } else {
                    echo "Default";
                } ?>
            </h5>
        </main>

        <div class="update-user-inf-wrapper">
            <h4>Account Management</h4>
            <p>Use this link to update your account information.</p>
            <?php 
                echo $linkToUpdateUserInfo ;
            ?>
        </div> 


        <div class="update-user-inf-wrapper">
            <h4>Use this link to manage new cars</h4>

            <?php 
                $vehicle_management_link = '<a class="management" href="/phpmotors/vehicles/">Vehicle Management</a>';
                if ($_SESSION['clientData']['clientLevel'] ==3){
                    echo $vehicle_management_link; 
                }
            ?>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; ?>
    </div>
</body>
</html>