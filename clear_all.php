<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $success = clear_all_habits();

    if ($success) {

        $_SESSION['message'] = 'Все привычки удалены!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Ошибка при удалении привычек!';
        $_SESSION['message_type'] = 'error';
    }
    
}

header('Location: index.php');
exit;
?>