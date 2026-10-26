<?php

/**
 * ex2_datetime.php
 * CS2623 - Server-Side Programming
 * SSP04 - Excercise 2
 * Purpose: Demonstrates PHP DateTime and DateInterval functions.
 */

$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);

$today_name = $now->format('l');
$today_date = $now->format('F j, Y');
$today_time = $now->format('g:i:s A');

$birthdate = DateTime::createFromFormat('Y-m-d', '1996-05-10', $tz);

if ($birthdate === false) {
    throw new RuntimeException('Unable to parse the birthdate.');
}

$age = $birthdate->diff($now);
$age_years = $age->y;
$age_days = $age->days;

$semester_end = new DateTime('2026-12-18', $tz);
$semester_end = $semester_end->setTime(23, 59, 59);

if ($semester_end === $now) {
    $countdown = $now->diff($semester_end);
    $days_remaining = $countdown->days;
} else {
    $days_remaining = 0;
}

$date_string = '10/31/2026';

$parsed_date = DateTime::createFromFormat('m/d/Y', $date_string, $tz);

if ($parsed_date === false) {
    throw new RuntimeException('Unable to parse the date string.');
}

$formatted_parsed_date = $parsed_date->format('F j, Y');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Date and Time</title>
    <link rel="stylesheet" href="../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/strings-table.css">
</head>

<body>
<?php
require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_header.php";
require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_topNav.php";
?>

<div id="wrapper">

    <?php
    require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_leftNav.php";
    ?>

    <main>
        <header>
            <h1>
                PHP Date and Time Functions
            </h1>
        </header>

        <h2>
            Current Date and Time
        </h2>
        <?php
        echo '<p>Today is: ' . htmlspecialchars($today_name . ', ' . $today_date, ENT_QUOTES, 'UTF-8') . '</p>';

        echo '<p>Current time (Central): ' . htmlspecialchars($today_time, ENT_QUOTES, 'UTF-8') . '</p>';

        echo '<h2>Elapsed Time Since Birth</h2>';
        echo '<p>Age in years: ' . htmlspecialchars((string)$age_years, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Total elapsed days: ' . htmlspecialchars((string)$age_days, ENT_QUOTES, 'UTF-8') . '</p>';

        echo '<h2>Semester Countdown</h2>';
        if ($days_remaining > 0) {
            echo '<p>Days remaining until the end of the semester: ' . htmlspecialchars((string)$days_remaining,
                    ENT_QUOTES, 'UTF-8') . '</p>';
        } else {
            echo '<p>The semester end date has arrived or passed.</p>';
        }


        echo '<h2>Parsed Date</h2>';

        echo '<p>Original date string: '
            . htmlspecialchars($date_string, ENT_QUOTES, 'UTF-8')
            . '</p>';

        echo '<p>Formatted date: '
            . htmlspecialchars($formatted_parsed_date, ENT_QUOTES, 'UTF-8')
            . '</p>';


        ?>

        &ensp;
        <div>
            <h3><a href="index.php">&lt;&lt;&lt; Back to SSP04 Landing Page</a></h3>
        </div>

    </main>
</div>

<?php
require_once __DIR__ . '/../../Week 1/SSP02/PHP/include_footer.php';
?>

</body>
</html>