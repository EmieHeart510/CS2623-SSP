# COPILOT_NOTES.md — CS 2623 Week 2 : SSP04

## Accepted

- Copilot suggested using PHP string functions to demonstrate common string operations — accepted. 
I used `str_replace()` to replace a word, `str_contains()` to check whether a string contains a keyword, 
`strtolower()` and `strtoupper()` to change letter case, `strlen()` to calculate string length, 
and `substr()` to extract part of a string.

- Copilot suggested formatting numeric values for display — accepted. I used `sprintf()` to format a price 
to two decimal places and `number_format()` to add thousands separators to a large number. 
This makes the displayed values easier to read.

- Copilot suggested using PHP's `DateTime` and `DateTimeZone` classes to work with dates and times — accepted. 
I used the `America/Chicago` time zone and `DateTime::format()` to display the current date, day of the week, 
and time in a readable format.

- Copilot suggested using `DateTime::diff()` to calculate elapsed time and a countdown — accepted. 
I used it to calculate the elapsed time since a sample birthdate and the number of days remaining until the semester end date.

## Rejected

- Copilot suggested displaying dynamically generated values without converting them to strings before 
passing them to `htmlspecialchars()` — rejected. PHP can raise a `TypeError` when an integer is passed 
where a string is expected. I converted `$age_years` and `$age_days` to strings using `(string)` before escaping them.

- Copilot suggested using a hard-coded page layout that would not account 
for the existing shared site structure — rejected. I kept the shared header, top navigation, 
left navigation, footer, and stylesheet links consistent with the other exercises in the project.

## Improved

- I improved the output by using `htmlspecialchars()` with `ENT_QUOTES` and `'UTF-8'` when displaying 
dynamic values. This helps prevent values from being interpreted as HTML and follows safer output-handling practices.

- I improved the date and time exercise by checking whether `DateTime::createFromFormat()` successfully parsed a date. 
If parsing fails, the code throws a `RuntimeException` instead of continuing with an invalid date.

- I improved the semester countdown by checking whether the semester end date is still in the future. 
If the date has passed, the page displays a message instead of showing a negative countdown.

- During testing, I encountered an `Undefined constant "now"` error because a variable reference was 
missing its `$` symbol. I corrected the variable reference and tested the page again.

## PHP DateTime and DateInterval

PHP's `DateTime` class represents a date and time, while `DateTimeZone` specifies the time zone used for 
date calculations and display. The `format()` method converts a date or time into a readable string.
`DateTime::createFromFormat()` parses a date from a string that follows a specified format, and `diff()` calculates 
the difference between two dates. The resulting `DateInterval` provides information such as the number of years and 
the total number of days between dates.

## PHP String Functions

PHP provides built-in string functions for searching, replacing, converting, measuring, and extracting text. 
`str_replace()` replaces matching text, `str_contains()` checks whether a string contains a specified substring, 
`strtolower()` and `strtoupper()` change letter case, `strlen()` returns the string length, and `substr()` extracts 
part of a string. `sprintf()` formats values into a string, while `number_format()` formats numbers for easier reading.

## PHP 5 Compatibility Updates for OCCC's Apollo Server

- Removed `declare(strict_types=1);` from `ex1_strings.php` and `ex2_datetime.php` to improve compatibility with 
the older PHP environment on the Apollo server.

- Replaced `str_contains($description, $keyword)` with `strpos($description, $keyword) !== false` in 
`ex1_strings.php` because `str_contains()` is unavailable in older PHP versions. The replacement checks whether 
the keyword occurs in the description.

- Preserved the intended string-search behavior while using a function supported by older PHP versions.

- These changes were made in response to compatibility errors encountered on the Apollo server. The exact PHP 
version running on the server has not yet been confirmed.
