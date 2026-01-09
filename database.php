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

// function delete_all() {
//     $pdo = connect_to_db();
//     $pdo->exec("DELETE FROM habits");
// }
