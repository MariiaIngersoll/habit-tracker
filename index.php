<?php

require_once 'config.php';

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Трекер привычек на день</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Шапка -->
        <header class="header">
            <h1>📝 Трекер привычек</h1>
            <p>Сегодня: <?php echo $today_formatted ?></p>
        </header>

        <!-- Сообщения -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Быстрая статистика -->
        <div class="stats">
            <div class="stat">
                <div class="stat-number">0</div>
                <div class="stat-label">Всего</div>
            </div>
            <div class="stat">
                <div class="stat-number">0</div>
                <div class="stat-label">Выполнено</div>
            </div>
            <div class="stat">
                <div class="stat-number">
                    %
                </div>
                <div class="stat-label">Прогресс</div>
            </div>
        </div>
        
        <!-- Форма добавления новой привычки -->
        <div class="add-form">
            <h2 >🚀 Добавить привычку!</h2>
            <form action="formhandler.php" method="POST">
                <input 
                    type="text"
                    name="new_habit"
                    placeholder="Что ты хочешь сделать сегодня?"
                    required autofocus>
                <button type="submit">Добавить</button>
            </form>
        </div>

        <!-- Список привычек -->
        
        <div class="habit-list">
            <h3>Мои привычки на сегодня:</h3>
            <br>
            <?php if (empty($_SESSION['habits'])): ?> 
                <div class="empty">
                    <p>📭 Список привычек пуст</p>
                    <p>Добавьте первую привычку выше</p>
                </div>
                <?php else: ?>
                    <?php foreach($_SESSION['habits'] as $index => $habit): ?>
                        <div class="habit-item <?php echo $habit['completed_today'] ? 'habit-completed' : ''; ?>">
                            <!-- Чекбокс -->
                            <a href="toggle.php?id=<?php echo $index; ?>">
                                <?php if ($habit['completed_today']): ?>
                                    <span style="color: #4CAF50; font-size: 24px; margin-right: 15px;">✅</span>
                                <?php else: ?>
                                    <span sryle="color: #ccc; font-size:24px; margin-right: 15px;">⬜</span>
                                <?php endif; ?>
                            </a>
                            <div class="habit-name" >
                                <?php echo htmlspecialchars($habit['name']); ?>
                            </div>

                            <!-- Кнопка удаления отдельной привычки -->
                            <a href="delete.php?id=<?php echo $index; ?>" 
                            class="btn btn-delete btn-small"
                            onclick="return confirm('Удалить эту привычку?')">
                                Удалить
                            </a>
                        </div>
                    <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- Кнопка очистки всех -->
        <form style="text-align: center;" action="clear_all.php" method="POST">
            <button type="submit" 
                    class="btn btn-delete"
                    onclick="return confirm('Удалить ВСЕ привычки?')">
                🗑️ Очистить все
            </button>
        </form>                 
        <footer style="margin-top: 40px; text-align: center; color: #777; font-size: 14px;">
            <p>Простой трекер привычек на день</p>
        </footer>
    </div>
</body>
</html>