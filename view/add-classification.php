<!DOCTYPE html>
<?php 
    if ($_SESSION['loggedin'] != TRUE ) {
        header('Location: /phpmotors/');
    }
    if ($_SESSION['clientData']['clientLevel'] != 3 ) {
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

    <link rel="stylesheet" href="../css/forms/form.css">
    <link rel="stylesheet" href="../css/forms/form-small.css">

    <title>Php Motors</title>
</head>
<body class="page-wrapper">
    <div class="page-container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/inner-header.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/navigation.php'; ?>

        <?php 
            if (isset($message)) {
                echo $message;
            }
        ?>
        <form class="form-container" action="/phpmotors/vehicles/index.php" method="post">
            <h1>Classification</h1>
            <fieldset class="auth-forms-register">
                <label for="classification">Add classification:</label>
                <input 
                    type="text" 
                    id="classification" 
                    name="classificationName" 
                    placeholder="New Classification" 
                    maxlength="30"
                    required
                >
            </fieldset>
            <span><b>30 characters max</b></span>
            <input type="submit" name="submit" id="regbtn" value="Register">
            <input type="hidden" name="action" value="adding-class">
        </form>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; ?>
    </div>
</body>
</html>