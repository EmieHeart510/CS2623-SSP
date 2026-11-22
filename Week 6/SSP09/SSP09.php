<?php
session_start();
ob_start();

// Resetting the game only when Play Again is selected.
if ($_SERVER['REQUEST_METHOD'] === 'GET' &&
        isset($_GET['new_game']) &&
        $_GET['new_game'] === '1') {

    $_SESSION = array();
}

/*
    CS2623 - Server-Side Programming
    SSP09: Frosty Word Guessing Game
    Author: Taylor, Ashley

    Description:
        A letter-guessing game that uses PHP sessions to
        maintain game progress between page reloads.

        Players guess one letter at a time. Correct guesses
        reveal letters in the hidden word, while incorrect
        guesses advance the Frosty snowman image.

    PHP Version: Compatible with PHP 5.5.12
*/

// Setting the timezone for the Frosty game.
$timezone = new DateTimeZone('America/Chicago');

// Initializing the session variables for the Frosty game.
if (!isset($_SESSION['secretWord'])) {

    $_SESSION['secretWord'] = 'BLIZZARD';

    $_SESSION['secretWord_hint'] = 'Winter weather category';

    $_SESSION['secretWord_array'] = str_split(
        strtoupper($_SESSION['secretWord'])
    );

    $_SESSION['secretWord_len'] = strlen($_SESSION['secretWord']);

    // Creating underscores to hide each letter of the secret word.
    $_SESSION['guess_secretWord'] = str_repeat(
        '_',
        $_SESSION['secretWord_len']
    );

    // Initializing the guess counters/tracking variables.
    $_SESSION['guess_count'] = 0;
    $_SESSION['guess_count_wrong'] = 0;
    $_SESSION['guess_tracked'] = "";
    $_SESSION['guess_image'] = 0;
    $_SESSION['guess_letter'] = "";
    $_SESSION['game_won'] = false;

    // Gets the current fate and time using Central Time Zone (America/Chicago).
    $now = new DateTime('now', $timezone);

    // Stores when the game starts and when the last guess was made.
    $_SESSION['game_lastGuess'] = $now->format('Y-m-d H:i:s');
    $_SESSION['game_started'] = $now->format('Y-m-d H:i:s');

}

// Initializing the game-won variable if it does not already exist.
if (!isset($_SESSION['game_won'])) {
    $_SESSION['game_won'] = false;
}

    // Loading the session values into local variables.
    $secretWord = $_SESSION['secretWord'];
    $secretWord_hint = $_SESSION['secretWord_hint'];
    $secretWord_array = $_SESSION['secretWord_array'];
    $secretWord_len = $_SESSION['secretWord_len'];
    $guess_secretWord = $_SESSION['guess_secretWord'];
    $guess_count = $_SESSION['guess_count'];
    $guess_count_wrong = $_SESSION['guess_count_wrong'];
    $guess_tracked = $_SESSION['guess_tracked'];
    $guess_image = $_SESSION['guess_image'];
    $guess_letter = $_SESSION['guess_letter'];
    $game_won = $_SESSION['game_won'];
    $game_lastGuess = $_SESSION['game_lastGuess'];
    $game_started = $_SESSION['game_started'];


// Loading the game functions for the Frosty game.
require_once __DIR__ . "/Functions/functions_SSP09.php";

// Processing a submitted letter guess.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieving the submitted letter.
    $raw = filter_input(INPUT_POST, 'frosty_letter_guess');
    $raw = ($raw === NULL) ? "" : $raw;
    $guess_letter = strtoupper(trim($raw));

    // Validating the submitted letter.
    if (!$game_won && $guess_image < 5 &&
        ctype_alpha($guess_letter) &&
        strlen($guess_letter) === 1) {

        // Processing the player's guess.
        frosty_guessing(
            $secretWord,
            $secretWord_hint,
            $guess_secretWord,
            $guess_letter,
            $guess_tracked,
            $guess_count,
            $guess_count_wrong,
            $game_started,
            $game_lastGuess,
            $secretWord_len,
            $secretWord_array,
            $guess_image
        );
    }

// Checking whether the guess was submitted through AJAX.
    $is_ajax = (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    );

    if ($is_ajax) {

        // Refreshing the local variables with the updated session values.
        $guess_secretWord = $_SESSION['guess_secretWord'];
        $guess_count = $_SESSION['guess_count'];
        $guess_count_wrong = $_SESSION['guess_count_wrong'];
        $guess_tracked = $_SESSION['guess_tracked'];
        $guess_image = $_SESSION['guess_image'];
        $guess_letter = $_SESSION['guess_letter'];
        $game_won = $_SESSION['game_won'];
        $game_lastGuess = $_SESSION['game_lastGuess'];

        // Clearing the previous game output.
        ob_clean();

    } else {

        // Marking that a guess was just submitted.
        $_SESSION['just_submitted'] = true;

        // Clearing buffered output before redirecting.
        ob_clean();

        // Redirecting to prevent form resubmission.
        header("Location: SSP09.php");
        exit;
    }
}

// Displaying the current game.
frosty_round(
    $game_started,
    $game_lastGuess,
    $secretWord_len,
    $secretWord_hint,
    $guess_count,
    $guess_count_wrong,
    $guess_tracked,
    $guess_image,
    $guess_secretWord
);

// Capturing the output from frosty_round().
$round_output = ob_get_clean();

// Separating Frosty's image from the game information.
$image_marker = "<!-- FROSTY_IMAGE_END -->";
$image_position = strpos($round_output, $image_marker);

$frosty_image_output = substr($round_output, 0, $image_position);

// Removing the image marker and getting the remaining output.
$remaining_output = substr(
        $round_output,
        $image_position + strlen($image_marker)
);

// Separating the current word from the game information.
$word_marker = "<!-- FROSTY_WORD_END -->";
$word_position = strpos($remaining_output, $word_marker);

$frosty_word_output = substr($remaining_output, 0, $word_position);

// Keeping the game information separate.
$game_output = substr(
        $remaining_output,
        $word_position + strlen($word_marker)
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP09 Frosty Word Guessing Game">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC, Frosty">
    <title>CS2623 SSP09: Frosty Word Guessing Game</title>
    <link rel="stylesheet" href="../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/FrostyStyles.css">
    <script src="JS/FrostyScripts.js" defer></script>

</head>

<body>

<?php
require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_header.php";
require_once __DIR__ . "/../../Week 5/SSP09/Nav/include_topNav.php";
?>

<div id="wrapper">

    <?php
    require_once __DIR__ . "/../../Week 5/SSP09/Nav/include_leftNav.php";
    ?>

    <main>

        <header>
            <h1>Frosty Word Guessing Game</h1>
        </header>

        <h2>Guess one letter at a time to reveal the hidden winter-themed word.</h2>
        <h2>Incorrect guesses builds Frosty to the next stage.</h2>
        <h2>So, try to figure out the word before Frosty is fully made!</h2>

        <div id="frosty-game">
        <?php if (!$game_won && $guess_image < 5) { ?>

            <!-- Active Game Form -->
            <form method="post" action="SSP09.php" id="frosty-form">

                <!-- Frosty image -->
                <?php echo $frosty_image_output; ?>

                <!-- Word progress -->
                <?php echo $frosty_word_output; ?>

                <label for="frosty_letter_guess">Guess a letter:</label>

                <input type="text" id="frosty_letter_guess"
                       name="frosty_letter_guess"
                       maxlength="1" required autocomplete="off">

                <button type="submit">Submit Guess</button>

            </form>

        <?php } else { ?>

            <!-- Game Over Form -->
            <form method="get" action="SSP09.php">
                <input type="hidden" name="new_game" value="1">

                <!-- Frosty's final image -->
                <?php echo $frosty_image_output; ?>

                <!-- Final word progress -->
                <?php echo $frosty_word_output; ?>

                <?php if ($game_won) { ?>
                    <p><strong>You Won! Congratulations!</strong></p>
                <?php } else { ?>
                    <p><strong>Game Over! Frosty has reached his final stage!</strong></p>
                <?php } ?>

                <button type="submit">Play Again</button>

            </form>

            <?php } ?>

            <?php echo $game_output; ?>
        </div>

        <div>
            <h3>
                <a href="../../Week%205/SSP09/index.php">&lt;&lt;&lt; Back to SSP09 Landing Page</a>
            </h3>
        </div>

    </main>

</div>

<?php
require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>