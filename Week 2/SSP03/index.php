<?php

require_once __DIR__ . '/PHP/functions_ssp03.php';
require_once __DIR__ . '/PHP/include_header.php';

echo '<h2>' . htmlspecialchars('SSP03 - Weekly Study Planner', ENT_QUOTES, 'UTF-8') . '</h2>';

echo '<p>'
    . htmlspecialchars('Welcome to my CS2623 Server-Side Programming assignment. '
        . 'Welcome to my CS2623 Weekly Study Planner!' , ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p>'
    . htmlspecialchars('The current day of the week is automatically highlighted to '
        . 'help identify the day\'s scheduled activities and study times.', ENT_QUOTES, 'UTF-8') . '</p>';

/*Set the timeszone to Central Time for the Apollo Server*/
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$current_day = (int)$now->format('N'); // Get the current day of the week (1-7, where 1 is Monday and 7 is Sunday)

fn_tableOpen('CS-2623 Weekly Study Planner');

// loop Mon-Sun, highlight current day
for ($day = 1; $day <= 7; $day++) {
    $name = fn_dayOfWeek($day);
    $details = fn_dayDetails($day);
    $time = fn_dayTime($day);

    if ($day === $current_day) {
        fn_tableRowCurrent($name, $details, $time);
    } else {
        fn_tableRow($name, $details, $time);
    }
}

fn_tableClose();

require_once __DIR__ . '/PHP/include_footer.php';