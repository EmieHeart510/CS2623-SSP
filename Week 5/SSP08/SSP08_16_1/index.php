<?php
session_start();

/*
    CS2623 - Server-Side Programming
    SSP08 Exercise 16-1: File I/O
    Author: Taylor, Ashley

    Description:
        Demonstrates PHP file handling by creating, reading,
        writing, appending, and clearing a log file.

        Includes file information, directory listing, and
        an option to download the log file.

    PHP Version: Compatible with PHP 5.5.12
*/


// File and directory setup
$dataDIR = __DIR__ . '/data/';
$logFile = $dataDIR . 'log.txt';

$message = '';
$fileContent = '';
$files = array();

if (!is_dir($dataDIR)) {
    mkdir($dataDIR, 0755, true);
}

// Timezone setup
$timezone = new DateTimeZone('America/Chicago');

// Handle new log entry (POST)
if (isset($_POST['save_entry'])) {

    $entry = filter_input(INPUT_POST, 'entry', FILTER_UNSAFE_RAW);

    if ($entry === null || $entry === false) {
        $entry = '';
    }

    $entry = trim($entry);

    if ($entry !== '') {

        $now = new DateTime('now', $timezone);
        $timestamp = $now->format('Y-m-d H:i:s');

        $line = $timestamp . ' - ' . $entry . PHP_EOL;

        $result = file_put_contents(
            $logFile,
            $line,
            FILE_APPEND | LOCK_EX
        );

        if ($result !== false) {
            chmod($logFile, 0644);
            $_SESSION['file_log_message'] = 'Entry saved.';
        } else {
            $_SESSION['file_log_message'] = 'Unable to save the entry.';
        }

    } else {
        $_SESSION['file_log_message'] = 'Entry cannot be empty.';
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Retrieve the message after redirect
if (isset($_SESSION['file_log_message'])) {
    $message = $_SESSION['file_log_message'];
    unset($_SESSION['file_log_message']);
}

// Clear the log (POST)
if (isset($_POST['clear_log'])) {
    $result = file_put_contents($logFile, '');

    if ($result !== false) {
        chmod($logFile, 0644);
        $_SESSION['file_log_message'] = 'Log cleared.';
    } else {
        $_SESSION['file_log_message'] = 'Unable to clear the log.';
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Download the log file (GET)
if (isset($_GET['download'])) {

    $requestedFile = basename($_GET['download']);
    $downloadFile = $dataDIR . $requestedFile;

    if ($requestedFile === 'log.txt' && file_exists($downloadFile)){

        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="log.txt"');
        header('Content-Length: ' . filesize($downloadFile));

        readfile($downloadFile);
        exit;
    }
}

// Read the log file
if (file_exists($logFile)) {

    $fileContent = file_get_contents($logFile);

    // Get the log file size
    $fileSize = filesize($logFile);
}

// List files in the data directory
$directoryContents = scandir($dataDIR);

foreach ($directoryContents as $file) {

    $filePath = $dataDIR . $file;

    if (is_file($filePath)) {
        $files[] = $file;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP08 Exercise 16-1">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP08 Exercise 16-1</title>
    <link rel="stylesheet" href="../../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/FileIOStyles.css">
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
            <h1>File Log Demo</h1>
        </header>

        <!-- Display status message -->
        <?php if ($message !== ''): ?>
            <p>
                <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php endif; ?>

        <h2>Enter a log message and click Save Entry to add it to the log.</h2>
        <h2>View saved entries, file size, or download or clear the log.</h2>

        <form method="post">

            <label for="entry">New Log Entry:</label>

            <input type="text" id="entry" name="entry" maxlength="200">

            <div class="form-buttons">
                <button type="submit" name="save_entry" value="1">
                    Save Entry
                </button>

                <button type="submit" name="clear_log" value="1">
                    Clear Log
                </button>
            </div>

        </form>

        <section id="log-information">

            <h2>Log File Content</h2>

            <?php if ($fileContent !== ''): ?>

                <pre><?php echo htmlspecialchars($fileContent, ENT_QUOTES, 'UTF-8'); ?></pre>

            <?php else: ?>
                <p>No entries have been recorded yet.</p>
            <?php endif; ?>

            <h2>Log File Size</h2>

            <?php if (file_exists($logFile)): ?>

                <p>
                    <?php echo number_format($fileSize); ?> bytes
                </p>

            <?php else: ?>
                <p>Log file does not exist.</p>
            <?php endif; ?>

            <h2>Files in the Data Directory</h2>

            <div class="directory-files">

                <?php if (!empty($files)): ?>

                    <?php foreach ($files as $file): ?>

                        <p>
                            <?php echo htmlspecialchars(basename($file), ENT_QUOTES, 'UTF-8'); ?>
                        </p>

                    <?php endforeach; ?>

                <?php else: ?>

                    <p>No files found in the data directory.</p>

                <?php endif; ?>

            </div>

            <h2>Download Log</h2>

            <?php if (file_exists($logFile)): ?>

                <p>
                    <a href="?download=log.txt">Download Log File</a>
                </p>

            <?php else: ?>
                <p>No log file is available to download yet.</p>
            <?php endif; ?>
        </section>

        <div>
            <h3>
                <a href="../index.php">&lt;&lt;&lt; Back to SSP08 Landing Page</a>
            </h3>
        </div>

    </main>
</div>

<?php
require_once __DIR__ . "/../../../Week 1/SSP02/PHP/include_footer.php";
?>

</body>
</html>
