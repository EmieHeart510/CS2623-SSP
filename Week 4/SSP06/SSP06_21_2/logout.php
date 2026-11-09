<?php
/*
 * logout.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Exercise 21-2: Login & Authentication
 *
 * Purpose: Logs the user out by clearing and destroying
 * the current session, then redirects to the login page.
 */

session_start();

session_unset();
session_destroy();

header('Location: login.php');
exit;