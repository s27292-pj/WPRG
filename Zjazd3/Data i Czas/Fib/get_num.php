<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $number = @$_GET["num_var"];
    if (!isset($number)) {
        throw new ErrorException("Number has not been chosen");
    } else {
        if ($number < 0 ) {
            throw new ErrorException("Number has to be greater than 0 ");
        } else {
            echo("The number is: " . $number . "<br>");
            $timefact = microtime(true);
            echo("Result of factoring ".$number . " is: " .  factorial($number) . "<br>");
            echo("Time needed to execute factorial: " . (microtime(true) - $timefact) . "<br>");
            $timefib = microtime(true);
            echo("Result of fib ".$number . " is: " .  fib($number) . "<br>");
            echo("Time needed to execute fib: " . (microtime(true) - $timefib) . "<br>");
            if($timefact < $timefib){
                echo ("Factorial function is faster by whoppping" . ($timefib - $timefact));
            } else {
                echo ("Fibonacci function is faster by whopping" . ($timefact - $timefib));
            }
        }
    }
}

function factorial($number){
    if ($number < 2 ) {
        return 1;
    } else {
        return $number*factorial($number-1);
    }
}

function fib($number){
    if ($number == 0) {
        return 0;
    } else if ($number == 1) {
        return 1;
    } else {
        return (fib($number-1) + fib($number-2));
    }
}


