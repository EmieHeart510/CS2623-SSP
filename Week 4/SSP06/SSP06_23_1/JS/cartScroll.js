/*
 * cartScroll.js
 * CS2623 - Server-Side Programming
 * Week 6 - SSP06
 *
 * Purpose: Preserves the browser's scroll position when
 * adding items to the shopping cart or updating quantities.
 *
 */

// Restore the previous scroll position after a page reload.
window.addEventListener('load', function() {
    var savedPosition = sessionStorage.getItem('cartScrollPosition');

    if (savedPosition !== null) {
        window.scrollTo(0, parseInt(savedPosition, 10));
        sessionStorage.removeItem('cartScrollPosition');
    }
});


// Save the current scroll position when a form is submitted.
document.querySelectorAll('form').forEach(function(form) {
    form.addEventListener('submit', function() {
        sessionStorage.setItem('cartScrollPosition', window.scrollY);
    });
});


// Save the current scroll position when clearing the cart.
var clearCartLink = document.querySelector('a[href="cart_clear.php"]');

if (clearCartLink) {
    clearCartLink.addEventListener('click', function() {
        sessionStorage.setItem('cartScrollPosition', window.scrollY);
    });
}



