<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_habit'])) {
    $habitName = trim($_POST['new_habit']);
    
    if (!empty($habitName)) {
        // Добавляем привычку
        $newHabit = add_new_habit($habitName);
        
        $_SESSION['message'] = "Привычка '$habitName' добавлена!";
        $_SESSION['message_type'] = 'success';
    }
}

header('Location: index.php');
exit;
?>