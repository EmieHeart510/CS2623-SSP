# SSP09 Frosty Word Guessing Game

## Accepted

AI suggested using PHP sessions to keep track of the game — accepted.
I used session variables to store the secret word, guessed letters, guess counts, Frosty's image stage, and game timestamps so the game could maintain its progress.

AI suggested validating the player's letter input — accepted.
I used filter_input(), strtoupper(), trim(), and ctype_alpha() to make sure the player submits a valid single letter.

AI suggested using JavaScript Fetch to update the game without reloading the entire page — accepted.
I used AJAX to submit guesses and update the game content while keeping the current scroll position.

## Rejected

AI suggested using newer PHP features that are not supported by the older server environment — rejected.
I kept the project compatible with PHP 5.5.12 so it would work on OCCC's Apollo server.

AI suggested using window.scrollTo(0, 0) to reset the page's scroll position when starting a new game — rejected.
I wanted the page to keep its current scroll position when selecting Play Again, so I used 
window.scrollTo(0, savedPosition) instead.

## Improved

I added a Play Again option that resets the session variables and starts a new game without affecting other game sessions.

I added JavaScript scroll-position preservation and a fade-in animation so Frosty's image updates smoothly when an incorrect letter is guessed.
