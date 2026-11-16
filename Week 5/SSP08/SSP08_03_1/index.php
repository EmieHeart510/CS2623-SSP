<?php
session_start();

/*
    CS2623 - Server-Side Programming
    SSP08 Exercise 03-1: Control Structures
    Author: Taylor, Ashley

    Description:
        Demonstrates PHP control structures, including conditional
        statements, functions, and different types of loops.

        Includes FizzBuzz, day-of-the-week lookup, grade lookup,
        a multiplication table, countdown, and word repetition.

    PHP Version: Compatible with PHP 5.5.12
*/

// FizzBuzz function
function fn_fizzbuzz($n) {
    if ($n % 15 === 0) {
        return 'FizzBuzz';
    } elseif ($n % 3 === 0) {
        return 'Fizz';
    } elseif ($n % 5 === 0) {
        return 'Buzz';
    } else {
        return (string)$n;
    }
}

// Day of Week function
function fn_dayOfWeek($dow) {
    if ($dow === 0) {
        return 'Sunday';
    } elseif ($dow === 1) {
        return 'Monday';
    } elseif ($dow === 2) {
        return 'Tuesday';
    } elseif ($dow === 3) {
        return 'Wednesday';
    } elseif ($dow === 4) {
        return 'Thursday';
    } elseif ($dow === 5) {
        return 'Friday';
    } else {
        return 'Saturday';
    }
}

// Grade Label function
function fn_gradeLabel($score) {
    switch (true) {
        case $score >= 90:
            return 'A';
        case $score >= 80:
            return 'B';
        case $score >= 70:
            return 'C';
        case $score >= 60:
            return 'D';
        default:
            return 'F';
    }
}

// POST handling

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $start = filter_input(INPUT_POST, 'start', FILTER_VALIDATE_INT);
    $end = filter_input(INPUT_POST, 'end', FILTER_VALIDATE_INT);
    $score = filter_input(INPUT_POST, 'score', FILTER_VALIDATE_INT);

    $word = filter_input(INPUT_POST, 'word', FILTER_UNSAFE_RAW);
    $repeatCount = filter_input(INPUT_POST, 'repeat_count', FILTER_VALIDATE_INT);

    // Default values
    if ($start === false || $start === null) {
        $start = 1;
    }

    if ($end === false || $end === null) {
        $end = 20;
    }

    if ($score === false || $score === null) {
        $score = -1;
    }

    if ($word === false || $word === null) {
        $word = '';
    }

    if ($repeatCount === false || $repeatCount === null || $repeatCount < 1) {
        $repeatCount = 1;
    }

    // Validate the range
    if ($start < 1) {
        $start = 1;
    }

    if ($end > 100) {
        $end = 100;
    }

    if ($repeatCount > 20) {
        $repeatCount = 20;
    }

    // Check whether the range is valid
    $rangeError = ($start > $end);

    // Store submitted values in the session
    $_SESSION['exercise_results'] = array(
        'start' => $start,
        'end' => $end,
        'score' => $score,
        'word' => $word,
        'repeatCount' => $repeatCount,
        'rangeError' => $rangeError
    );

    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Retrieve submitted results after redirect
$submitted = false;

if (isset($_SESSION['exercise_results'])) {

    $results = $_SESSION['exercise_results'];

    $start = $results['start'];
    $end = $results['end'];
    $score = $results['score'];
    $word = $results['word'];
    $repeatCount = $results['repeatCount'];
    $rangeError = $results['rangeError'];

    $submitted = true;

    // Clear stored results after retrieving them
    unset($_SESSION['exercise_results']);

} else {

    // Default values for a clean page
    $start = 1;
    $end = 20;
    $score = -1;
    $word = '';
    $repeatCount = 1;
    $rangeError = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP08 Exercise 3-1">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP08 Exercise 3-1</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/ControlStructureStyles.css">
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
            <h1>Control Structures Demo</h1>
        </header>

        <h2>Enter a number range, a score, and a word with repetition count.</h2>
        <h2>Click Run to view the results.</h2>

<form method="post">

    <label>
        Start:
        <input type="number" name="start" min="1" max="100"
               value="<?php echo (int)$start; ?>">
    </label>

    <label>
        End:
        <input type="number" name="end" min="1" max="100"
               value="<?php echo (int)$end; ?>">
    </label>

    <label>
        Score (0-100):
        <input type="number" name="score" min="0" max="100"
               value="<?php echo ($score >= 0 ? (int)$score : ''); ?>">
    </label>

    <label>
        Word to Repeat:
        <input type="text" name="word"
               value="<?php echo htmlspecialchars($word, ENT_QUOTES, 'UTF-8'); ?>">
    </label>

    <label>
        Number of Repetitions (1-20):
        <input type="number" name="repeat_count" min="1" max="20"
               value="<?php echo (int)$repeatCount; ?>">
    </label>

    <button type="submit">Run</button>

</form>

<?php if ($submitted): ?>

    <?php if ($rangeError): ?>

        <p style="color: red;">
            Error: Start must be less than or equal to End.
        </p>

    <?php else: ?>

    <h2>FizzBuzz (for loop, <?php echo (int)$start; ?>–<?php echo (int)$end; ?>)</h2>

    <ul>
        <?php for ($i = $start; $i <= $end; $i++): ?>
            <li>
                <?php echo htmlspecialchars(fn_fizzbuzz($i), ENT_QUOTES, 'UTF-8'); ?>
            </li>
        <?php endfor; ?>
    </ul>

<h2>Day Names (while loop)</h2>

<ul>
    <?php
    $d = 0;

    while ($d <= 6) {
        echo '<li>' . htmlspecialchars(fn_dayOfWeek($d), ENT_QUOTES, 'UTF-8') . '</li>';
        $d++;
    }
    ?>
</ul>

<h2>Grade Lookup (switch)</h2>

<?php if ($score >= 0): ?>

    <p>
        Score <?php echo (int)$score; ?>:
        Grade <strong>
            <?php echo htmlspecialchars(fn_gradeLabel($score), ENT_QUOTES, 'UTF-8'); ?>
        </strong>
    </p>

<?php endif; ?>

<h2>Multiplication Table (nested do-while loops)</h2>

<table id="multiplication-table">
    <?php
    $row = 1;

    do {
        echo '<tr>';

        $column = 1;

        do {
            echo '<td>' . ($row * $column) . '</td>';
            $column++;
        } while ($column <= 5);

        echo '</tr>';
        $row++;

    } while ($row <= 5);
    ?>
</table>

<h2>Countdown</h2>

<ul>
    <?php
    $count = $end;

    do {
        echo '<li>' . (int)$count . '</li>';
        $count--;
    } while ($count >= $start);
    ?>
</ul>

    <h2>Repeat Word (while loop)</h2>

<?php if ($word !== ''): ?>

    <ul>
        <?php
        $i = 0;

        while ($i < $repeatCount) {
            echo '<li>' . htmlspecialchars($word, ENT_QUOTES, 'UTF-8') . '</li>';
            $i++;
        }
        ?>
    </ul>

<?php endif; ?>

    <?php endif; ?>

<?php endif; ?>

        <div>
            <h3><a href="../index.php">&lt;&lt;&lt; Back to SSP08 Landing Page</a></h3>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>