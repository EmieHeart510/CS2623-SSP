<?php
declare(strict_types=1);
/**
 * Opens the weekly planner table and displays its caption and column headings.
 *
 * @param string $caption The title displayed above the table.
 * @return void
 */

function fn_tableOpen(string $caption): void {
    $escapedCaption = htmlspecialchars($caption, ENT_QUOTES, 'UTF-8');

    echo '<table id="weekly-planner" border="1" cellpadding="6" cellspacing="0">';
    echo '<tr style="background-color: #1B2A6B; color: white;">';
    echo '<th colspan="3">';
    echo $escapedCaption;
    echo '</th>';
    echo '</tr>';
    echo '<tr style="background-color: #006B7D; color: white;">';
    echo '<th>Day</th>';
    echo '<th>Details</th>';
    echo '<th>Time</th>';
    echo '</tr>';
}

/**
 * Closes the weekly planner table
 *
 * @return void
 *
 */

function fn_tableClose(): void {
    echo '</table>';
}

/**
 * Outputs a highlighted table row for the current day.
 *
 * @param string $day The name of the day.
 * @param string $details The scheduled activity.
 * @param string $time The scheduled time
 * @return void
 */

function fn_tableRowCurrent(string $day, string $details, string $time): void {
    $escapedDay = htmlspecialchars($day, ENT_QUOTES, 'UTF-8');
    $escapedDetails = htmlspecialchars($details, ENT_QUOTES, 'UTF-8');
    $escapedTime = htmlspecialchars($time, ENT_QUOTES, 'UTF-8');

    echo '<tr style="background-color: #FFFF66;">';
    echo '<td>' . $escapedDay . '</td>';
    echo '<td>' . $escapedDetails . '</td>';
    echo '<td>' . $escapedTime . '</td>';
    echo '</tr>';
}

/**
 * Outputs a standard table row without highlighting.
 *
 * @param string $day The name of the day.
 * @param string $details The scheduled activity.
 * @param string $time The scheduled time.
 * @return void
 */

function fn_tableRow(string $day, string $details, string $time): void {
    $escapedDay = htmlspecialchars($day, ENT_QUOTES, 'UTF-8');
    $escapedDetails = htmlspecialchars($details, ENT_QUOTES, 'UTF-8');
    $escapedTime = htmlspecialchars($time, ENT_QUOTES, 'UTF-8');

    echo '<tr>';
    echo '<td>' . $escapedDay . '</td>';
    echo '<td>' . $escapedDetails . '</td>';
    echo '<td>' . $escapedTime . '</td>';
    echo '</tr>';
}

/**
 * Returns weekday name for a given number.
 *
 * @param int $day_num The day number, from 1 (Monday) to 7 (Sunday).
 * @return string The weekday name or "Unknown" for invalid input.
 */

function fn_dayOfWeek(int $day_num): string {
    if ($day_num === 1) {
        return 'Monday';
    } elseif ($day_num === 2) {
        return 'Tuesday';
    } elseif ($day_num === 3) {
        return 'Wednesday';
    } elseif ($day_num === 4) {
        return 'Thursday';
    } elseif ($day_num === 5) {
        return 'Friday';
    } elseif ($day_num === 6) {
        return 'Saturday';
    } elseif ($day_num === 7) {
        return 'Sunday';
    } else {
        return 'Unknown';
    }
}

/**
 * Returns the scheduled activity for a given day.
 *
 * @param int $day_num The day number, from 1 (Monday) to 7 (Sunday).
 * @return string The scheduled activity or "No schedule" for invalid input.
 */

function fn_dayDetails(int $day_num): string {
    switch ($day_num) {
        case 1:
            return 'PHP lecture — Ch08 Conditionals';
        case 2:
            return 'Lab: SSP03 function library';
        case 3:
            return 'Study: string functions Ch09';
        case 4:
            return 'Lab: SSP04 exercises';
        case 5:
            return 'Quiz review + office hours';
        case 6:
            return 'Project work';
        case 7:
            return 'Rest day';
        default:
            return 'No schedule';
    }
}

/**
 * Returns the scheduled time for a given day.
 *
 * @param int $day_num The day number, from 1 (Monday) to 7 (Sunday).
 * @return string The scheduled time or "TBD" for invalid input.
 */

function fn_dayTime(int $day_num): string {
    if ($day_num === 1 || $day_num === 3) {
        return '9:00 AM – 10:20 AM';
    } elseif ($day_num === 2 || $day_num === 4) {
        return '1:00 PM – 2:50 PM';
    } elseif ($day_num === 5) {
        return '10:00 AM – 11:00 AM';
    } elseif ($day_num === 6 || $day_num === 7) {
        return 'Flexible';
    } else {
        return 'TBD';
    }
}
