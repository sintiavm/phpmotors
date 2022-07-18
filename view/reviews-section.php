<?php $loginLink = '<a href="/phpmotors/accounts/index.php?action=login" title="Login to your account">logged in</a>'; ?>
<div class="reviews-wrapper">
    <div class="line"></div>
    <?php     
        if ($_SESSION['loggedin'] != TRUE ) {
            echo "<h2 class='notice'>You must be $loginLink to share a review.</h2>"; 
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/reviews/review-form/review-form.php';
        }


    ?>
    <div class="line"></div>
</div>

