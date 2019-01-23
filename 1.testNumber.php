<?php 
//1. Написать регулярку для проверки является ли строка числом, длиной до 5 цифр

function isNumberLength1_5($testString) {
    $pattern = "/^\d{1,5}$/";
    echo "Test sting: "; 
    var_dump($testString); 
    echo "<br>";
    echo "Result: ".($result = preg_match($pattern, $testString, $matches))."<br>Array of matches: ";
    print_r($matches);
    echo "<br><br>";
    return $result;
}

isNumberLength1_5(0);
isNumberLength1_5(12);
isNumberLength1_5(12345);
isNumberLength1_5(123456);
isNumberLength1_5("32");
isNumberLength1_5(" 32");
isNumberLength1_5("32 ");
isNumberLength1_5("");
isNumberLength1_5(" ");
isNumberLength1_5("s23");
isNumberLength1_5("2s3");
isNumberLength1_5("23s");
isNumberLength1_5("23 23");
isNumberLength1_5("24".PHP_EOL."24");

?>