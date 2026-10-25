# COPILOT_NOTES.md — CS 2623 Week 2 : SSP03

## Accepted

- Copilot implemented `fn_tableOpen()` with the required table attributes, escaped caption, dark-blue caption row, 
and teal column-header row.

- Copilot implemented `fn_tableClose()` using an echo statement to output the closing `</table>` tag.

- Copilot implemented `fn_dayDetails()` with a switch statement and the seven required schedule descriptions, 
including the `"No schedule"` default.

- Copilot implemented `fn_tableRow()` with three table cells and `htmlspecialchars()` applied to the day, 
details, and time values.

## Rejected

- Copilot suggested using `match` for `fn_dayOfWeek()`. This suggestion was rejected because the assignment 
explicitly requires an if/elseif chain.

- Copilot suggested relying on the server's default timezone for the weekly planner. 
This suggestion was rejected because the assignment requires `DateTimeZone('America/Chicago')` to calculate 
the current day correctly on Apollo.

## Improved

- Copilot implemented `fn_tableRowCurrent()` with escaped values and the required yellow background (`#FFFF66`). 
The implementation was reviewed to ensure all three displayed values were escaped using `htmlspecialchars()`.

- Copilot implemented the weekly planner loop in `index.php`. The implementation was improved by using 
the required `for` loop from 1 through 7, converting the current day to an integer, and highlighting the 
matching day's row.
