<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;1,200&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/small.css">

    <link rel="stylesheet" href="./css/header/header.css">
    <link rel="stylesheet" href="./css/header/header-small.css">

    <link rel="stylesheet" href="./css/navigation/nav.css">
    <link rel="stylesheet" href="./css/footer/footer.css">
    
    <link rel="stylesheet" href="./css/home/home.css">
    <link rel="stylesheet" href="./css/home/home-small.css">

    <title>Php Motors</title>
</head>
<body class="page-wrapper">
    <div class="page-container">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/templates/header.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/navigation.php'; ?>

        <main>
            <div class="delorian-container">
                <h1>Welcome to PHP Motors</h1>
                <div class="delorian-text">
                    <h3>DMC Delorean</h3>
                    <p>3 Cup holders<br>
                    Superman doors<br>
                    Fuzzy dice!</p>
                    <button>Own Today</button>
                </div>
                <div class="delorian">
                    <img src="./images/vehicles/delorean.jpg" alt="delorian">
                    <button>Own Today</button>
                </div>
            </div>
            <div class="grid-container">
                <div class="grid-left-column">
                    <h2>Delorean Upgrades</h2>
                    <div class="grid-left-img-wrapper">
                        <div class="imagen">
                            <div class="image-box">
                                <img src="./images/upgrades/flux-cap.png" alt="">
                            </div>
                            <p>Flux Capacitor</p>
                        </div>
                        <div class="imagen">
                            <div class="image-box">
                                <img src="./images/upgrades/flame.jpg" alt="">
                            </div>
                            <p>Flame Decals</p>
                        </div>
                        <div class="imagen">
                            <div class="image-box">
                                <img src="./images/upgrades/bumper_sticker.jpg" alt="">
                            </div>
                            <p>Bumper Stickers</p>
                        </div>
                        <div class="imagen">
                            <div class="image-box">
                                <img src="./images/upgrades/hub-cap.jpg" alt="">
                            </div>
                            <p>Flux Capacitor</p>
                        </div>
                    </div>
                </div>
                <div class="grid-right-column">
                    <h2>DMC Delorean Reviews</h2>
                    <ul class="list">
                        <li>"So fast its almost like traveling in time" (4/5)</li>
                        <li>"Coolest ride on the road" (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day" (4.5/5)</li>
                        <li>"80's living and I love it!" (5/5)</li>
                    </ul>
                </div>
            </div>
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; ?>

    </div>
</body>
</html>

