<?php
/*
 * index.php
 * CS2623 - Server-Side Programming
 * Week 5 - SSP08
 * Author: Taylor, Ashley
 * Purpose: Landing page for the SSP08 exercises.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP08">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP08: Taylor</title>
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
                SSP08 Exercises
            </h1>
        </header>

        <p>For assignment SSP08, I practiced using PHP control structures, including loops, conditional statements, and functions.</p>

        <p>I also learned how to work with files in PHP, including creating, reading, writing, appending, and clearing file contents.</p>

        <p>These exercises helped me improve my understanding of PHP logic and file handling.</p>

        &ensp;

        <h2><u>Please select an exercise below:</u></h2>

        <div class="exercise-links">
            <a href="SSP08_03_1/index.php" class="exercise-button">
                <h3>Exercise 03-1: Control Structures</h3>
            </a>

            <a href="SSP08_16_1/index.php" class="exercise-button">
                <h3>Exercise 16-1: File Logging</h3>
            </a>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_footer.php';
?>
</body>
</html>
