<?php
/*
 * include_dynamic_content.php
 * CS2623 - Server-Side Programming
 * SSP02
 * Purpose: Displays dynamic content on the page.
 *
 */
?>
<!-- HTML section: display the CS2623 weekly study planner. -->
<table id="weekly-planner">
    <caption>CS2623 Weekly Planner — Ashley Taylor</caption>
    <thead>
        <tr>
            <th scope="col">Day of Week</th>
            <th scope="col">Task</th>
            <th scope="col">Time (hrs.)</th>
        </tr>
    </thead>
    <tbody>
        <!-- PHP section: generate one row for each day of the week. -->
        <?php
        // Loop through days 1 through 7 and calculate half the day number in hours.
        for ($counter = 1; $counter < 8; $counter++) {

            // Calculate half the day number in hours.
            $hours = number_format($counter / 2, 1);

            // Display the table row with the day of the week, task, and time in hours.
            echo "<tr>";
            echo "<td>" . htmlspecialchars((string)$counter, ENT_QUOTES, "UTF-8") . "</td>";
            echo "<td>Study for CS2623</td>";
            echo "<td>" . htmlspecialchars($hours, ENT_QUOTES, "UTF-8") . "</td>";
            echo "</tr>\n";
        }
        ?>
    </tbody>
</table>
