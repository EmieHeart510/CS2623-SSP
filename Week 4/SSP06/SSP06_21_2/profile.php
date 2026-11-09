
<?php
/*
 * profile.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Exercise 21-2: Login & Authentication
 *
 * Purpose: Displays the logged-in user's profile.
 * Protects the page by requiring authentication.
 */

require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/LoginStyle.css">
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
                Exercise 21-2: Login & Authentication - User Profile
            </h1>
        </header>

        <div class="form-wrapper">

            <p><b>Username:</b> <?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?></p>

            <p><a href="dashboard.php">Return to Dashboard</a></p>
            <p><a href="logout.php">Log out</a></p>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>
