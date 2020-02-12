<?php
require('config/define.php');

class Db
{
    private static $_instance;
    public $_pdo;
    public $_stmt;
    public $_res;
    public $_rowCount;
    public $_lastInsertID;

    /**
     * Constructeur en privé pour éviter toute autre instanciation.
     */
    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:dbname=' . DB_name  . ';host=' . DB_root, DB_user, DB_password);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function query($request, array $array)
    {
        $this->_stmt = $this->_pdo->prepare($request);
        if ($this->_stmt->execute($array)) {
            $this->_res = $this->_stmt->fetchAll();
            $this->_rowCount = $this->_stmt->rowCount();
            $this->_lastInsertID = $this->_pdo->lastInsertId();
        } else {
            $this->_stmt->errorInfo();
        }
    }

    public function getRowCount()
    {
        return $this->_rowCount;
    }

    public function getlastInsertId()
    {
        return $this->_lastInsertID;
    }

    public function getResult()
    {
        return $this->_res;
    }

    function insert($tableName, $array)
    {
        $insertToQuery = [];

        foreach ($array as $key => $value) {
            $insertToQuery[':' . $key] = $value;
        }
        $insert = "INSERT INTO " . $tableName . " (" . implode(',', array_keys($array)) . ") " . "values(" . implode(',', array_keys($insertToQuery)) . ")";
        $this->query($insert, $insertToQuery);
    }
}

$dbh = Db::getInstance();
