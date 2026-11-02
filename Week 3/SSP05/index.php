<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP05">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP05: Taylor</title>
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
                SSP05 Exercises
            </h1>
        </header>

        <p>For assignment SSP05, I worked through two exercises involving PHP forms.</p>
        <p>These exercises helped me practice collecting, validating, and displaying user input using PHP.</p>
        <p>To access the exercises, I created this landing page for easy navigation.</p>

        &ensp;

        <h2><u>Please select an exercise below:</u></h2>

        <div class="exercise-links">
            <a href="SSP05_1/SSP05_1.php" class="exercise-button">
                <h3>Exercise 7-1: Personal Info Form</h3>
            </a>

            <a href="SSP05_2/SSP05_2.php" class="exercise-button">
                <h3>Exercise 7-2: Product Order Form</h3>
            </a>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_footer.php';
?>
</body>
</html>
