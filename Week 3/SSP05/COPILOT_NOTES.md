# COPILOT_NOTES.md — CS 2623 Week 3 : SSP05

## Accepted

- Copilot suggested using PHP's `filter_input()` function to retrieve and validate submitted form data — accepted. 
I used `FILTER_VALIDATE_EMAIL` to validate email addresses and `FILTER_VALIDATE_INT` to validate age and product quantity.

- Copilot suggested using PHP sessions to temporarily store submitted form information — accepted.
I used `$_SESSION` to preserve the submitted information across the redirect and display a submission summary.

- Copilot suggested using `FILTER_REQUIRE_ARRAY` to retrieve multiple checkbox selections — accepted. 
I used it to collect the additional options selected on the product order form.

## Rejected

- Copilot suggested using a separate bootstrap file to route requests to the exercise pages — rejected. 
I kept the original project structure and allowed each PHP file to process its own form submissions. 
The additional routing was unnecessary and introduced changes to existing links and stylesheet paths.

- Copilot suggested changing the existing form layout while making PHP compatibility updates — rejected. 
I preserved the original HTML structure, shared header, top navigation, left navigation, footer, 
and stylesheet links to remain consistent with the other assignments.

## Improved

- I improved the personal information form by validating the email address and age before displaying the submitted information. 
Invalid email addresses and ages display appropriate error messages.

- I improved the product order form by checking that the quantity is a valid integer greater than or equal to one. 
If the submitted quantity is invalid, the application defaults to one.

- I improved output handling by using `htmlspecialchars()` with `ENT_QUOTES` and `'UTF-8'` when displaying submitted values. 
I also used `nl2br()` to preserve line breaks in comments and special instructions.

- I improved the checkbox handling by providing an empty array when no additional options are selected. 
This prevents errors when the checkbox group is submitted without selections.

## PHP 5 Compatibility Updates for OCCC's Apollo Server

- Removed declare(strict_types=1); from SSP05_1.php and SSP05_2.php because the older PHP environment on 
Apollo does not support this PHP 7+ feature.

- Replaced the null coalescing operator (`??`) with conditional statements and `isset()` checks because the 
operator is unavailable in PHP versions older than PHP 7+.

- Preserved the original form processing, validation, session handling, and page layout while making the syntax changes.

- Kept the existing `filter_input()`, array syntax, and other functionality that is supported by the older PHP environment.

- These changes were made to improve compatibility with the older PHP environment on Apollo while preserving the 
intended functionality of both exercises.