<?php

/*
 * dashboard.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Exercise 21-2: Login & Authentication
 *
 * Purpose: Displays the protected dashboard after a
 * successful login. Shows the logged-in user's name
 * and login time.
 */

require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP06 Exercise 21-2">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP06 Exercise 21-2: Taylor - Dashboard</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/LoginStyle.css">
</head>
<body>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_header.php";
require_once __DIR__ . "/../Nav/include_topNav.php";
?>

<div id="wrapper">

    <?php
    require_once __DIR__ . "/../Nav/include_leftNav.php";
    ?>

    <main>

        <header>
            <h1>
                Exercise 21-2: Login & Authentication - Dashboard
            </h1>
        </header>

        <div class="form-wrapper">

            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8'); ?>!</h2>

            <p>
                Logged in at:
                <?php date_default_timezone_set('America/Chicago'); ?>
                <?php echo date('F j, Y \a\t g:i A', $_SESSION['login_at']); ?>
            </p>

            <p>
                <a href="../SSP06_23_1/index.php">Visit the Guitar Shop</a>
            </p>

            <p><a href="profile.php">View Profile</a></p>

            <p><a href="logout.php">Logout</a></p>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>
