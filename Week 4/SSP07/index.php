<?php
/*
 * index.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP07
 * Author: Taylor, Ashley
 * Purpose: Landing page for the SSP07 exercises.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP07">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP07: Taylor</title>
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
                SSP07 Exercises
            </h1>
        </header>

        <p>For assignment SSP07, I practiced working with arrays and array functions.</p>

        <p>I also learned more about regular expressions and exception handling.</p>

        <p>These exercises helped me improve my PHP skills.</p>

        &ensp;

        <h2><u>Please select an exercise below:</u></h2>

        <div class="exercise-links">
            <a href="SSP07_11_1/index.php" class="exercise-button">
                <h3>Exercise 11-1: Arrays & Array Functions</h3>
            </a>

            <a href="SSP07_15_1/index.php" class="exercise-button">
                <h3>Exercise 15-1: Regular Expressions (Regex)</h3>
            </a>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_footer.php';
?>
</body>
</html>
