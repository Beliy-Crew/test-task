<<?php

class Database {

    //свойство проверяет есть ли подключение к базе или нет
    public $isConn;
    //Свойство сохраняет все детали подключение
    protected $datab;
    
    public $id;       //id
    public $name;     //имя
    public $surname;  //фамилия
    public $births;   //возраст
    public $gender;  //пол  0-жен. 1-муж
    public $city;    //город рождения
    


    //подключение к БД
    public function __construct($username = "root", $password = "", $host = "localhost", $dbname = "people", $options = []) {
        //проверка подключения
        $this->isConn = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    //разъединение от БД
    public function Disconnect() {
        $this->datab = NULL;
        $this->isConn = FALSE;
    }

    //получение одной записи из БД
    public function getRow($query, $params = []) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    //получение нескольких записей из БД
    public function getRows($query, $params = []) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    //новая запись в БД
    public function insertRow($query, $params = []) {
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    //обновление записи в БД
    public function updateRow($query, $params = []) {
        $this->insertRow($query, $params);
    }

    //удаление записи в БД
    public function deleteRow($query, $params = []) {
        $this->insertRow($query, $params);
    }
    
    //метод преобразования пола
    public function getGender($query, $params = []) {
        $this->insertRow($query, $params);
    }
    
    //метод преобразования возраста
    public function getAge($query, $params = []) {
        $this->insertRow($query, $params);
    }

}