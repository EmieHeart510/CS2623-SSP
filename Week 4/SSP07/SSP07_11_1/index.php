<?php
session_start();

/*
 * index.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP07
 * Exercise 11-1: Arrays
 *
 * Purpose: Demonstrates PHP array creation and manipulation.
 * Uses array_map(), array_filter(), sort(), count(), and
 * in_array() to process and display fruit information.
 * Includes a search form with input validation, alphabetical
 * sorting, and a product catalog using arrays of arrays.
 */


// Creates an array of fruits.
$fruits = array('apple', 'banana', 'cherry', 'date', 'elderberry');

// Converts each fruit name to uppercase.
$upper = array_map(function($f) {
    return strtoupper($f);
}, $fruits);

// Filter fruits with six or more characters.
$filtered = array_filter($fruits, function ($fruit) {
    return strlen($fruit) >= 6;
});

// Sort fruits alphabetically.
$sorted = $fruits;
sort($sorted);

// Get the submitted search value.
$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);

if ($search === null || $search === false) {
    $search = '';
}

// Initialize the search message and sorting display.
$message = '';
$showSorted = false;

// Process form submissions.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['sort'])) {

        // Remember that the sorted list should be displayed.
        $_SESSION['show_sorted'] = true;

    } else {

        // Validate the submitted search.
        if (!ctype_alpha($search) && $search !== '') {
            $_SESSION['message'] = 'Please enter letters only.';
        } elseif ($search !== '') {

            $found = in_array($search, $fruits, true);

            $_SESSION['message'] = $found
                    ? "Found: $search"
                    : "Not found: $search";
        }
    }

    // Redirect to prevent form resubmission.
    header('Location: index.php');
    exit();
}

// Retrieve the results after redirecting.
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if (isset($_SESSION['show_sorted'])) {
    $showSorted = true;
    unset($_SESSION['show_sorted']);
}

// Create an array of arrays to simulate database records.
$catalog = array(
    array('id' => 1, 'name' => 'Apple', 'price' => 1.29),
    array('id' => 2, 'name' => 'Banana', 'price' => 0.49),
    array('id' => 3, 'name' => 'Cherry', 'price' => 2.99),
    array('id' => 4, 'name' => 'Dragon Fruit', 'price' => 4.99)
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP07 Exercise 11-1">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP07 Exercise 11-1: Taylor</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/ArrayStyle.css">
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
                        Exercise 11-1: Arrays - Fruit Information
                    </h1>
                </header>

                <div class="form-wrapper">

            <!-- Search Form -->
            <form method="post" action="index.php">

                <label for="search">Search fruit:</label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
                >

                <button type="submit">Search</button>
                <button type="submit" name="sort" value="1">Sort A→Z</button>

            </form>

            <?php if ($message !== ''): ?>
                <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <h2>Original Fruit List (<?php echo count($fruits); ?> items)</h2>

            <ul>
                <?php foreach ($fruits as $fruit): ?>
                    <li><?php echo htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>

            <h2>Uppercase Fruit List</h2>

            <ul>
                <?php foreach ($upper as $fruit): ?>
                    <li><?php echo htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>



            <h2>Filtered Fruit List (6 or More Characters)</h2>

            <ul>
                <?php foreach ($filtered as $fruit): ?>
                    <li>
                        <?php echo htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8'); ?>
                    </li>
                <?php endforeach; ?>

            </ul>


                <?php if ($showSorted): ?>

                    <h2>Alphabetically Sorted Fruit List</h2>

                    <ul>
                        <?php foreach ($sorted as $fruit): ?>
                            <li><?php echo htmlspecialchars($fruit, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>

                <?php endif; ?>

            <h2>Product Catalog</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>

                <?php foreach ($catalog as $product): ?>
                    <tr>
                        <td><?php echo (int)$product['id']; ?></td>
                        <td><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>$<?php echo number_format($product['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>

        <div>
            <h3><a href="../index.php">&lt;&lt;&lt; Back to SSP07 Landing Page</a></h3>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>
