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
            <h1>Add Vehicle</h1>
            <fieldset class="auth-forms-register">
                <label for="classification">classification:</label>
                <select name="classificationId" id="classification">
                    <?php foreach ($classifications as $classification) : ?>
                        <option value="<?php echo $classification['classificationId']; ?>">
                            <?php echo $classification['classificationName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="make">Car Make:</label>
                <input 
                    type="text" 
                    id="make" 
                    name="invMake" 
                    placeholder="Car Make"
                    <?php if (isset($invMake)) { echo "value='$invMake'"; } ?> 
                    required
                >

                <label for="model">Car Model:</label>
                <input 
                    type="text" 
                    id="model" 
                    name="invModel" 
                    placeholder="Car Model" 
                    <?php if (isset($invModel)) { echo "value='$invModel'"; } ?>
                    required
                >

                <label for="invDescription">Description:</label>
                <textarea
                    id="invDescription" 
                    name="invDescription" 
                    placeholder="Add Description"
                    required
                ><?php if (isset($invDescription)) { echo $invDescription; } ?></textarea>

                <label for="image">Image:</label>
                <input 
                    type="text" 
                    id="image" 
                    name="invImage" 
                    placeholder="Image path" 
                    value="/phpmotors/images/no-image.png" 
                    readonly
                >

                <label for="thumbnail">Thumbnail:</label>
                <input 
                    type="text" 
                    id="thumbnail" 
                    name="invThumbnail" 
                    placeholder="Thumbnail path" 
                    value="/phpmotors/images/no-image.png" 
                    readonly
                >

                <label for="price">Price:</label>
                <input 
                    type="text" 
                    id="price" 
                    name="invPrice" 
                    placeholder="Price" 
                    <?php if (isset($invPrice)) { echo "value='$invPrice'"; } ?>
                    required
                >

                <label for="stock">Stock:</label>
                <input 
                    type="text" 
                    id="stock" 
                    name="invStock" 
                    placeholder="Stock" 
                    <?php if (isset($invStock)) { echo "value='$invStock'"; } ?>
                    required
                >

                <label for="color">Color:</label>
                <input 
                    type="text"    
                    id="color" 
                    name="invColor" 
                    placeholder="Color" 
                    <?php if (isset($invColor)) { echo "value='$invColor'"; } ?>
                    required
                >
                
            </fieldset>
            <input type="submit" name="submit" id="regbtn" value="Register">
            <input type="hidden" name="action" value="adding-vehicle">
        </form>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; ?>
    </div>
</body>
</html>