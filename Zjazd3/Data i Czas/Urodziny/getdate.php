<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $date = @$_GET["date_var"];
    if (!isset($date)){
        throw new ErrorException("Date has not been set");
    } else {
        echo ("Date is: " . $date . "<br>");
        echo ("Day of your birth was: " . dayOfBirthday($date) . "<br>");
        echo ("Your age is: " . calculateAge($date) . "<br>");
        echo ("Days till next birthday: " . daysUntilNextBirthday($date) . "<br>");
    }
}
function dayOfBirthday($datevalue){
    return date("l", strtotime($datevalue));
}


function calculateAge($birthdate) {
    $today = date_create(date("Y-m-d"));
    $birth_date = date_create($birthdate);
    $age = date_diff($today, $birth_date)->y;
    return $age;
}

function daysUntilNextBirthday($birthdate) {
    $today = date_create(date("Y-m-d"));
    $next_birthday = date_create(date("Y-m-d", strtotime("+" . (calculateAge($birthdate) + 1) . " years", strtotime($birthdate))));
    $diff = date_diff($today, $next_birthday);
    return $diff->format("%a");
}