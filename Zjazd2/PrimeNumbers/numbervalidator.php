<?php
function is_prime($number) {
    if ($number < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        global $iterations;
        $iterations++;
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}
$iterations = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['number'])) {
    $number = intval($_POST['number']);
    if ($number > 0) {
        $is_prime = is_prime($number);
        if ($is_prime) {
            echo "<p>$number is a prime number.</p>";
        } else {
            echo "<p>$number is not a prime number.</p>";
        }
        echo "<p>Iterations needed: $iterations</p>";
    } else {
        echo "<p>Please enter a positive integer.</p>";
    }
}
?>
