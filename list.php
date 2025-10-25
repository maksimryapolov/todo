<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
</head>
<body>
    <h1>Список пользователей</h1>
    <ol>
        <? foreach(file('data.txt') as $str): ?>
            <li>
                <p><?= $str; ?></p>
            </li>
        <? endforeach; ?>
    </ol>
</body>
</html>