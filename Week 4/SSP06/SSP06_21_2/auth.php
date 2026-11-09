<?php
session_start();

/*
 * auth.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Exercise 21-2: Login & Authentication
 *
 * Purpose: Protects pages that require user authentication.
 * Checks whether a user is logged in and redirects
 * unauthorized users to the login page.
 */

if (!isset($_SESSION['user'])) {
    header('Location: ../SSP06_21_2/login.php');
    exit();
}