<?php
//4. Написать форму регистрации пользователей с обязательными полями:
// логин (длина поля не более 15 символов),
// пароль(не меньше 8 символов, можно использовать буквы английского и русского алфавита, -,_ и цифры),
// e-mail и информация о себе.
// В обработчике формы сделать обработку данных полей на валидность
// и в тексте “информация о себе” заменить все заглавные буквы на прописные с помощью регулярки. (первую букву в начале предложений)

$loginErr = $passwordErr = $emailErr = $aboutUserErr = false;

$pathToFile = "user.txt";

if (!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['aboutuser'])) {
    header('Location: index.html'); 
}

$login = trim($_POST['login']);
$loginErrMessage = "";
if (strlen($login) == 0) {
    $loginErrMessage = "Логин пустой!";
} elseif (strlen($login) > 15) {
    $loginErrMessage = "Логин содержит более 15 символов!";
}
if ($loginErrMessage != "") {
    $loginErr = true;
}

$password = trim($_POST['password']);
$passwordErrMessage = "";
if (strlen($password) < 8) {
    $passwordErrMessage = "Пароль менее 8 символов!";
} elseif (strlen($password) > 50) {
    $passwordErrMessage = "Пароль более 50 символов!";
} elseif (!preg_match("/^([a-zA-Zа-яА-ЯёЁ\-_\d])+/", $password) ) {
    $passwordErrMessage = "Пароль может содержать следующие символы: русские и латинские символы, цифры, '-', '_'.";
}
if ($passwordErrMessage != "") {
    $passwordErr = true;
}

$email = trim($_POST['email']);
$emailErrMessage = "";
if (strlen($email) == 0) {
    $emailErrMessage = "Email пустой!";
} elseif (strlen($email) > 100) {
    $emailErrMessage = "Email длинной более 100 characters!";
} elseif (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
    $emailErrMessage = "Адрес ошибочный.";
}
if ($emailErrMessage != "") {
    $emailErr = true;
}

$aboutUser = trim($_POST['aboutuser']);
$aboutUserErrMessage = "";
if (strlen($aboutUser) == 0) {
    $aboutUserErrMessage = "Поле 'Информация о себе' пустое!";
} elseif (strlen($aboutUser) > 500) {
    $aboutUserErrMessage = "Поле 'Информация о себе' содержит более 500 символов!";
}
if ($aboutUserErrMessage != "") {
    $aboutUserErr = true;
} else {
    //меняем первую букву в каждом предложении на прописную
    $aboutUser = preg_replace_callback(
        '/^\s*([\w])|[\.|\?|\!]\s*([\w])/u', 
        function ($char) {
            return mb_strtoupper($char[0], "UTF-8");
        }, 
        $aboutUser
    );
}

if ($loginErr || $passwordErr || $emailErr || $aboutUserErr) {
    require_once('errormsg.php');
} else {
    $handle = fopen($pathToFile, "w");
    fwrite($handle, "login = $login".PHP_EOL);
    fwrite($handle, "password = $password".PHP_EOL);
    fwrite($handle, "email = $email".PHP_EOL);
    fwrite($handle, "aboutUser = $aboutUser".PHP_EOL);
    fclose($handle);
    require_once('okmsg.php');
}

?>