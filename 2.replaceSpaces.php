<?php
// 2. Заменить все повторяющиеся пробелы в тексте на один

//$text = "a        a";
//$text = "  a    a   ";
//$text = "       ";
//$text = " ";
//$text = "  ";
//$text = "\t\t\t"; //3 символа табуляции
$text = "\t\t\ta        a";
    
$pattern = "/ {2,}/";
//$pattern = "/\s{2,}/"; //будет также обрабатывать символы табуляции

$replacement = ' ';

echo $result = preg_replace($pattern, $replacement, $text, -1, $count); 

echo ("<br>количество замен: $count");

?>