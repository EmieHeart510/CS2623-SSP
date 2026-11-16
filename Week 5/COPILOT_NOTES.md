# COPILOT_NOTES.md — CS 2623 Week 5 : SSP08 & SSP09

## SSP08 EX 03-1

### Accepted

- AI suggested using functions to organize repeated tasks — accepted.
  I used functions for FizzBuzz, day-of-the-week lookup, and grade lookup to make the code easier to organize and reuse.
- AI suggested using different loop structures — accepted.
  I used for, while, and do-while loops to practice repeating instructions under different conditions.

### Rejected

- AI suggested adding PHP 8 return type declarations — rejected.
  I kept the functions compatible with PHP 5.5.12 because that is the version running on Apollo.

### Improved

- I added htmlspecialchars() when displaying dynamic output to help prevent cross-site scripting (XSS).
- I used session messages and a POST-redirect-GET approach to prevent form submissions from repeating when the page is refreshed.

## SSP08 EX 16-1

### Accepted

- AI suggested using file_put_contents() with FILE_APPEND to save log entries — accepted.
  I used it to add new entries without overwriting existing log contents.
- AI suggested using scandir() to display the contents of the data directory — accepted.
  I used it with is_file() to list the files stored in the directory.

### Rejected

- AI suggested creating a separate form for the Clear Log button — rejected.
  I kept the Save Entry and Clear Log buttons in the same form so both actions could be handled together.

### Improved

- I used isset() to distinguish between Save Entry and Clear Log button submissions.
- I added file locking with LOCK_EX when writing to the log file.
- I added a download option so the log file could be downloaded.
- I used htmlspecialchars() when displaying log contents and file information.

## SSP09 EX 17-1

### Accepted

- AI suggested using str_contains() to check whether submitted text contains a search term — accepted.
  I also used str_starts_with() and str_ends_with() to check the beginning and ending of the text.
- AI suggested using number_format() to format currency values — accepted.
  I used it to display numbers with commas and two decimal places.

### Rejected

- AI suggested using PHP 8-only functions without compatibility support — rejected.
  I needed the exercise to remain compatible with PHP 5.5.12 on Apollo.

### Improved

- rand($min, $max) — Replaced with random_int($min, $max) to generate more secure random numbers, with a PHP 5.5-compatible fallback.
- date('Y-m-d') without a timezone — Replaced with DateTime and DateTimeZone('America/Chicago') to display the correct local date and time.
- strpos() !== false — Replaced with str_contains() using a compatibility function for the older PHP environment.
- I used str_replace() to replace vowels with asterisks and substr() to display the first 10 characters.
- I used sprintf('%10.2f', $amount) to demonstrate number padding.
- I used DateTime::diff() to calculate the number of days since January 1.

## PHP 5 Compatibility Updates for OCCC's Apollo Server

- Kept the exercises compatible with the PHP 5.5.12 environment running on Apollo.
- Added compatibility functions for str_contains(), str_starts_with(), and str_ends_with(), which are not natively available in PHP 5.5.12.
- Added a PHP 5.5-compatible fallback for random_int() using OpenSSL.
- Avoided relying on PHP 8-only syntax and features while preserving the required exercise functionality.
- Continued using htmlspecialchars() to help protect displayed output from XSS.
