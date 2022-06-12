<?php $loginLink = '<a href="/phpmotors/accounts/index.php?action=login" title="Login to your account">My account</a>'; ?>
<?php $logout = '<a href="/phpmotors/accounts/index.php?action=logout" title="Logout">Logout</a>'; ?>

<header>
    <div class="head-container">
        <div class="logo">
            <a href="#">
                <img src="../images/site/logo.png" alt="logo">
            </a>
        </div>
        <div class="account">
            <a href="/phpmotors/accounts/" title="Login to your account">
                <?php
                    if ($_SESSION['loggedin'] == TRUE) {
                        echo "Welcome " . $_SESSION['clientData']['clientFirstname'];
                    }
                ?>
            </a>
            <?php 
                if ($_SESSION['loggedin'] == TRUE) {
                    echo $logout;
                } else {
                    echo $loginLink;
                }
            ?>
        </div>
    </div>
</header>