<?php
/*
 * include_header.php
 * CS2623 - Server-Side Programming
 * SSP02
 * Purpose: Displays the page header and server name.
 *
 */
?>
<header>
    <h1>
        CS2623 <?php
            echo htmlspecialchars(
                    isset($_SERVER['SERVER_NAME'])
                            ? $_SERVER['SERVER_NAME']
                            : "Server-Side Programming",
            ENT_QUOTES,
            "UTF-8"
            );
        ?></h1>
</header>
