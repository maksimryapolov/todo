<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление задачи</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 2.2em;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 0.95em;
        }

        input, textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .date-input {
            position: relative;
        }

        .date-input input {
            padding-right: 45px;
        }

        .date-input::after {
            content: '📅';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            pointer-events: none;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 25px;
            }

            h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Добавить задачу</h1>
        <form id="taskForm" action="/index.php" method="POST">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="taskTitle">Название задачи</label>
                <input type="text" name="name" id="taskTitle" placeholder="Введите название задачи" required>
            </div>

            <div class="form-group">
                <label for="taskDescription">Описание</label>
                <textarea id="taskDescription" name="description" placeholder="Опишите задачу подробнее..."></textarea>
            </div>

            <div class="form-group">
                <label for="taskDate">Срок выполнения</label>
                <div class="date-input">
                    <input type="date" id="taskDate" name="date" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn">Добавить задачу</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('taskForm').addEventListener('submit', function(e) {
            // e.preventDefault();

            const title = document.getElementById('taskTitle').value;
            const description = document.getElementById('taskDescription').value;
            const date = document.getElementById('taskDate').value;

            console.log({
                title,
                description,
                date
            });

            alert('Задача успешно добавлена!');
        });

        // Устанавливаем минимальную дату как сегодняшнюю
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('taskDate').min = today;
    </script>
</body>
</html>