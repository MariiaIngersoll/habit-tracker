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
$result = toggle_habit_completion($id);

// Проверяем существование привычки
if ($result === false) {
    $_SESSION['message'] = "Ошибка: привычка не найдена!";
    $_SESSION['message_type'] = "error";
    header('Location: index.php');
    exit;
} else {
    $pdo = connect_to_db();
    $stmt = $pdo->prepare("SELECT name, is_completed FROM habits WHERE id = ?");
    $stmt->execute([$id]);
    $habit = $stmt->fetch();

    if ($habit) {
        $name = htmlspecialchars($habit['name']);
        $status = $result ? '✅ ВЫПОЛНЕНА' : '⏳ НЕ ВЫПОЛНЕНА';
        $_SESSION['message'] = "Привычка \"$name\" отмечена как $status";
        $_SESSION['message_type'] = 'success';
    }
}

header('Location: index.php');
exit;



