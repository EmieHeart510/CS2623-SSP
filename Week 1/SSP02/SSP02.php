<?php
/*
 * SSP02.php - CS2623 Week 1
 * CS2623 - Server-Side Programming
 * Dynamic PHP page with included files.
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP02">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP02: Taylor</title>
    <link rel="stylesheet" href="../SSP01/main.css">
    <link rel="stylesheet" href="CSS/table.css">
</head>

<body>
    <?php require_once __DIR__ . "/PHP/include_header.php"; ?>

    <?php require_once __DIR__ . "/PHP/include_topNav.php"; ?>

    <div id="wrapper">

        <?php require_once __DIR__ . "/PHP/include_leftNav.php"; ?>

        <main>

            <h2>
                SSP02 - Weekly Planner
            </h2>

            <p>
                Welcome to my CS2623 Server-Side Programming assignment.
                The table below is generated using PHP for loop.
            </p>


                <!--Display the weekly planner table using PHP include file.-->
                <?php require_once __DIR__ . "/PHP/include_dynamic_content.php"; ?>

        </main>
    </div>

        <?php require_once __DIR__ . "/PHP/include_footer.php"; ?>
</body>

</html>