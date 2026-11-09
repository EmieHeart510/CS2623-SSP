<?php
session_start();

/*
 * index.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP07
 * Exercise 15-1: Regex & Exception Handling
 *
 * Purpose: Demonstrates PHP input validation using
 * filter_var(), preg_match(), and exception handling.
 */


// Custom exception classes.
class ValidationException extends RuntimeException {}

class FormatException extends ValidationException {}

class DatabaseException extends RuntimeException {}

// Validate the submitted contact information.
function validateContact($data) {
    $errors = array();
    $formatErrors = array();

    // Set default values to prevent undefined index notices.
    $email = isset($data['email']) ? $data['email'] : '';
    $phone = isset($data['phone']) ? $data['phone'] : '';
    $zip = isset($data['zip']) ? $data['zip'] : '';
    $quantity = isset($data['quantity']) ? $data['quantity'] : '';
    $website = isset($data['website']) ? $data['website'] : '';
    $productCode = isset($data['product_code']) ? $data['product_code'] : '';

    // Validate email address.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    // Validate US phone number.
    if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
        $errors[] = 'Phone must be in format 555-555-5555.';
    }

    // Validate ZIP code.
    if (!preg_match('/^\d{5}(-\d{4})?$/', $zip)) {
        $errors[] = 'ZIP must be 5 digits or ZIP+4 (e.g. 74103 or 74103-1234).';
    }

    // Validate quantity as an integer.
    if (filter_var($quantity, FILTER_VALIDATE_INT) === false) {
        $errors[] = 'Quantity must be a valid whole number.';
    }

    // Validate website URL.
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
        $errors[] = 'Invalid website URL.';
    }

    // Validate product code (two uppercase letters and four digits).
    if (!preg_match('/^[A-Z]{2}\d{4}$/', $productCode)) {
        $formatErrors[] = 'Product code must contain two uppercase letters followed by four digits.';
    }

    // Combine all validation errors.
    $allErrors = array_merge($errors, $formatErrors);

    // Throw an exception if validation errors were found.
    if (!empty($allErrors)) {

        // Use FormatException if the product code is invalid.
        if (!empty($formatErrors)) {
            throw new FormatException(implode(' | ', $allErrors));
        }

        // Otherwise, use the general validation exception.
        throw new ValidationException(implode(' | ', $allErrors));
    }

    return $data;
}


// Retrieve saved results from the session.
$result = isset($_SESSION['form_result']) ? $_SESSION['form_result'] : null;
$errMsg = isset($_SESSION['form_error']) ? $_SESSION['form_error'] : null;

// Clear the session values after retrieving them.
unset($_SESSION['form_result']);
unset($_SESSION['form_error']);

// Process the submitted form.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve the original submitted form values.
    $raw = array(
        'email' => filter_input(INPUT_POST, 'email'),
        'phone' => filter_input(INPUT_POST, 'phone'),
        'zip' => filter_input(INPUT_POST, 'zip'),
        'website' => filter_input(INPUT_POST, 'website'),
        'product_code' => filter_input(INPUT_POST, 'product_code'),
        'notes' => filter_input(INPUT_POST, 'notes'),
        'message' => filter_input(INPUT_POST, 'message'),
        'quantity' => filter_input(INPUT_POST, 'quantity')
    );

    try {
        $result = validateContact($raw);

    } catch (FormatException $e) {
        $errMsg = $e->getMessage();

    } catch (ValidationException $e) {
        $errMsg = $e->getMessage();

    } catch (DatabaseException $e) {
        $errMsg = 'Database error: ' . $e->getMessage();

    } catch (RuntimeException $e) {
        $errMsg = 'System error: ' . $e->getMessage();

    } finally {
        // Record when the form was processed.
        error_log('Contact form processed at ' . date('Y-m-d H:i:s'));
    }

    // Save the results in the session.
    if ($result !== null) {
        $_SESSION['form_result'] = $result;
    }

    if ($errMsg !== null) {
        $_SESSION['form_error'] = $errMsg;
    }

    // Redirect to prevent form resubmission on refresh.
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP07 Exercise 15-1">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP07 Exercise 15-1: Taylor</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/ValidationStyle.css">
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
                Exercise 15-1: Regular Expressions (Regex) & Exception Handling
            </h1>
        </header>




        <h2>You can enter some contact information below.</h2>
        <h2>The form will validate the input and display any errors or a success message.</h2>

        <div class="validation-form-wrapper">

            <?php if ($errMsg !== null): ?>
                <div class="error">
                    <h3>Validation Errors</h3>
                    <ul>
                        <?php
                        // Separate the validation errors.
                        $errorList = explode(' | ', $errMsg);

                        foreach ($errorList as $error) {
                            echo '<li>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($result !== null): ?>
                <div class="success">
                    <h3>Validation Successful!</h3>

                    <p>
                        <strong>Email:</strong>
                        <?php echo htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        <strong>Phone:</strong>
                        <?php echo htmlspecialchars($result['phone'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        <strong>ZIP Code:</strong>
                        <?php echo htmlspecialchars($result['zip'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        <strong>Quantity:</strong>
                        <?php echo htmlspecialchars($result['quantity'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        <strong>Website:</strong>
                        <?php echo htmlspecialchars($result['website'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        <strong>Product Code:</strong>
                        <?php echo htmlspecialchars($result['product_code'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        <strong>Notes:</strong><br>
                        <?php echo nl2br(htmlspecialchars($result['notes'], ENT_QUOTES, 'UTF-8')); ?>
                    </p>

                    <p>
                        <strong>Message:</strong><br>
                        <?php echo nl2br(htmlspecialchars($result['message'], ENT_QUOTES, 'UTF-8')); ?>
                    </p>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php">

                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
                <br>

                <label for="phone">Phone (555-555-5555):</label>
                <input type="text" id="phone" name="phone">
                <br>

                <label for="zip">ZIP Code:</label>
                <input type="text" id="zip" name="zip">
                <br>

                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity">
                <br>

                <label for="website">Website URL:</label>
                <input type="text" id="website" name="website">
                <br>

                <label for="product_code">Product Code (AB1234):</label>
                <input type="text" id="product_code" name="product_code">
                <br>

                <label for="notes">Notes:</label>
                <textarea id="notes" name="notes" rows="4" cols="40"></textarea>
                <br>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" cols="40"></textarea>
                <br>

                <button type="submit">Validate</button>

            </form>
        </div>

        <div>
            <h3><a href="../index.php">&lt;&lt;&lt; Back to SSP07 Landing Page</a></h3>
        </div>
    </main>

</div>

<!-- Footer -->
<?php include '../../../Week 1/SSP02/PHP/include_footer.php'; ?>

</body>
</html>

