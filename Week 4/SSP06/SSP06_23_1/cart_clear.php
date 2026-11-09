<?php
/*
 * cart_clear.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Exercise 23-1: Product Catalog & Shopping Cart
 *
 * Purpose: Clears the shopping cart and redirects
 * the user back to the product catalog.
 */

session_start();

// Clear the shopping cart.
unset($_SESSION['cart']);

// Redirect back to the product catalog.
header('Location: index.php');
exit;
