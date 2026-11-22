/*=========================================================
    FrostyScripts.js
    Author: Taylor, Ashley

    Description:
        Updates the Frosty game without reloading the page.
        Preserves the browser's scroll position and animates
        Frosty's image when an incorrect letter is guessed.

    JavaScript Version: ES5 Compatible
=========================================================*/

// Restoring the scroll position after starting a new game.
window.addEventListener("pageshow", function () {

    var savedPosition = sessionStorage.getItem("frostyScrollPosition");

    if (savedPosition !== null) {

        window.requestAnimationFrame(function () {

            window.scrollTo(0, parseInt(savedPosition, 10));

            sessionStorage.removeItem("frostyScrollPosition");
        });
    }
});

// Handling game form submissions without reloading the page.
document.addEventListener("submit", function (event) {

    var form = event.target;

    if (!form) {
        return;
    }

// Saving the scroll position when Play Again is selected.
    var newGameInput = form.querySelector('input[name="new_game"]');

    if (newGameInput) {

        sessionStorage.setItem(
            "frostyScrollPosition",
            window.pageYOffset
        );

        return;
    }

    // Only intercept the regular Frosty game form.
    if (form.id !== "frosty-form") {
        return;
    }

    event.preventDefault();

    // Preventing duplicate submissions.
    if (form.getAttribute("data-submitting") === "true") {
        return;
    }

    form.setAttribute("data-submitting", "true");

    var currentGame = document.getElementById("frosty-game");

    var oldImage = currentGame.querySelector(".frosty-image");

    var oldWrongGuesses = parseInt(
        oldImage.getAttribute("data-wrong-guesses"),
        10
    );

    // Preserving the current scroll position.
    var savedPosition = window.pageYOffset;

    // Sending the guess to PHP.
    fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        }
    })

        .then(function (response) {

            if (!response.ok) {
                throw new Error("Unable to submit the guess.");
            }

            return response.text();
        })

        .then(function (html) {

            // Reading the updated PHP page.
            var parser = new DOMParser();

            var newDocument = parser.parseFromString(
                html,
                "text/html"
            );

            var newGame = newDocument.getElementById("frosty-game");

            if (!newGame) {
                throw new Error("Updated game content was not found.");
            }

            var newImage = newGame.querySelector(".frosty-image");

            var newWrongGuesses = parseInt(
                newImage.getAttribute("data-wrong-guesses"),
                10
            );

            // Updating only the game content.
            currentGame.innerHTML = newGame.innerHTML;

            // Animating Frosty after an incorrect guess.
            if (newWrongGuesses > oldWrongGuesses) {

                var updatedImage = currentGame.querySelector(".frosty-image");

                updatedImage.classList.add("fade-in");
            }

            // Restoring the previous scroll position.
            window.requestAnimationFrame(function () {
                window.scrollTo(0, savedPosition);
            });

        })

        .catch(function (error) {

            console.error("Frosty game error:", error);

            alert("There was a problem updating the game. Please try again.");

            form.removeAttribute("data-submitting");
        });

});