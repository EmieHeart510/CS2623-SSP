# COPILOT_NOTES.md — CS 2623 Week 4 : SSP06 & SSP07

## SSP07 EX 11-1

### Accepted

- AI suggested using PHP's array_map() and array_filter() functions to process and filter array information — accepted.
  I used these functions to work with the product data instead of relying entirely on manual loops.

### Rejected

- AI suggested using a loose comparison with in_array() when searching the array — rejected.
  I used strict comparison instead so PHP checks both the value and its data type.

### Improved

- I improved the search functionality by validating the search input before using it to search the array.
- I used sort() to organize the array values.
- I improved the product catalog output by escaping displayed values and formatting currency appropriately.

## SSP07 EX 15-2

### Accepted

- AI suggested using PHP's filter_var() function with FILTER_VALIDATE_EMAIL to validate email addresses — accepted.
  I used PHP's built-in email validation instead of relying on a custom email regular expression.
- AI suggested creating custom exception classes for handling different validation errors — accepted.
  I created ValidationException and FormatException to handle validation and product-code format errors separately.

### Rejected

- AI suggested using strip_tags() to clean submitted text before displaying it — rejected.
  I used htmlspecialchars() instead because removing HTML tags alone does not provide proper output escaping.

### Improved

- I used regular expressions to validate phone numbers, ZIP codes, and product codes. The product code requires two uppercase letters followed by four digits, such as AB1234.
- I improved exception handling by catching FormatException before its parent ValidationException.
- I used htmlspecialchars() when displaying exception messages and submitted text.
- I used nl2br() with htmlspecialchars() to preserve line breaks in multiline text while keeping the output escaped.

## SSP06 EX 21-2

### Accepted

- AI suggested using password_hash() with PASSWORD_DEFAULT to store passwords securely — accepted.
  I used password hashing rather than storing plain-text passwords.
- AI suggested using password_verify() to authenticate users — accepted.
  I used it to compare submitted passwords against the stored password hashes.

### Rejected

- AI suggested comparing the submitted password directly against a hardcoded password — rejected.
  I used password_verify() instead so the application checks the password against its stored hash.

### Improved

- I added session_regenerate_id(true) after a successful login to help protect against session fixation.
- I protected the dashboard and profile pages by including auth.php, which redirects users who are not logged in to the login page.
- I added a remember-me feature that stores the username in a cookie rather than storing the password.
- I improved login security by tracking failed attempts and locking the user out for five minutes after three unsuccessful attempts.
- I used the logout page to clear the session and redirect the user to the login page.

## SSP06 EX 21-3

### Accepted

- AI suggested using filter_input() with FILTER_VALIDATE_INT to validate submitted product IDs — accepted.
  I used it to validate the product ID instead of directly trusting the submitted POST value.
- AI suggested using a session array to maintain shopping cart information — accepted.
  I used $_SESSION to preserve cart contents while navigating the page.

### Rejected

- AI suggested using the null coalescing assignment operator (??=) to initialize the shopping cart — rejected.
  I kept the initialization compatible with PHP 5.5.12 because this operator is not supported by the version running on Apollo.

### Improved

- I used a POST-redirect-GET flow after cart actions so refreshing the page would not repeat the previous POST request.
- I calculated the running cart item count, individual item subtotals, and overall total using the product quantities and prices stored in the session.
- I kept the clear-cart action in a separate cart_clear.php file. It removes the cart data from the session and redirects back to index.php.

## PHP 5 Compatibility Updates for OCCC's Apollo Server

- Kept the shopping cart initialization and other PHP syntax compatible with the PHP 5.5.12 environment on Apollo.
- Avoided using the null coalescing assignment operator (??=) because it is not supported by the PHP version running on Apollo.
- Preserved the authentication, session, validation, and shopping cart functionality while making sure the code worked with the older PHP environment.
- Continued using PHP functions supported by Apollo, including filter_input(), password_hash(), password_verify(), and session handling functions.