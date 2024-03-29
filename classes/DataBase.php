<?php
class DataBase
{
    public $pdo;

    public function connectToDB()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . $_SESSION['database'] . ";port=" . DB_PORT, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'utf8'");
        } catch (Exception $e) {
            echo "Произошла ошибка при загрузке базы данных.";
            exit;
        }
    }

    /**
     * Получаем названия таблиц в виде ассоциированного массива
     * @return array
     */
    public function getAllTablesNames()
    {
        $sth = $this->pdo->prepare('SHOW TABLES');
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Получаем всю информацию о таблице
     * @param $table
     * @return mixed
     */
    public function getInfoAboutTable($table)
    {
        $sth = $this->pdo->prepare('DESCRIBE '. $table);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Получаем все базы данных
     * @return array
     */
    public function getAllDatabases()
    {
        $sth = $this->pdo->prepare('SHOW DATABASES');
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Записываем выбранную пользователем базу данных в переменную сессии
     * @return void
     */
    public function selectDataBase()
    {
        if (isset($_POST['database'])) {
            $_SESSION['database'] = $_POST['database'];
        }
        if (!isset($_SESSION['database'])) {
            $_SESSION['database'] = DB_NAME_DEFAULT;
        }
    }
}
