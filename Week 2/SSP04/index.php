<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS2623 SSP04: Taylor</title>
    <link rel="stylesheet" href="../../Week 1/SSP01/main.css">
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
                SSP04 Exercises
            </h1>
        </header>

        <p>For assignment SSP04, I worked two exercises: PHP Strings and Date/Time Functions.</p>
        <p>These exercises helped me understand how to manipulate strings and work with date and time in PHP.</p>
        <p>To get to those exercises, I made this landing page for easy access. </p>

        &ensp;

        <h2><p><u><b>Please select an exercise below:</b></u></p></h2>

        <div class="exercise-links">
            <a href="ex1_strings.php" class="exercise-button">
                <h3>Exercise 1: PHP Strings</h3>
            </a>

            <a href="ex2_datetime.php" class="exercise-button">
               <h3>Exercise 2: PHP Date and Time</h3>
            </a>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_footer.php';
?>
</body>
</html>

