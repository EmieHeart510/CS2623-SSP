<?php
/*
 * index.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Author: Taylor, Ashley
 * Purpose: Landing page for the SSP06 exercises.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP06">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP06: Taylor</title>
    <link rel="stylesheet" href="../../Week%201/SSP01/main.css">
</head>
<body>
<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_header.php';
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_topNav.php';
?>

<div id="wrapper">
    <?php
    require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_leftNav.php';
    ?>

    <main>
        <header>
            <h1>
                SSP06 Exercises
            </h1>
        </header>

        <p>For assignment SSP06, I worked through two exercises.</p>
        <p>These exercises helped me practice collecting and processing user input.</p>
        <p>The first exercise focused on login and authentication, while the second exercise involved creating a product catalog and shopping cart.</p>
        <p>If you attempt to access the Product Order Exercise, you may be redirected if you're not logged in on the Login & Authentication Exercise.</p>

        &ensp;

        <h2><u>Please select an exercise below:</u></h2>

        <div class="exercise-links">
            <a href="SSP06_21_2/login.php" class="exercise-button">
                <h3>Exercise 21-2: Login & Authentication</h3>
            </a>

            <a href="SSP06_23_1/index.php" class="exercise-button">
                <h3>Exercise 23-1: Product Order Form</h3>
            </a>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_footer.php';
?>
</body>
</html>
