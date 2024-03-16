<?php
$text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum";
$table = explode(" ",$text);
$new_tab = [];
for ($i=0; $i < count($table); $i++) { 

}
foreach($table as $value){
    for($x = 0 ; $x < strlen($value); $x++){
        if(ord($value[$x]) >= 33 && ord($value[$x]) <= 47){
            /* Wykrywa ze jest */
            print($value."\n");
        } else {
            /* Wykrywa ze nie jest */
            array_push($new_tab,$value);
        }
    }
}
var_dump($new_tab);
?>