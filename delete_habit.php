<?php

require_once 'config.php';

// Проверяем наличие и валидность ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = "Ошибка: неверный ID!";
    $_SESSION['message_type'] = "error";
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

// Проверяем существование привычки
if (!isset($_SESSION['habits'][$id])) {
    $_SESSION['message'] = "Ошибка: привычка не найдена!";
    $_SESSION['message_type'] = "error";
    header('Location: index.php');
    exit;
}

// Удаляем привычку
$name = $_SESSION['habits'][$id]['name'];
unset($_SESSION['habits'][$id]);
$_SESSION['habits'] = array_values($_SESSION['habits']);

// Сообщение об успехе
$_SESSION['message'] = "Привычка '$name' удалена!";
$_SESSION['message_type'] = "success";

header('Location: index.php');
exit;