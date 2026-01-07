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
} else {
    $_SESSION['habits'][$id]["completed_today"] = !$_SESSION['habits'][$id]['completed_today'];

    $name = htmlspecialchars($_SESSION['habits'][$id]['name'] ?? '');
    $status = $_SESSION['habits'][$id]['completed_today'] ? '✅ ВЫПОЛНЕНА' : '⏳ НЕ ВЫПОЛНЕНА';
    $_SESSION['message'] = "Привычка " . $name . " отмечена как " . $status;
    $_SESSION['message_type'] = 'success';
}

header('Location: index.php');
exit;



