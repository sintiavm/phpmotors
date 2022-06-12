<!DOCTYPE html>
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
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
        ?>
        <form class="form-container" action="/phpmotors/accounts/index.php" method="post">
            <h1>Register</h1>
            <fieldset class="auth-forms-register">
                <label for="firstname">First name:</label>
                <input 
                    type="text" 
                    id="firstname" 
                    name="clientFirstname" 
                    placeholder="First Name" 
                    <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>
                    required
                >
                
                <label for="lastname">Last name:</label>
                <input 
                    type="text" 
                    id="lastname" 
                    name="clientLastname" 
                    placeholder="Last Name" 
                    <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>
                    required
                >
                
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="clientEmail"
                    placeholder="Email" 
                    <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>
                    required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" 
                >
                <label for="password">Password:</label>
                <input 
                    type="password" 
                    id="password" 
                    name="clientPassword" 
                    placeholder="Password" 
                    required
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                > 
            </fieldset>

            <span class="password-requirements">
                <b>Passwords must be at least 8 characters and contain at least 1 number,
                1 capital letter and 1 special character</b>
            </span>

            <input type="submit" name="submit" id="regbtn" value="Register">
            <input type="hidden" name="action" value="register">
        </form>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; ?>
    </div>
</body>
</html>