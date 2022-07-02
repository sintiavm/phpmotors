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

    <link rel="stylesheet" href="../css/vehicles-detail/details-l.css">
    <link rel="stylesheet" href="../css/vehicles-detail/details-s.css">


    <title>Details for <?php echo $invInfo['invModel']; ?></title>
</head>
<body class="page-wrapper">
    <div class="page-container">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/inner-header.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/navigation.php'; ?>

        <main>
            <h1><?php echo $invInfo['invModel']; ?></h1>
            <?php if(isset($invDisplay)){
                echo $invDisplay; }
            ?>
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; ?>
    </div>
</body>
</html>