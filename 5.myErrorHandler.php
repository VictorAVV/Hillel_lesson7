<?php
// Дополнить обработчик фатальных ошибок выводом исходного кода файла 
// где была допущена ошибка, а так же добавьте подсветку синтаксиса выводимого кода.

error_reporting(E_ALL);
ini_set('display_errors','On');	

set_error_handler("myErrorHandler");
register_shutdown_function('shutdown');

$linesWithWarningError = array();

function shutdown() {
    global $linesWithWarningError;
    $error = error_get_last();
    echo "<br>";

    /* этот код сотрет все сообщения об ошибках (фатальных и нефатальных)
    // если в коде была допущена ошибка и это одна из фатальных ошибок
    if (is_array($error) && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        // очищаем буфер вывода 
        while (ob_get_level()) {
            ob_end_clean();
        }
        // выводим описание проблемы
        echo "Сервер находится на техническом обслуживании, зайдите позже";
    } */

    if (is_array($error)) {
        $lineWithFatalError = $error["line"];
    } else {
        $lineWithFatalError = false;
    }
    if ($lineWithFatalError || !empty($linesWithWarningError)) {
        $fileArray = file(__FILE__);
        echo "<pre>";
        foreach ($fileArray as $num => $string) {
            $backlightS = $backlightFin = "";
            if ($lineWithFatalError && ($num + 1) == $lineWithFatalError) {
                $backlightS = "<span style='background-color: red;'>";
                $backlightFin = "</span>";
            } elseif (in_array(($num+1), $linesWithWarningError)) {
                $backlightS = "<span style='background-color: aqua;'>";
                $backlightFin = "</span>";
            }

            echo  $backlightS.htmlentities($string).$backlightFin;
        } 
        echo "</pre>";
    } else {
        echo "Скрипт успешно завершился";
    }
}

function myErrorHandler($errno, $errstr, $errfile, $errline) {
    global $linesWithWarningError;
    if (!(error_reporting() & $errno)) {
        // Этот код ошибки не включен в error_reporting,
        // пусть обрабатываются стандартным обработчиком ошибок PHP
        return false;
    }

    $errors = array(
        E_ERROR => 'E_ERROR',
        E_WARNING => 'E_WARNING',
        E_PARSE => 'E_PARSE',
        E_NOTICE => 'E_NOTICE',
        E_CORE_ERROR => 'E_CORE_ERROR',
        E_CORE_WARNING => 'E_CORE_WARNING',
        E_COMPILE_ERROR => 'E_COMPILE_ERROR',
        E_COMPILE_WARNING => 'E_COMPILE_WARNING',
        E_USER_ERROR => 'E_USER_ERROR',
        E_USER_WARNING => 'E_USER_WARNING',
        E_USER_NOTICE => 'E_USER_NOTICE',
        E_STRICT => 'E_STRICT',
        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
        E_DEPRECATED => 'E_DEPRECATED',
        E_USER_DEPRECATED => 'E_USER_DEPRECATED',
    );
    echo "<b>{$errors[$errno]}</b> [$errno] In line $errline: $errstr<br />\n";
    $linesWithWarningError[] = $errline;
    /* Не запускаем внутренний обработчик ошибок PHP */
    return true;
}

echo $undefined_var;
array_key_exists('key', NULL);
//$r = "asd" + array(1,1);
//require 'null';
str_replace();
//s
include 'null';
require 'null';

?>
