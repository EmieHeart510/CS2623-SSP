<?php
/*
 * ex1_strings.php
 * CS2623 - Server-Side Programming
 * SSP04
 * Purpose: Demonstrates the use of strings in PHP.
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Strings Functions</title>
    <link rel="stylesheet" href="../../Week%201/SSP01/main.css">
    <link rel="stylesheet" href="CSS/strings-table.css">
</head>

<body>
    <?php
    require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_header.php";
    ?>

    <?php
    require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_topNav.php";
    ?>

    <div id="wrapper">

        <?php
        require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_leftNav.php";
        ?>

        <main>

            <h1>
                PHP Strings Functions
            </h1>

            <?php
            // Define a string variable
            $description = 'This PHP programming guide teaches beginners useful coding skills.';
            $keyword = 'PHP';

            // Display the original description
            echo '<p><strong>Original description:</strong> ';
            echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
            echo '</p>';

            // Use str_replace() to replace 'beginners' with 'students'
            $replaced_description = str_replace(
                'beginners',
                'students',
                $description
            );

            // Display the replaced description
            echo '<p><strong>Replaced description:</strong> ';
            echo htmlspecialchars($replaced_description, ENT_QUOTES, 'UTF-8');
            echo '</p>';


            // Use strpos() to check if $description contains "PHP"
            $contains_keyword = strpos($description, $keyword) !== false;

            // Use strtolower() to convert the description to lowercase
            $lowercase_description = strtolower($description);

            // Use strtoupper() to convert the description to uppercase
            $uppercase_description = strtoupper($description);

            // Use strlen() to get the length of the description
            $description_length = strlen($description);

            // Use sprintf() to format a price with two decimal places
            $price =19.9;
            $formatted_price = sprintf('$%.2f', $price);

            // Use number_format() to format a large number with commas
            $large_number = 1000000;
            $formatted_number = number_format($large_number);

            $short_description = substr($description, 0, 20);

            ?>

            <h2>
            String Function Results
            </h2>

            <table id="string-results">
                <thead>
                    <tr>
                        <th>Function</th>
                        <th>Input</th>
                        <th>Output</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            str_replace()
                        </td>
                        <td>
                            <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($replaced_description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            str_contains()
                        </td>
                        <td>
                            <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($contains_keyword ? 'True' : 'False', ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            strtolower()
                        </td>
                        <td>
                            <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($lowercase_description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            strtoupper()
                        </td>
                        <td>
                            <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($uppercase_description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            strlen()
                        </td>
                        <td>
                            <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars((string)$description_length, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            sprintf()
                        </td>
                        <td>
                            <?php echo htmlspecialchars((string)$price, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($formatted_price, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            number_format()
                        </td>
                        <td>
                            <?php echo htmlspecialchars((string)$large_number, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($formatted_number, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            substr()
                        </td>
                        <td>
                            <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($short_description, ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>

                </tbody>

            </table>

        </main>
    </div>

    &ensp;
    <div>
        <h3><a href="index.php">&lt;&lt;&lt; Back to SSP04 Landing Page</a></h3>
    </div>

    <?php
    require_once __DIR__ . "/../../Week 1/SSP02/PHP/include_footer.php";
    ?>

</body>
</html>