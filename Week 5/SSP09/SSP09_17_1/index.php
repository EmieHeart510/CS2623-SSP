<?php
session_start();

/*
    CS2623 - Server-Side Programming
    SSP09 Exercise 17-1: String, Number & Date Functions
    Author: Taylor, Ashley

    Description:
        Demonstrates PHP string manipulation, number formatting,
        random number generation, and date calculations.

        Includes string searching, text replacement, word counting,
        currency formatting, number padding, and DateTime operations.

    PHP Version: Compatible with PHP 5.5.12
*/

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle === '' || strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle) {
        return $needle === '' || strpos($haystack, $needle) === 0;
    }
}

if (!function_exists('str_ends_with')) {
    function str_ends_with($haystack, $needle) {
        if ($needle === '') {
            return true;
        }

        return substr($haystack, -strlen($needle)) === $needle;
    }
}

// PHP 5.5-compatible random_int() using OpenSSL
if (!function_exists('random_int')) {
    function random_int($min, $max) {

        if ($min > $max) {
            throw new Exception('Invalid random integer range.');
        }

        $range = $max - $min + 1;
        $bytes = 1;
        $maxBytes = 256;

        while ($maxBytes < $range) {
            $bytes++;
            $maxBytes *= 256;
        }

        $limit = floor($maxBytes / $range) * $range;

        do {
            $strong = false;
            $randomBytes = openssl_random_pseudo_bytes($bytes, $strong);

            if ($randomBytes === false || !$strong) {
                throw new Exception('Secure random number generation failed.');
            }

            $number = 0;

            for ($i = 0; $i < $bytes; $i++) {
                $number = ($number * 256) + ord($randomBytes[$i]);
            }

        } while ($number >= $limit);

        return $min + ($number % $range);
    }
}

// Timezone setup
$timezone = new DateTimeZone('America/Chicago');

// Default values
$inputText = '';
$searchFor = '';
$inputNum = 0.00;
$submitted = false;
$results = array();

// POST handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputText = filter_input(INPUT_POST, 'text', FILTER_UNSAFE_RAW);
    $searchFor = filter_input(INPUT_POST, 'search', FILTER_UNSAFE_RAW);
    $inputNum = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);

    // Default values
    if ($inputText === null || $inputText === false) {
        $inputText = '';
    }

    if ($searchFor === null || $searchFor === false) {
        $searchFor = '';
    }

    if ($inputNum === null || $inputNum === false) {
        $inputNum = 0.00;
    }

    $inputText = trim($inputText);
    $searchFor = trim($searchFor);

    // Store submitted values in the session
    $_SESSION['string_number_results'] = array(
        'text' => $inputText,
        'search' => $searchFor,
        'amount' => $inputNum
    );

    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Retrieve submitted results after redirect
if (isset($_SESSION['string_number_results'])) {

    $results = $_SESSION['string_number_results'];

    $inputText = $results['text'];
    $searchFor = $results['search'];
    $inputNum = $results['amount'];

    $submitted = true;

    // Clear stored results after retrieving them
    unset($_SESSION['string_number_results']);
}

// String operations
$lower = strtolower($inputText);
$upper = strtoupper($inputText);
$trimmed = trim($inputText);
$length = strlen($trimmed);

// PHP 8 string functions
$contains = null;
$startsWith = null;
$endsWith = null;

if ($searchFor !== '') {

    $contains = str_contains(
        strtolower($trimmed),
        strtolower($searchFor)
    );

    $startsWith = str_starts_with(
        strtolower($trimmed),
        strtolower($searchFor)
    );

    $endsWith = str_ends_with(
        strtolower($trimmed),
        strtolower($searchFor)
    );
}

// Replace vowels with asterisks
$vowelsReplaced = str_replace(
    array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'),
    '*',
    $inputText
);

// Display first 10 characters
$firstTen = substr($inputText, 0, 10);

// Word count
$wordCount = 0;

if ($trimmed !== '') {

    $normalizedText = preg_replace('/\s+/', ' ', $trimmed);

    $wordCount = count(explode(' ', $normalizedText));
}

// Number operations
$formatted = number_format((float)$inputNum, 2);
$currency = '$' . $formatted;

// Padded dollar amount
$paddedAmount = sprintf('%10.2f', (float)$inputNum);

// Random number
$randNum = 0;

if ($submitted) {
    $randNum = random_int(1, 100);
}

// Rounding operations
$rounded = round((float)$inputNum, 0);
$ceiling = (int)ceil((float)$inputNum);

// Date operations
$now = new DateTime('now', $timezone);

$formattedDate = $now->format('l, F j, Y');
$formattedTime = $now->format('g:i:s A T');

// Tomorrow
$tomorrowDate = clone $now;
$tomorrowDate->modify('+1 day');
$tomorrow = $tomorrowDate->format('Y-m-d');

// Days until Christmas
$today = new DateTime('today', $timezone);
$christmas = new DateTime($now->format('Y') . '-12-25', $timezone);
$daysUntilChristmas = (int)$today->diff($christmas)->format('%r%a');

// Days passed since January 1
$startOfYear = new DateTime($now->format('Y') . '-01-01', $timezone);
$daysSinceNewYear = (int)$startOfYear->diff($now)->format('%a');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP09 Exercise 17-1">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP09 Exercise 17-1</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/StringNumberDateStyles.css">

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
                <h1>String, Number &amp; Date Functions</h1>
            </header>

            <!-- Input Form -->
            <h2>Enter text to analyze, a word to search for, and a dollar amount.</h2>
            <h2>Click Analyze to view string and number results.</h2>
            <h2>Date/Time displays automatically, including tomorrow's date and days until Christmas.</h2>

            <form method="post">

                <label for="text">Enter Text:</label>

                <input
                    type="text"
                    id="text"
                    name="text"
                    value="<?php echo htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8'); ?>"
                >

                <label for="search">Search Within Text:</label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="<?php echo htmlspecialchars($searchFor, ENT_QUOTES, 'UTF-8'); ?>"
                >

                <label for="amount">Dollar Amount:</label>

                <input
                    type="number"
                    step="0.01"
                    id="amount"
                    name="amount"
                    value="<?php echo htmlspecialchars((string)$inputNum, ENT_QUOTES, 'UTF-8'); ?>"
                >

                <button type="submit">Analyze</button>

            </form>

            <?php if ($submitted): ?>

                <!-- String Results -->
                <section id="string-results">

                    <h2>String Results</h2>

                    <p>
                        Original Text:
                        <?php echo htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        Lowercase:
                        <?php echo htmlspecialchars($lower, ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        Uppercase:
                        <?php echo htmlspecialchars($upper, ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        Trimmed Length:
                        <?php echo (int)$length; ?> characters
                    </p>

                    <p>
                        Vowels Replaced:
                        <?php echo htmlspecialchars($vowelsReplaced, ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        First 10 Characters:
                        <?php echo htmlspecialchars($firstTen, ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        Word Count:
                        <?php echo (int)$wordCount; ?>
                    </p>

                    <?php if ($contains !== null): ?>

                        <p>
                            Contains "<?php echo htmlspecialchars($searchFor, ENT_QUOTES, 'UTF-8'); ?>":
                            <?php echo $contains ? 'Yes' : 'No'; ?>
                        </p>

                        <p>
                            Starts With "<?php echo htmlspecialchars($searchFor, ENT_QUOTES, 'UTF-8'); ?>":
                            <?php echo $startsWith ? 'Yes' : 'No'; ?>
                        </p>

                        <p>
                            Ends With "<?php echo htmlspecialchars($searchFor, ENT_QUOTES, 'UTF-8'); ?>":
                            <?php echo $endsWith ? 'Yes' : 'No'; ?>
                        </p>

                    <?php endif; ?>

                </section>

                <!-- Number Results -->
                <section id="number-results">

                    <h2>Number Results</h2>

                    <p>
                        Formatted Currency:
                        <?php echo htmlspecialchars($currency, ENT_QUOTES, 'UTF-8'); ?>
                    </p>

                    <p>
                        Rounded Number:
                        <?php echo number_format((float)$rounded, 0); ?>
                    </p>

                    <p>
                        Ceiling:
                        <?php echo (int)$ceiling; ?>
                    </p>

                    <p>Padded Amount: <span class="padded-number"><?php echo htmlspecialchars($paddedAmount); ?></span>
                    </p>

                    <p>
                        Random Number (1-100):
                        <?php echo (int)$randNum; ?>
                    </p>

                </section>

            <?php endif; ?>

            <!-- Date Results -->
            <section id="date-results">

                <h2>Date &amp; Time Results</h2>

                <p>
                    Today:
                    <?php echo htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>
                    Current Time:
                    <?php echo htmlspecialchars($formattedTime, ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>
                    Tomorrow:
                    <?php echo htmlspecialchars($tomorrow, ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>
                    Days Until Christmas:
                    <?php echo (int)$daysUntilChristmas; ?>
                </p>

                <p>
                    Days Since January 1:
                    <?php echo (int)$daysSinceNewYear; ?>
                </p>

            </section>

            <div>
                <h3>
                    <a href="../index.php">&lt;&lt;&lt; Back to SSP09 Landing Page</a>
                </h3>
            </div>

        </main>

    </div>

    <?php
    require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
    ?>

</body>
</html>
