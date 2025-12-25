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
        </header>
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
            <form method="POST">
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
                <div class="empty">
                    <p>📭 Список привычек пуст</p>
                    <p>Добавьте первую привычку выше</p>
                </div>

        <button class='btn-clear'> Очистить все</button>

        <footer style="margin-top: 40px; text-align: center; color: #777; font-size: 14px;">
            <p>Простой трекер привычек на день</p>
        </footer>
    </div>
</body>
</html>