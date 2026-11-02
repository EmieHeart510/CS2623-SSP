<?php
session_start();

$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

if ($request_method === null) {
    $request_method = 'GET';
}

$first_name = '';
$last_name = '';
$email = '';
$age = '';
$gender = '';
$country = '';
$comments = '';

$email_error = '';
$age_error = '';

if ($request_method === 'POST') {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($first_name === null) {
        $first_name = '';
    }

    if ($last_name === null) {
        $last_name = '';
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($email === false || $email === null) {
        $email_error = 'Please enter a valid email address.';
        $email_input = filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW);
        $email = ($email_input !== null) ? $email_input : '';
    }

    $age_input = filter_input(INPUT_POST, 'age', FILTER_UNSAFE_RAW);

    if ($age_input === null) {
        $age_input = '';
    }

    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);

    if ($age === false || $age === null || $age < 1) {
        $age_error = 'Please enter a valid age.';
        $age = $age_input;
    }

    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_SPECIAL_CHARS);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_SPECIAL_CHARS);
    $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($gender === null) {
        $gender = '';
    }

    if ($country === null) {
        $country = '';
    }

    if ($comments === null) {
        $comments = '';
    }

    $_SESSION['submission'] = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'age' => $age,
            'gender' => $gender,
            'country' => $country,
            'comments' => $comments,
            'email_error' => $email_error,
            'age_error' => $age_error
    ];

    header('Location: SSP05_1.php');
    exit;
}

$submission = isset($_SESSION['submission']) ? $_SESSION['submission'] : null;
unset($_SESSION['submission']);

if ($submission !== null) {
    $email_error = isset($submission['email_error']) ? $submission['email_error'] : '';
    $age_error = isset($submission['age_error']) ? $submission['age_error'] : '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP05_1">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP05_1: Taylor</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="../SSP05_2/CSS/Formstyle.css">
</head>
<body>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_header.php";
require_once __DIR__ . "/../PHP/include_topNav.php";
?>

<div id="wrapper">

    <?php
    require_once __DIR__ . "/../PHP/include_leftNav.php";
    ?>

    <main>
        <header>
            <h1>Exercise 7-1: Personal Info Form</h1>
        </header>

        <h2>This exercise will allow you to submit a personal information form.</h2>

        <?php if ($email_error !== ''): ?>
            <p class="error"><?php echo htmlspecialchars($email_error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <?php if ($age_error !== ''): ?>
            <p class="error"><?php echo htmlspecialchars($age_error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <div class="form-wrapper">
            <form method="post">
                <p>
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name"
                           value="<?php echo htmlspecialchars((string) $first_name, ENT_QUOTES, 'UTF-8'); ?>">

                </p>
                <p>
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name"
                           value="<?php echo htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8'); ?>">
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email"
                           value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
                </p>
                <p>
                    <label for="age">Age:</label>
                    <input type="text" name="age" id="age"
                           value="<?php echo htmlspecialchars((string) $age, ENT_QUOTES, 'UTF-8'); ?>">
                </p>

                <p>Gender:</p>
                <p>
                    <input type="radio" id="male" name="gender" value="Male">
                    <label for="male">Male</label>

                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female">Female</label>

                    <input type="radio" id="other" name="gender" value="Other">
                    <label for="other">Other</label>
                </p>
                <p>
                    <label for="country">Country:</label>
                    <select name="country" id="country">
                        <option value="">Select a Country</option>
                        <option value="United States">United States</option>
                        <option value="Canada">Canada</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Australia">Australia</option>
                        <option value="Japan">Japan</option>
                    </select>
                </p>
                <p>
                    <label for="comments">Comments:</label>
                    <textarea name="comments" id="comments" rows="4" cols="40"></textarea>
                </p>

                <p>
                    <button type="submit">Submit</button>
                </p>
            </form>
        </div>

        <?php if ($submission !== null && $email_error === '' && $age_error === ''): ?>
            <div class="summary-wrapper">
                <h2>Submitted Information</h2>

                <p>First Name:
                    <?php echo htmlspecialchars($submission['first_name'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>Last Name:
                    <?php echo htmlspecialchars($submission['last_name'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>Email:
                    <?php echo htmlspecialchars($submission['email'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>Age:
                    <?php echo htmlspecialchars((string) $submission['age'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>Gender:
                    <?php echo htmlspecialchars($submission['gender'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>Country:
                    <?php echo htmlspecialchars($submission['country'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p>Comments:</p>
                <p>
                    <?php echo nl2br(htmlspecialchars($submission['comments'], ENT_QUOTES, 'UTF-8')); ?>
                </p>

            </div>
        <?php endif; ?>

        <div>
            <h3><a href="../index.php">&lt;&lt;&lt; Back to SSP05 Landing Page</a></h3>
        </div>

    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>
