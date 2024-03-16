<?php
$tablica = ["jabłko", "banan", "pomarańcza"];
foreach($tablica as $value){
    if($value[0]=='p'){
        echo $value . " zaczyna się na litere p\n";
    } else {
        echo $value . " nie zaczyna się na litere p\n";
    }
}
?>