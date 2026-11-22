<?php

/*
    CS2623 - Server-Side Programming
    SSP09: Frosty Word Guessing Game
    Author: Taylor, Ashley

    Description:
        Contains the functions used to process player guesses
        and display the current state of the Frosty word game.

        Includes frosty_guessing() and frosty_round().

    PHP Version: Compatible with PHP 5.5.12
*/

function frosty_guessing(
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
) {
    $guess_found = "N";

    // Getting the current date and time in Central Time.
    $now = new DateTime('now', new DateTimeZone('America/Chicago'));
    $game_lastGuess = $now->format('Y-m-d H:i:s');

    // Case 1: Letter was already guessed.
    if (strpos($guess_tracked, $guess_letter) !== false) {

        $guess_count_wrong++;
        $guess_image++;

        // Case 2: Letter is not in the secret word.
    } elseif (strpos($secretWord, $guess_letter) === false) {

        $guess_tracked .= $guess_letter;
        $guess_count_wrong++;
        $guess_image++;

        // Case 3: Correct letter.
    } else {

        $guess_tracked .= $guess_letter;

        // Checking each position in the secret word.
        for ($i = 0; $i < $secretWord_len; $i++) {

            if ($secretWord_array[$i] === $guess_letter) {

                $guess_found = "Y";

                // Revealing the first character.
                if ($i === 0) {

                    $guess_secretWord = $guess_letter
                        . substr($guess_secretWord, 1);

                } else {

                    // Revealing characters at other positions.
                    $guess_secretWord =
                        substr($guess_secretWord, 0, $i)
                        . $guess_letter
                        . substr($guess_secretWord, $i + 1);
                }
            }
        }

        // Checking whether the entire word has been revealed.
        if (str_replace("_", "", $guess_secretWord) === $secretWord) {

            $_SESSION["game_won"] = true;
        }
    }

    // Incrementing the total number of guesses.
    $guess_count++;

    // Saving the updated game state to the session.
    $_SESSION["guess_secretWord"] = $guess_secretWord;
    $_SESSION["guess_count"] = $guess_count;
    $_SESSION["guess_count_wrong"] = $guess_count_wrong;
    $_SESSION["guess_tracked"] = $guess_tracked;
    $_SESSION["guess_image"] = $guess_image;
    $_SESSION["guess_letter"] = $guess_letter;
    $_SESSION["game_lastGuess"] = $game_lastGuess;

    // Displaying the updated game round.
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
}


function frosty_round(
    $game_started,
    $game_lastGuess,
    $secretWord_len,
    $secretWord_hint,
    $guess_count,
    $guess_count_wrong,
    $guess_tracked,
    $guess_image,
    $guess_secretWord
) {

    // Calculating the number of correctly revealed letters.
    $right_count = strlen(
        str_replace("_", "", $guess_secretWord)
    );

    // Selecting the Frosty image based on wrong guesses.
    $img = "Images/frosty" . $guess_image . ".png";

    // Saving the current Frosty image in the session.
    $_SESSION['frosty_image'] = $img;

    // Displaying Frosty's current image.
    echo "<img src='" . htmlspecialchars($img, ENT_QUOTES, "UTF-8")
        . "' alt='Frosty stage " . (int)$guess_image
        . "' class='frosty-image' data-wrong-guesses='"
        . (int)$guess_count_wrong . "'>";

    // Marker separating Frosty's image from the current word.
    echo "<!-- FROSTY_IMAGE_END -->";

    // Displaying the current word.
    echo "<p class='word-progress'>";
    echo "<strong>Current Word:</strong> ";
    echo htmlspecialchars($guess_secretWord, ENT_QUOTES, "UTF-8");
    echo "</p>";

    // Marker separating the current word from game information.
    echo "<!-- FROSTY_WORD_END -->";

    // Displaying the game information.
    echo "<div class='game-status'>";

    // Displaying when the game started.
    echo "<p>Game started: "
        . htmlspecialchars($game_started, ENT_QUOTES, "UTF-8")
        . "</p>";

    // Displaying the time of the most recent guess.
    echo "<p>Last guess: "
        . htmlspecialchars($game_lastGuess, ENT_QUOTES, "UTF-8")
        . "</p>";

    // Displaying the hint for the secret word.
    echo "<p>Secret word hint: "
        . htmlspecialchars($secretWord_hint, ENT_QUOTES, "UTF-8")
        . "</p>";

    // Displaying the number of letters in the secret word.
    echo "<p>Secret word length: "
        . htmlspecialchars((string)$secretWord_len, ENT_QUOTES, "UTF-8")
        . "</p>";

    // Displaying the total number of guesses.
    echo "<p><strong>Total guesses: "
        . htmlspecialchars((string)$guess_count, ENT_QUOTES, "UTF-8")
        . "</strong></p>";

    // Displaying the number of incorrect guesses.
    echo "<p><strong>Wrong guesses: "
        . htmlspecialchars((string)$guess_count_wrong, ENT_QUOTES, "UTF-8")
        . "</strong></p>";

    // Displaying the number of correct letters revealed.
    echo "<p><strong>Right answers: "
        . htmlspecialchars((string)$right_count, ENT_QUOTES, "UTF-8")
        . "</strong></p>";

    // Displaying all letters the player has already guessed.
    echo "<p><strong>Guessed letters: "
        . htmlspecialchars($guess_tracked, ENT_QUOTES, "UTF-8")
        . "</strong></p>";


    echo "</div>";
}

?>