<?php
require_once 'config.php';
require_once 'autoloader.php';
$db = new DataBase();
$db->connectToDB();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Домашнее задание - Управление таблицами</title>
    <style>
        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
            padding: 15px;
        }

        table {
            border-collapse: collapse;
            width: 70%;
            margin-left: 15%;
            margin-right: 25%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h3 style="text-align: center">Просмотр информации о таблицах в базе данных - <?php echo DB_NAME ?></h3>
<form method="post" style="width: 50%; margin-left:25%; margin-right:25%; text-align: center">
    <label for="select_table">Выберите таблицу:</label>
    <select name="select_table">
        <?php $tables = $db->getAllTablesNames(); foreach ($tables as $table) : foreach ($table as $name) : ?>
        <option value="<?php echo $name ?>"><?php echo $name ?></option>
        <?php endforeach; endforeach; ?>
    </select>
    <button type="submit">Показать данные</button>
</form>
<?php if (isset($_POST['select_table'])) : ?>
<table>
    <tr>
        <th>Поле</th>
        <th>Тип</th>
        <th>NULL</th>
        <th>Ключ</th>
        <th>Значение по умолчанию</th>
        <th>Дополнительно</th>
    </tr>
    <tr>
     <?php $tableInfo = $db->getInfoAboutTable($_POST['select_table']);
    foreach ($tableInfo as $field): ?>
    <tr>
        <?php foreach ($field as $detail): ?>
        <td>
        <?php echo $detail; ?>
        </td>
        <?php endforeach; ?>
    </tr>
        <?php endforeach; ?>
</table>
<?php endif; ?>
</body>
</html>
