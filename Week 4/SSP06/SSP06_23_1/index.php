<?php
/*
 * index.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Exercise 23-1: Product Catalog & Shopping Cart
 *
 * Purpose: Displays a product catalog and allows
 * authenticated users to manage a shopping cart.
 */

// Require login before accessing the shopping cart.
require '../SSP06_21_2/auth.php';

// Product catalog — simulates a database query.
$products = [
    1 => ['id' => 1, 'name' => 'Fender Stratocaster', 'price' => 499.99],
    2 => ['id' => 2, 'name' => 'Gibson Les Paul', 'price' => 799.99],
    3 => ['id' => 3, 'name' => 'Martin D-28 Acoustic', 'price' => 1299.99],
    4 => ['id' => 4, 'name' => 'Ibanez RG550', 'price' => 299.99]
];

// Initialize the shopping cart if one does not exist.
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle Add to Cart and Remove One form submissions.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $remove_id = filter_input(INPUT_POST, 'remove_id', FILTER_VALIDATE_INT);

    if ($remove_id !== null && $remove_id !== false && isset($_SESSION['cart'][$remove_id])) {

        // Remove one from the product quantity.
        $_SESSION['cart'][$remove_id]--;

        // If the quantity reaches zero, remove the product from the cart.
        if ($_SESSION['cart'][$remove_id] <= 0) {
            unset($_SESSION['cart'][$remove_id]);
        }
    } else {
        $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

        if ($id !== null && $id !== false && isset($products[$id])) {

            // Add one to the product quantity.
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]++;
            } else {
                $_SESSION['cart'][$id] = 1;
            }
        }
    }

    // Redirect to prevent duplicate form submissions.
    header('Location: index.php');
    exit;
}

$item_count = 0;
foreach ($_SESSION['cart'] as $qty) {
    $item_count += $qty;
}

// Calculate the shopping cart total.
$total = 0.0;

foreach ($_SESSION['cart'] as $pid => $qty) {

    if (isset($products[$pid])) {
        $total += $products[$pid]['price'] * $qty;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP06 Exercise 23-1">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP06 Exercise 23-1: Taylor</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/ShopStyle.css">
    <script src="JS/cartScroll.js" defer></script>
</head>
<body>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_header.php";
require_once __DIR__ . "/../Nav/include_topNav.php";
?>

<div id="wrapper">

        <?php
        require_once __DIR__ . "/../Nav/include_leftNav.php";
        ?>

        <main>

                    <header>
                        <h1>
                            Exercise 23-1: Catalog & Shopping Cart
                        </h1>
                        <h1>
                            Guitar Shop - Welcome,
                            <?php echo htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8'); ?>!
                        </h1>
                    </header>

            <div class="form-wrapper">

                <h2>Product Catalog</h2>

                <?php foreach ($products as $p): ?>

                    <div class="product">

                        <h3><?php echo htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8'); ?></h3>

                        <p>Price: $<?php echo number_format($p['price'], 2); ?></p>

                        <form method="post" action="index.php">

                            <input type="hidden" name="product_id"
                                   value="<?php echo (int)$p['id']; ?>">

                            <button type="submit">Add to Cart</button>

                        </form>

                    </div>

                <?php endforeach; ?>
                <div id="cart">
                    <h2>Cart (<?php echo (int)$item_count; ?> items)</h2>

                    <?php if (empty($_SESSION['cart'])): ?>

                        <p>Your cart is empty.</p>

                    <?php else: ?>

                        <table>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>

                            <?php foreach ($_SESSION['cart'] as $pid => $qty): ?>

                                <?php if (isset($products[$pid])): ?>

                                    <tr>
                                        <td>
                                            <?php echo htmlspecialchars(
                                                $products[$pid]['name'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ); ?>
                                        </td>

                                        <td>

                                            <form method="post" action="index.php">
                                                <input type="hidden" name="remove_id"
                                                       value="<?php echo (int)$pid; ?>">

                                                <button type="submit">-</button>
                                            </form>

                                            <?php echo (int)$qty; ?>

                                            <form method="post" action="index.php">
                                                <input type="hidden" name="product_id"
                                                       value="<?php echo (int)$pid; ?>">

                                                <button type="submit">+</button>
                                            </form>
                                        </td>

                                        <td>
                                            $<?php echo number_format(
                                                $products[$pid]['price'] * $qty,
                                                2
                                            ); ?>
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            <?php endforeach; ?>

                            <tr>
                                <td colspan="2"><strong>Total</strong></td>
                                <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                            </tr>
                        </table>

                    <?php endif; ?>

                    <a href="cart_clear.php">Clear Cart</a>
                </div>
            </div>

            <div class="navigation-buttons">

                <a href="../SSP06_21_2/dashboard.php">Return to Dashboard</a>

                <a href="../SSP06_21_2/logout.php" class="logout-button">Logout</a>

            </div>
            <div>
                <h3><a href="../index.php">&lt;&lt;&lt; Back to SSP06 Landing Page</a></h3>
            </div>

        </main>
</div>

</body>
</html>
