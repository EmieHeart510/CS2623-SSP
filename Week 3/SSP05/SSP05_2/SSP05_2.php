<?php
session_start();

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

if ($method === null) {
    $method = 'GET';
}

$cust_name = '';
$product = '';
$quantity = 1;
$options = [];
$instructions = '';
$payment = '';

if ($method === 'POST') {

    //Reads the form data
    $cust_name = filter_input(INPUT_POST, 'cust_name');
    $product = filter_input(INPUT_POST, 'product');

    if ($cust_name === null) {
        $cust_name = '';
    }

    if ($product === null) {
        $product = '';
    }

    //Validates the quantity
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if ($quantity === false || $quantity === null || $quantity < 1) {
        $quantity = 1; // Default to 1 if invalid
    }

    //Reads the payment method
    $payment = filter_input(INPUT_POST, 'payment');

    if ($payment === null) {
        $payment = 'none';
    }

    //Reads special instructions
    $instructions = filter_input(INPUT_POST, 'instructions');

    if ($instructions === null) {
        $instructions = '';
    }

    //Checkbox array
    $options = filter_input(INPUT_POST, 'options', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

    if ($options === null || $options === false) {
        $options = [];
    }

    $_SESSION['order'] = [
            'cust_name' => $cust_name,
            'product' => $product,
            'quantity' => $quantity,
            'options' => $options,
            'instructions' => $instructions,
            'payment' => $payment
    ];

    //Redirect to prevent form resubmission on page refresh
    header('Location: SSP05_2.php');
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP05 Exercise 7-2">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP05 Exercise 7-2: Taylor</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/Formstyle.css">
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
                Exercise 7-2: Product Order Form
            </h1>
        </header>

        <h2>This exercise will allow you to submit a product order form.</h2>

        <div class="form-wrapper">

            <form method="post">

                <!-- Customer Name -->
                <label for="cust_name">Customer Name:</label>
                <input type="text" id="cust_name" name="cust_name" required>

                <br>
                <br>

                <!-- Product -->
                <label for="product">Select a Product:</label>
                <select id="product" name="product" required>
                    <option value="">--Select a product--</option>
                    <option value="Keyboard - $49.99">Keyboard - $49.99</option>
                    <option value="Mouse - $29.99">Mouse - $29.99</option>
                    <option value="Headset - $59.99">Headset - $59.99</option>
                    <option value="Monitor Stand - $39.99">Monitor Stand - $39.99</option>
                </select>

                <br>
                <br>

                <!-- Quantity -->
                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" required>

                <br>
                <br>

                <!-- Add-On Options -->
                <p>Select Additional Options:</p>

                <div class="checkbox-group">

                    <div class="checkbox-option">
                        <input type="checkbox" id="gift_wrap" name="options[]" value="Gift Wrap">
                        <label for="gift_wrap">Gift Wrap</label>
                    </div>

                    <div class="checkbox-option">
                        <input type="checkbox" id="insurance" name="options[]" value="Package Insurance">
                        <label for="insurance">Package Insurance</label>
                    </div>

                    <div class="checkbox-option">
                        <input type="checkbox" id="express_ship" name="options[]" value="Express Shipping">
                        <label for="express_ship">Express Shipping</label>
                    </div>

                </div>


                <br>
                <br>

                <!-- Special Instructions -->
                <label for="instructions">Special Instructions:</label>

                <br>

                <textarea id="instructions" name="instructions" rows="4" cols="40">
                </textarea>


                <br>
                <br>

                <!-- Payment Method -->
                <!-- Payment Method -->
                <p>Select Payment Method:</p>

                <div class="radio-group">

                    <div class="radio-option">
                        <input type="radio" id="credit" name="payment" value="Credit" required>
                        <label for="credit">Credit Card</label>
                    </div>

                    <div class="radio-option">
                        <input type="radio" id="debit" name="payment" value="Debit">
                        <label for="debit">Debit Card</label>
                    </div>

                    <div class="radio-option">
                        <input type="radio" id="paypal" name="payment" value="PayPal">
                        <label for="paypal">PayPal</label>
                    </div>

                </div>

                <br>
                <br>

                <button type="submit">Submit Order</button>

            </form>

        </div>
        <?php if (isset($_SESSION['order'])): ?>

            <?php
            $order = $_SESSION['order'];
            unset($_SESSION['order']);// Clear the order data from the session after hitting the refresh button
            ?>

            <div class="summary-wrapper">
                <h2>Order Summary</h2>

                <p>
                    Customer Name:
                    <?php echo htmlspecialchars($order['cust_name'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>
                    Product:
                    <?php echo htmlspecialchars($order['product'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>
                    Quantity:
                    <?php echo htmlspecialchars((string)$order['quantity'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>
                    Payment Method:
                    <?php echo htmlspecialchars($order['payment'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p><strong>Selected Options:</strong></p>

                <div class="selected-options">
                    <?php foreach ($order['options'] as $opt): ?>
                        <span class="option-tag"><?php
                            echo htmlspecialchars($opt, ENT_QUOTES, 'UTF-8');
                            ?></span>
                    <?php endforeach; ?>
                </div>

                <p>
                    <strong>Special Instructions:</strong><br>
                    <?php echo nl2br(htmlspecialchars($order['instructions'], ENT_QUOTES, 'UTF-8')); ?>
                </p>
            </div>
        <?php endif; ?>

        <div>
            <h3><a href="../index.php">&lt;&lt;&lt; Back to SSP05 Landing Page</a></h3>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>