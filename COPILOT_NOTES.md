# COPILOT_NOTES.md — CS 2623 Week 1

## Accepted

- Copilot suggested using a flexbox column layout for the overall page structure — accepted as-is. 
I used `display: flex` and `flex-direction: column` on the `body` element so the header, navigation, 
main content, and footer can be arranged vertically.

- Copilot suggested replacing the placeholder content in `SSP02.php` with a semantic planner 
table using `<caption>`, `<thead>`, `<tbody>`, and `<th scope="col">` — accepted as-is. The result 
presents the three required columns, provides an accessible table caption, and associates each header with its column.

- Copilot suggested documenting both sides of the implementation with an HTML comment before 
the table and a PHP comment before the loop — accepted as-is. The HTML comment identifies the rendered weekly planner, 
while the PHP comment explains that the loop covers days 1 through 7 and calculates the corresponding study hours.

## Rejected

- Copilot suggested using a fixed-width layout — rejected. 
I kept the layout flexible so the page can adapt to different screen sizes instead of requiring a fixed viewport width.

- Copilot suggested using `include "PHP/include_dynamic_content.php";` to load the dynamic planner — rejected. 
I replaced it with `<?php require_once __DIR__ . "/PHP/include_dynamic_content.php"; ?>` in `SSP02.php` 
because `__DIR__` resolves the path from the current file's directory and `require_once` prevents the same 
file from being included more than once.

## Improved

- Copilot suggested moving the main content with a large fixed `top` offset. 
I improved the layout by using a flexbox column layout on `body`, centering the horizontal navigation with flexbox, 
and positioning the left navigation relative to the `#wrapper` container. This avoids relying on a large fixed 
offset to arrange the page content and keeps the navigation and main content organized.

- Copilot initially suggested generating the table rows using `echo` statements without escaping the 
dynamically generated counter and hours. I improved the code by wrapping the counter and formatted hours 
`htmlspecialchars()` with `ENT_QUOTES` and `"UTF-8"`. This follows the assignment's security requirements and 
helps prevent dynamically generated values from being interpreted as HTML.

## Require vs. Include in PHP

Both `require()` and `include()` load and execute another PHP file in the current script. 
The difference is how they handle errors when the requested file cannot be found: `require()` 
produces a fatal error and stops the script, while `include()` produces a warning and allows 
the script to continue running. Use `require()` when the file is essential to the application, and use `include()`
when the file is optional.
