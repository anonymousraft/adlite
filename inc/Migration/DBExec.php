<?php

namespace Inc\Migration;

class DBExec
{
    public function dbfetch(String $q, $dbcon)
    {

        try {
            $statement = $dbcon->query($q);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function dbexec(String $statement, $id , $dbcon)
    {
        try {
            $statement = $dbcon->prepare($statement);
            $statement->execute($id);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(String $statement, array $input, $dbcon)
    {
        try {
            $statement = $dbcon->prepare($statement);
            $statement->execute($input);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
