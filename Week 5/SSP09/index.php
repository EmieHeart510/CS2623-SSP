<?php
/*
 * SSP09.php
 * CS2623 - Server-Side Programming
 * Week 5 - SSP09
 * Author: Taylor, Ashley
 * Purpose: Landing page for the SSP09 exercises.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP09">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP09: Taylor</title>
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
                SSP09 Exercises
            </h1>
        </header>

        <p>For assignment SSP09, I practiced working with PHP string functions to search, check, and manipulate text.</p>

        <p>I also learned how to format numbers, work with currency, generate random numbers, and perform calculations.</p>

        &ensp;

        <h2><u>Please select an exercise below:</u></h2>

        <div class="exercise-links">
            <a href="SSP09_17_1/index.php" class="exercise-button">
                <h3>Exercise 17-1: Strings, Numbers & Dates</h3>
            </a>

            <a href="../../Week%206/SSP09/SSP09.php" class="exercise-button">
                <h3>Frosty Word Guessing Game</h3>
            </a>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_footer.php';
?>
</body>
</html>
