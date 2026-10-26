<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Taylor, Ashley">
    <meta name="description" content="CS2623 Server-Side Programming - SSP01">
    <meta name="keywords" content="PHP, server-side, CS2623, OCCC">
    <title>CS2623 SSP01: Taylor</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <h1>CS2623 Server-Side Programming</h1>
    </header>
    <nav id="topNav">
        <a href="../../Week%201/SSP01/index.php">Home</a>
        <a href="../../Week%201/SSP02/SSP02.php">SSP02</a>
        <a href="../../Week%202/SSP03/index.php">SSP03</a>
        <a href="../../Week%202/SSP04/index.php">SSP04</a>
        <a href="../SSP05/SSP05.php">SSP05</a>
        <a href="../SSP06/SSP06.php">SSP06</a>
        <a href="../SSP07/SSP07.php">SSP07</a>
        <a href="../SSP08/SSP08.php">SSP08</a>
        <a href="../SSP09/SSP09.php">SSP09</a>
        <a href="../SSP10/SSP10.php">SSP10</a>
        <a href="../SSP11/SSP11.php">SSP11</a>
        <a href="../SSP12/SSP12.php">SSP12</a>
    </nav>
        <main>

            <p>
                Hello world (HTML)
            </p>
            <?php echo htmlspecialchars("<p>Hello world! (PHP Testing)</p>"); ?>
            <!-- Note: The above line: htmlspecialchars() is required for all echoed output-->
        </main>
    <footer>
        <p>
            Disclaimer: Oklahoma City Community College does not necessarily endorse the content or respective links of this webpage.
        </p>
    </footer>
</body>

</html>