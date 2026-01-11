<?php

// 1. Настройки базы данных
$db_host = '127.0.0.1';     
$db_name = 'habit_tracker'; 
$db_user = 'root';          
$db_pass = '';              

// Глобальная переменная для хранения подключения
$pdo_connection = null;

function connect_to_db() {
    global $pdo_connection, $db_host, $db_name, $db_user, $db_pass;
    
    // Если подключение уже есть - возвращаем его
    if ($pdo_connection !== null) {
        return $pdo_connection;
    }
    
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    
    try {
        $pdo_connection = new PDO($dsn, $db_user, $db_pass);
        $pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo_connection;
    } catch (PDOException $e) {
        die("Ошибка подключения к базе: " . $e->getMessage());
    }
}

// 3. Функция получить ВСЕ привычки
function get_all_habits() {
    $pdo = connect_to_db();
    
    $sql = "SELECT * FROM habits ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function add_new_habit($habit_name) {
    $pdo = connect_to_db();
    $sql = "INSERT INTO habits (name) VALUES (?)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$habit_name]);

    return $pdo->lastInsertId();
}

function toggle_habit_completion($id) {
    $pdo = connect_to_db();
    $sql = "SELECT is_completed FROM habits WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $habit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$habit) {
        return false;
    }

    //  меняем статус привычки на противоположный с не выполнено на выполнлено
    $new_status = $habit['is_completed'] ? 0 : 1;

    // Обновляем в БД
    $sql = "UPDATE habits SET is_completed = ? where id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$new_status, $id]);

    return $new_status;
}



function clear_all_habits() {
    $pdo = connect_to_db();

    try {
        $sql = "DELETE FROM habits";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(); 
    } catch (PDOException $e) {
        error_log("Ошибка при очистке привычек: " . $e->getMessage());
        return false;  
    }
}