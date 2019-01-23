<?php
//3. Найти текст, заключенный в какой-то тег, например <TITLE> ... </TITLE> из HTML-файла и вывести данный текст

$htmlFile = "test.html";
$fileContens = file_get_contents($htmlFile);
$tag = "title";
//$tag = "label";

$pattern = "/<$tag.*>(.*)<\/$tag\s*>/isU";

$count = preg_match_all($pattern, $fileContens, $matches);

echo "Count of matches: ".$count."<br>";

if ($count) {
    foreach ($matches[1] as $num => $match) {
        echo ($num + 1)." match: ".trim(htmlentities($match))."<br>";
    }
}

?>