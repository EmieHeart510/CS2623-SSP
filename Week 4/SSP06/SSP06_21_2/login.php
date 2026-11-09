<?php
session_start();

/*
 * login.php
 * CS2623 - Server-Side Programming
 * Week 4 - SSP06
 * Exercise 21-2: Login & Authentication
 *
 * Purpose: Displays and processes the user login form.
 * Validates login credentials using password hashing
 * and verification, and manages user login sessions.
 */

// Simulated user store login credentials
$users = array(
        'admin' => array(
                'password' => password_hash('secret123', PASSWORD_DEFAULT),
                'name' => 'Administrator'
        ),
        'ataylor' => array(
                'password' => password_hash('php4life!', PASSWORD_DEFAULT),
                'name' => 'Ashley Taylor'
        )
);

$error = '';
$remaining_time = 0;

// Initialize the login attempts counter
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

// Initialize the lockout timer
if (!isset($_SESSION['lockout_until'])) {
    $_SESSION['lockout_until'] = 0;
}

// Check whether the lockout has expired
$lockout_expired = false;

if ($_SESSION['lockout_until'] > 0 &&
        time() >= $_SESSION['lockout_until']) {

    // Reset attempts after the lockout expires
    $_SESSION['attempts'] = 0;
    $_SESSION['lockout_until'] = 0;

    $lockout_expired = true;

} elseif (time() < $_SESSION['lockout_until']) {

    $remaining_time = $_SESSION['lockout_until'] - time();
}

// Retrieve remembered username from cookie
$username = '';

if (isset($_COOKIE['remembered_username'])) {
    $username = $_COOKIE['remembered_username'];
}

// Retrieve login message after redirect
if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}

// Retrieve username after redirect
if (isset($_SESSION['login_username'])) {
    $username = $_SESSION['login_username'];
    unset($_SESSION['login_username']);
}

// Clear old login information after lockout expires
if ($lockout_expired) {
    $error = '';

    unset($_SESSION['login_error']);
    unset($_SESSION['login_username']);

    // Restore remembered username if a cookie exists
    if (isset($_COOKIE['remembered_username'])) {
        $username = $_COOKIE['remembered_username'];
    } else {
        $username = '';
    }
}

// Process the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    if ($username === false || $username === null) {
        $username = '';
    }

    if ($password === false || $password === null) {
        $password = '';
    }

    // Check whether the user is locked out
    if (time() < $_SESSION['lockout_until']) {

        $remaining_time = $_SESSION['lockout_until'] - time();

        $minutes = floor($remaining_time / 60);
        $seconds = $remaining_time % 60;

        $error = 'Too many failed attempts. Please try again in ' .
                $minutes . ' minutes and ' . $seconds . ' seconds.';

    } elseif (isset($users[$username]) &&
            password_verify($password, $users[$username]['password'])) {

        // Successful login
        session_regenerate_id(true);

        $_SESSION['user'] = $username;
        $_SESSION['user_name'] = $users[$username]['name'];
        $_SESSION['login_at'] = time();
        $_SESSION['attempts'] = 0;
        $_SESSION['lockout_until'] = 0;

        // Remember username for 30 days
        if (isset($_POST['remember'])) {
            setcookie('remembered_username', $username,
                    time() + (30 * 24 * 60 * 60), '/');
        } else {
            setcookie('remembered_username', '',
                    time() - 3600, '/');
        }

        header('Location: dashboard.php');
        exit();

    } else {

        // Failed login
        $_SESSION['attempts']++;

        if ($_SESSION['attempts'] >= 3) {

            $_SESSION['lockout_until'] = time() + (5 * 60);
            $remaining_time = 5 * 60;

            $error = 'Too many failed attempts. Your account is locked for 5 minutes.';

        } else {

            $error = 'Invalid username or password. Number of attempts: ' .
                    $_SESSION['attempts'] . ' of 3.';
        }
    }

    // Save the message and username before redirecting
    $_SESSION['login_error'] = $error;
    $_SESSION['login_username'] = $username;

    // Redirect back to the login page
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP06 Exercise 21-2">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP06 Exercise 21-2: Taylor</title>
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
                Exercise 21-2: Login & Authentication - Dashboard
            </h1>
        </header>

        <h2>Please enter your login credentials to access the Dashboard and Guitar Shop.</h2>

        <div class="form-wrapper">

            <?php if ($error): ?>
                <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <form method="post" action="login.php">

                <label for="username">Username:</label>
                <input type="text" name="username" id="username"
                       value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>"
                       autocomplete="username">

                <br>
                <br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" autocomplete="current-password">

                <br>
                <br>

                <label for="remember">
                    <input type="checkbox" id="remember" name="remember">
                    Remember My Username Please
                </label>

                <br>
                <br>

                <button type="submit" value="Login">Login</button>

                <p><b>For testing purposes, use one these to test the logins:</b></p>
                <p>Username: admin | Password: secret123</p>
                <p>Username: ataylor | Password: php4life!</p>
            </form>
        </div>

        <br>
        <br>
        <br>


        <div>
                <h3><a href="../index.php">&lt;&lt;&lt; Back to SSP06 Landing Page</a></h3>
        </div>
    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>