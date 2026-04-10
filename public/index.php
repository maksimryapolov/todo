<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задачи по статусам</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: #f4f5f7;
            padding: 24px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 24px;
            color: #172b4d;
        }

        /* Kanban доска */
        .board {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        /* Колонка статуса */
        .column {
            flex: 1;
            background: #ebecf0;
            border-radius: 8px;
            padding: 12px;
            min-width: 250px;
        }

        .column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding: 0 4px;
        }

        .column-title {
            font-weight: 600;
            color: #5e6c84;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.4px;
        }

        .column-count {
            background: rgba(0,0,0,0.08);
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 13px;
            color: #5e6c84;
        }

        /* Карточка задачи */
        .task-card {
            background: white;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 4px solid transparent;
            transition: box-shadow 0.2s;
        }

        .task-card:hover {
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }

        /* Статусы с цветами */
        .status-backlog .task-card {
            border-left-color: #97a0af;
        }
        .status-progress .task-card {
            border-left-color: #0052cc;
        }
        .status-done .task-card {
            border-left-color: #0b875b;
        }

        .task-id {
            font-size: 12px;
            color: #6b778c;
            margin-bottom: 6px;
        }

        .task-name {
            font-weight: 600;
            font-size: 15px;
            color: #172b4d;
            margin-bottom: 8px;
        }

        .task-slug {
            font-size: 12px;
            color: #7a869a;
            background: #f4f5f7;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .task-description {
            font-size: 13px;
            color: #5e6c84;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .task-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #6b778c;
            border-top: 1px solid #e9edf2;
            padding-top: 8px;
            margin-top: 4px;
        }

        .task-date {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .task-date:before {
            content: "📅";
            font-size: 11px;
        }

        /* Дополнительные поля (для расширения) */
        .task-extra {
            margin-top: 8px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .extra-field {
            background: #f0f2f5;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            color: #44546f;
        }

        .extra-field strong {
            color: #253858;
            margin-right: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Доска задач</h1>

        <div class="board">
            <!-- Колонка: Нужно сделать -->
            <div class="column status-backlog">
                <div class="column-header">
                    <span class="column-title">📝 Нужно сделать</span>
                    <span class="column-count">3</span>
                </div>

                <!-- Задача 1 -->
                <div class="task-card">
                    <div class="task-id">#TASK-18</div>
                    <div class="task-name">Работа с todo</div>
                    <div class="task-slug">todo-frontend</div>
                    <div class="task-description">актуализировать проект todo, добавить новые фичи</div>
                    <div class="task-meta">
                        <span class="task-date">08.03.2026</span>
                        <span>⏳ Приоритет: высокий</span>
                    </div>
                    <!-- Дополнительные поля -->
                    <div class="task-extra">
                        <span class="extra-field"><strong>Оценка:</strong> 5ч</span>
                        <span class="extra-field"><strong>Исполнитель:</strong> Иван</span>
                    </div>
                </div>

                <!-- Задача 2 -->
                <div class="task-card">
                    <div class="task-id">#TASK-15</div>
                    <div class="task-name">Рефакторинг API</div>
                    <div class="task-slug">api-refactor</div>
                    <div class="task-description">оптимизировать запросы к базе данных</div>
                    <div class="task-meta">
                        <span class="task-date">07.03.2026</span>
                        <span>🏷 Бэкенд</span>
                    </div>
                    <div class="task-extra">
                        <span class="extra-field"><strong>Спринт:</strong> 12</span>
                    </div>
                </div>

                <!-- Задача 3 -->
                <div class="task-card">
                    <div class="task-id">#TASK-12</div>
                    <div class="task-name">Обновить документацию</div>
                    <div class="task-slug">docs-update</div>
                    <div class="task-description">написать инструкцию по развертыванию</div>
                    <div class="task-meta">
                        <span class="task-date">06.03.2026</span>
                        <span>📄 Docs</span>
                    </div>
                </div>
            </div>

            <!-- Колонка: В процессе -->
            <div class="column status-progress">
                <div class="column-header">
                    <span class="column-title">⚡ В процессе</span>
                    <span class="column-count">2</span>
                </div>

                <!-- Задача 4 -->
                <div class="task-card">
                    <div class="task-id">#TASK-10</div>
                    <div class="task-name">Верстка главной страницы</div>
                    <div class="task-slug">main-layout</div>
                    <div class="task-description">адаптивная верстка под все устройства</div>
                    <div class="task-meta">
                        <span class="task-date">05.03.2026</span>
                        <span>🎨 Дизайн</span>
                    </div>
                    <div class="task-extra">
                        <span class="extra-field"><strong>Прогресс:</strong> 70%</span>
                        <span class="extra-field"><strong>Дедлайн:</strong> 10.03</span>
                    </div>
                </div>

                <!-- Задача 5 -->
                <div class="task-card">
                    <div class="task-id">#TASK-8</div>
                    <div class="task-name">Настройка авторизации</div>
                    <div class="task-slug">auth-module</div>
                    <div class="task-description">JWT токены, роли пользователей</div>
                    <div class="task-meta">
                        <span class="task-date">04.03.2026</span>
                        <span>🔐 Безопасность</span>
                    </div>
                    <div class="task-extra">
                        <span class="extra-field"><strong>Тесты:</strong> в процессе</span>
                    </div>
                </div>
            </div>

            <!-- Колонка: Готово -->
            <div class="column status-done">
                <div class="column-header">
                    <span class="column-title">✅ Готово</span>
                    <span class="column-count">2</span>
                </div>

                <!-- Задача 6 -->
                <div class="task-card">
                    <div class="task-id">#TASK-5</div>
                    <div class="task-name">Настроить CI/CD</div>
                    <div class="task-slug">ci-cd-setup</div>
                    <div class="task-description">github actions для деплоя</div>
                    <div class="task-meta">
                        <span class="task-date">03.03.2026</span>
                        <span>🚀 Деплой</span>
                    </div>
                    <div class="task-extra">
                        <span class="extra-field"><strong>Версия:</strong> 1.2.0</span>
                    </div>
                </div>

                <!-- Задача 7 -->
                <div class="task-card">
                    <div class="task-id">#TASK-3</div>
                    <div class="task-name">Базовая архитектура</div>
                    <div class="task-slug">project-structure</div>
                    <div class="task-description">создание структуры проекта, настройка линтеров</div>
                    <div class="task-meta">
                        <span class="task-date">02.03.2026</span>
                        <span>🏗 Архитектура</span>
                    </div>
                    <div class="task-extra">
                        <span class="extra-field"><strong>Ревью:</strong> пройдено</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Информация о формате (минимально, без JS) -->
        <div style="margin-top: 32px; padding: 16px; background: #e9edf2; border-radius: 8px; font-size: 13px; color: #44546f;">
            <strong>📌 Формат задачи:</strong> id, name, slug, description, createdAt + дополнительные поля отображаются внизу карточки
        </div>
    </div>

    </script>
</body>
</html>