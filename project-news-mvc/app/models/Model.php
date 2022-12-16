<?php

namespace app\models;

use PDO;
use PDOException;

class Model
{

    private $connection;

    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    private $dbHost = DB_HOST;
    private $dbUserName = DB_USERNAME;
    private $dbName = DB_NAME;
    private $dbPassword = DB_PASSWORD;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function select($sql, $values = null)
    {
        try {
            $stmt = $this->connection->prepare($sql);
            if ($values == null) {
                $stmt->execute();
            } else {
                $stmt->execute($values);
            }
            $result = $stmt;
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insertMethod($tableName, $fields, $values)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO " . $tableName . "(" . implode(', ', $fields) . " , created_at) VALUES ( :" . implode(', :', $fields) . " , now() );");
            $stmt->execute(array_combine($fields, $values));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateMethod($tableName, $id, $fields, $values)
    {

        $sql = "UPDATE " . $tableName . " SET";
        foreach (array_combine($fields, $values) as $field => $value) {
            if ($value) {
                $sql .= " `" . $field . "` = ? ,";
            } else {
                $sql .= " `" . $field . "` = NULL ,";
            }
        }

        $sql .= " updated_at = now()";
        $sql .= " WHERE id = ?";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteMethod($tableName, $id)
    {
        $sql = "DELETE FROM " . $tableName . " WHERE id = ? ;";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    protected function query($query, $values = null)
    {
        try {
            if ($values == null) {
                return $this->connection->query($query);
            } else {
                $stmt = $this->connection->prepare($query);
                $stmt->execute($values);
                return $stmt;
            }

        } catch (PDOException $e) {
            echo "There is some problem in connection:" . $e->getMessage();
        }

    }

}
