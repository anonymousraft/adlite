<?php

namespace Inc\Migration;

use Inc\Migration\DBConnector;

class DBSeed
{
    private $db_connection = null;

    public function migrate()
    {
        $this->db_connection = (new DBConnector())->getConnection();

        try {
            $createTable = $this->db_connection->exec($this->dbquery());
            echo "Success!\n";
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    private function dbquery()
    {
        $password = $this->passhash('hitendra');
        $password_2 = $this->passhash('kartik');
        $current_date = date('Y-m-d H:i:s');
        var_dump($current_date);
        $statement =
            "
    CREATE TABLE IF NOT EXISTS user (
        id INT NOT NULL AUTO_INCREMENT,
        email VARCHAR(150) NOT NULL,
        login_key VARCHAR(250) NOT NULL,
        api_key_generated INT(1) DEFAULT NULL,
        has_api_key INT(1) DEFAULT NULL,
        key_type VARCHAR(20) DEFAULT NULL,
        api_key_generation_timpstamp VARCHAR(30) DEFAULT NULL,
        api_key VARCHAR(900) DEFAULT NULL,
        user_created VARCHAR(20) DEFAULT NULL,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

   
     INSERT INTO user
        (id, email, login_key, api_key_generated, has_api_key,key_type, api_key_generation_timpstamp,api_key,user_created)
    VALUES
        (1, 'hitendra@obbserv.com', '$password', null, null,null, null,null, '$current_date'), 
        (2, 'dev@obbserv.com', '$password_2', null, null,null, null,null, '$current_date'); 
    ";
        return $statement;
    }

    private function passhash($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}
