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
            $this->_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
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

    public function query($request, array $array = [])
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


    public function update($table, $tab, $where)
    {
        $stringWhere = '';
        $stringSet = '';

        $queryValue = [];
        foreach ($tab as $key => $value) {
            $stringSet .= "`$key` = :" . $key . ', '; 
            $queryValue[':' . $key] = $value;  
        }

        foreach ($where as $key => $value) {
            $stringWhere .= "`$key` = :" . $key . ' and ';//concaténation de la chaine de clé
            $queryValue[':' . $key] = $value; //concaténation de la chaine clé => valeur
        }

        $stringSet = rtrim($stringSet, ', '); //suppression des espaces
        $stringWhere = rtrim($stringWhere, ' and '); //suppression des espaces
        $sql = "UPDATE $table SET $stringSet  WHERE $stringWhere "; //requete
        $this->query($sql, $queryValue); //envoie requete a query
    }

    public function delete($table, $where)
    {
        $stringWhere = '';
        foreach ($where as $key => $value) {
            $stringWhere .= "`$key` = :" . $key . ' and ';//concaténation de la chaine de clé
            $queryValue[':' . $key] = $value; //concaténation de la chaine clé => valeur
        }
        $stringWhere = rtrim($stringWhere, ' and '); //suppression des espace
        $sql = "DELETE FROM " . $table . " WHERE " . $stringWhere;
        $this->query($sql, $queryValue);
    }
}

$dbh = Db::getInstance();
