<?php
// database.php - подключение к базе данных MySQL

// 1. Настройки базы данных
$db_host = '127.0.0.1';     // адрес сервера
$db_name = 'habit_tracker'; // имя базы данных
$db_user = 'root';          // имя пользователя
$db_pass = '';              // пароль (пустой для XAMPP)

// 2. Функция подключения к базе
function connect_to_db() {
    // Берем настройки из переменных выше
    global $db_host, $db_name, $db_user, $db_pass;
    
    // Строка подключения
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    
    try {
        // Пробуем подключиться
        $pdo = new PDO($dsn, $db_user, $db_pass);
        
        // Настраиваем чтобы ошибки показывались
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo; // Возвращаем подключение
    } catch (PDOException $e) {
        // Если ошибка - показываем и останавливаем скрипт
        die("Ошибка подключения к базе: " . $e->getMessage());
    }
}

// 3. Функция получить ВСЕ привычки
function get_all_habits() {
    $pdo = connect_to_db();
    
    // Выполняем SQL запрос
    $sql = "SELECT * FROM habits ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    
    // Получаем все записи как массив
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
var_dump(get_all_habits());