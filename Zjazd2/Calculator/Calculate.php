<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wynik</title>
</head>
<body>
<a href="Calculator.html">Return to Calculator</a>
<div id="results"></div>
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['var1']) || empty($_POST['var2'])) {
        $error = "Please enter both numbers";
    } else {
        $num1 = floatval($_POST['var1']);
        $num2 = floatval($_POST['var2']);
        switch ($_POST['operation']) {
            case 'add':
                $result = ($num1 + $num2);
                break;
            case 'subtract':
                $result = ($num1 - $num2);
                break;
            case 'multiply':
                $result = ($num1 * $num2);
                break;
            case 'divide':
                if ($num2 == 0) {
                    $error = "Can't divide by zero";
                } else {
                    $result = ($num1 / $num2);
                }
                break;
            case 'modulo':
                $result = ($num1 % $num2);
                break;
        }
    }
    if (isset($result)) {
        echo "<p>Result: $result</p>";
    } elseif (isset($error)) {
        echo "<p>Error: $error</p>";
    }
}
?>
