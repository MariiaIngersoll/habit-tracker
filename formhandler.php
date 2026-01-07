<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_habit'])) {
    $habitName = trim($_POST['new_habit']);
    
    if (!empty($habitName)) {
        // Добавляем привычку
        $_SESSION['habits'][] = [
            'id' => uniqid(),
            'name' => htmlspecialchars($habitName),
            'created' => date('Y-m-d'),
            'completed_today' => false
        ];
        
        $_SESSION['message'] = "Привычка '$habitName' добавлена!";
        $_SESSION['message_type'] = 'success';
    }
}

header('Location: index.php');
exit;
?>