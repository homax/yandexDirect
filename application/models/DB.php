<?php

class DB{

    public $connection;
    private static $_instance;

    public static function getInstance() {
        if(!(self::$_instance instanceof self))
            self::$_instance = new static();
        return self::$_instance;
    }
    private function __construct(){
        // Языковая настройка.
        setlocale(LC_ALL, 'ru_RU.utf8');

        // Подключение к БД.
        try {
            $this->connection = new PDO(FrontController::$config['db']['connect']);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $this->connection->exec('SET NAMES utf8');
    }

    public function Select($query)
    {
        $result = $this->connection->query($query);

        if ($result === false) {
            $error = $this->connection->errorInfo();
            die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
        }

        $arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = $row;
        }

        return $arr;
    }

    //
    // Вставка строки
    // $table 		- имя таблицы
    // $object 		- ассоциативный массив с парами вида "имя столбца - значение"
    // результат	- идентификатор новой строки
    //
    public function Insert($table, $object)
    {
        $columns = array();
        $values = array();

        foreach ($object as $key => $value)
        {
            //$key = $this->connection->quote($key . '');
            $columns[] = $key;

            if ($value === null)
            {
                $values[] = 'NULL';
            }
            else {
                $value = $this->connection->quote($value . '');
                $values[] = "$value";
            }
        }

        $columns_s = implode(',', $columns);
        $values_s = implode(',', $values);

        $query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
        $result = $this->connection->exec($query);
        if ($result === false) {
            $error = $this->connection->errorInfo();
            die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
        }

        return $this->connection->lastInsertId();
    }

    //
    // Изменение строк
    // $table 		- имя таблицы
    // $object 		- ассоциативный массив с парами вида "имя столбца - значение"
    // $where		- условие (часть SQL запроса)
    // результат	- число измененных строк
    //
    public function Update($table, $object, $where)
    {
        $sets = array();

        foreach ($object as $key => $value)
        {
            //$key = $this->connection->quote($key . '');

            if ($value === null)
            {
                $sets[] = "$value=NULL";
            }
            else
            {
                $value = $this->connection->quote($value . '');
                $sets[] = "$key=$value";
            }
        }

        $sets_s = implode(',', $sets);
        $query = "UPDATE $table SET $sets_s WHERE $where";
        $result = $this->connection->query($query);

        if ($result === false) {
            $error = $this->connection->errorInfo();
            die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
        }

        return $result->rowCount();
    }

    //
    // Удаление строк
    // $table 		- имя таблицы
    // $where		- условие (часть SQL запроса)
    // результат	- число удаленных строк
    //
    public function Delete($table, $where)
    {
        $query = "DELETE FROM $table WHERE $where";
        $result = $this->connection->exec($query);


        if ($result === false) {
            $error = $this->connection->errorInfo();
            die("Не выполнен запрос: ".$query."<br>Error: ".$error[2]);
        }

        return $result;
    }

}
 