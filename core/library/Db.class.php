<?php

namespace library;

use PDO;

class Db
{
 
    private static $_instance = null;

    private $_pdo, $_query, $_error = false, $_results, $_count = 0;

    /**
     * Соединие с базой данных 
     */
    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host='. Config::get('mysql.host') .';dbname=' . Config::get('mysql.dbname') . ';charset=' . Config::get('mysql.charset'),Config::get('mysql.username'), Config::get('mysql.password'));
            // echo 'Connected';
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    /**
     * Соединение производится 1 раз
     * Например: 
     * DB::getInstance(); // Connected
     * DB::getInstance(); // второй раз не подключится, так как подключение уже произведено
     *
     * @return void
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    /**
     * Выполняет sql-запрос
     *
     * @param [type] $sql
     * @param array $params
     * @return void
     */
    public function query($sql, $params = array())
    {
        $this->_error = false;
        // подготавляем запрос 
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {

                // если в query во 2 параметре будет несколько данных, то он их найдет
                // DB::getInstance()->query("SELECT * FROM `users` WHERE `login` = ?", array('kuatovb', 'alex')); 
                // во 2 параметре есть 2 записи это 'kuatovb' и 'alex'
                // оно будет искать в базе 2 записи 'kuatovb' и 'alex' 
 
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            // Проверяет и выполнят sql-запрос

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else {
                $this->_error = true;
            }
        }

        return $this;
    }



    /**
     * Это метод формирует sql-запрос 
     *
     * @param [type] $action
     * @param [type] $table
     * @param array $where
     * @return void
     */
    public function action($action, $table, $where = array())
    {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            # Проверяем наличеие массивов и формируем sql-запрос
            # Например можно сформировать такие запросы: SELECT * FROM `users` WHERE `login` = 'kuatovb' или
            # DELET FROM `users` WHERE `login` = 'kuatovb', для этого созданы 2 метода это get() и delete()  
            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM `{$table}` WHERE {$field} {$operator} ?";

                # Здесь выполняется sql-запрос
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    /**
     * Получаем 1 запись из базы
     *
     * @param [type] $table
     * @param [type] $where
     * @return void
     */
    public function get($table, $where)
    {
        //DB::getInstance()->get('users', array('id','=' , 2)); - это запись превращается в это
        // SELETC * FROM `users` WHERE `id` = 2
        return $this->action('SELECT *', $table, $where);
    }

    /**
     * Удаляем 1 запись из базы
     *
     * @param [type] $table
     * @param [type] $where
     * @return void
     */
    public function delete($table, $where)
    {
        //DB::getInstance()->delete('users', array('id','=' , 2)); - это запись превращается в это
        // DELETE FROM `users` WHERE `id` = 2
        return $this->action('DELETE', $table, $where);
    }

    /**
     * Это метод добавляет запись в базу данных
     *
     */
    public function insert($table, $fields = array())
    {
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        // Здесь формируется значение $values
        // сколько записи в переменной $field столько и он добавит '?'
        // например, если в $fields 2 записи, то он добавит 2 значения '?, ?'  и так далее
        foreach ($fields as $field) {
            $values .= "?";
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO `{$table}` (";
        $sql .= "`".implode('`, `', $keys) . "`) VALUES ({$values})" ;

        // die($sql);
        
        // проверятся и выполнятся sql-запрос
        // если sql-запрос верный, то он вернет true, в ином случае вернет false
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }
    
    /**
     * Обновляем данные в базе
     * 
     * @param  string $table  
     * @param  int|string $id     
     * @param  [type] $fields 
     * @return boolean
     */
    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        // Здесь формируется значение $set
        // сколько записи в переменной $field столько и он добавит '?'
        // например, если в $fields 2 записи, то он добавит 2 значения '?, ?'  и так далее 
        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ' ;
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE `id` = {$id}";

        // проверятся и выполнятся sql-запрос
        // если sql-запрос верный, то он вернет true, в ином случае вернет false
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    /**
     * Вытаскиевает данные, если был испольован метод get()
     *
     * @return void
     */
    public function first()
    {
        return $this->results()[0];
    }

    /**
     * показывает данные в виде обьекта, но для этого нужно использовать метод get() 
     *
     * @return void
     */
    public function results()
    {
        return $this->_results;
    }

    /**
     * возвращает true или false, в зависимости от выполнения sql - запроса
     *
     * @return void
     */
    public function error()
    {
        return $this->_error;
    }

    /**
     * Возвращает количество строк, затронутых последним SQL-запросом
     *
     * @return void
     */
    public function count()
    {
        return $this->_count;
    }

}


?>