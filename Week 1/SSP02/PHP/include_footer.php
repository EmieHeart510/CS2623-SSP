<?php
/*
 * include_footer.php
 * CS2623 - Server-Side Programming
 * SSP02
 * Purpose: Displays the footer of the page.
 *
 */
        // Get the last modified date of the current script
        $lastModified = date("F j, Y g:i a", filemtime($_SERVER['SCRIPT_FILENAME'])
        );
    ?>
<footer>
    <p>
        Last modified:
        <?php
        echo htmlspecialchars($lastModified, ENT_QUOTES, "UTF-8");
        ?>
    </p>
    <p>
        Disclaimer: Oklahoma City Community College does not
        necessarily endorse the content or the respective links
        of this web page.
    </p>
</footer>
