<?php

namespace Inc\Migration;

class DBQueries
{

    public function getRecordByID(INT $id, String $table): string
    {
        $q = "     
            SELECT 
                *
            FROM
                $table
            WHERE
                id='$id';
        ";

        return $q;
    }

    public function getRecordByEmail(String $email, String $table): string
    {
        $q = "     
            SELECT 
                *
            FROM
                $table
            WHERE
                email='$email';
        ";

        return $q;
    }

    public function editRecord(String $email, String $table)
    {
    }

    public function deleteRecord(array $id, String $table)
    {
        $statement = "
            DELETE FROM $table
            WHERE id = :id;
        ";

        return [
            'statement' => $statement,
            'data' => $id
        ];
    }

    public function getAllRecords(String $table)
    {
        $q = "     
            SELECT 
                *
            FROM
                $table;
        ";

        return $q;
    }

    public function addRecord(array $contact)
    {
        $rq = "
        INSERT INTO contacts
            (email, name, phone_number, check_freqeuncy, company_name,has_subscribe,output_type,user_created)
        VALUES
            (:email, :name, :phone_number, :check_freqeuncy, :company_name,:has_subscribe,:output_type,:user_created);
            ";

        $q = [
            'email' => $contact['email'],
            'name' => $contact['name'],
            'phone_number' => $contact['phone_number'] ?? null,
            'check_freqeuncy' => $contact['check_freqeuncy'],
            'company_name' => $contact['company_name'] ?? null,
            'has_subscribe' => (int) $contact['has_subscribe'] ?? null,
            'output_type' => $contact['output_type'] ?? null,
            'user_created' => date('Y-m-d H:i:s')
        ];

        return [
            'statement' => $rq,
            'data' => $q
        ];
    }

    public function registerUser(array $user)
    {
        $rq = "
            INSERT INTO user (
                email,
                login_key,
                api_key_generated,
                has_api_key,
                key_type,
                api_key_generation_timpstamp,
                api_key,
                user_created
              )
            VALUES (
                :email,
                :login_key,
                :api_key_generated,
                :has_api_key,
                :key_type,
                :api_key_generation_timpstamp,
                :api_key,
                :user_created
              );
            ";
        $q = [
            'email' => $user['user'],
            'login_key' => $this->passhash($user['login_key']),
            'api_key_generated' => 0,
            'has_api_key' => 0,
            'key_type' => $user['key_type'] ?? null,
            'api_key_generation_timpstamp' => $user['api_key_generation_timpstamp'] ?? null,
            'api_key' => $user['api_key'] ?? null,
            'user_created' => date('Y-m-d H:i:s')
        ];

        return [
            'statement' => $rq,
            'data' => $q
        ];
    }

    public function updateUser(array $user)
    {
        $rq = "
            UPDATE user
            SET 
                email = :email,
                login_key = :login_key,
                api_key_generated = :api_key_generated,
                has_api_key = :has_api_key,
                key_type = :key_type,
                api_key_generation_timpstamp = :api_key_generation_timpstamp,
                api_key = :api_key,
                user_created = :user_created
            WHERE id = :id;
        ";

        $q = [
            'id' => (int) $user['id'],
            'email' => $user['email'],
            'login_key' => $user['login_key'],
            'api_key_generated' => $user['api_key_generated'],
            'has_api_key' => $user['has_api_key'],
            'key_type' => $user['key_type'],
            'api_key_generation_timpstamp' => $user['api_key_generation_timpstamp'],
            'api_key' => $user['api_key'],
            'user_created' => $user['user_created']
        ];

        return [
            'statement' => $rq,
            'data' => $q
        ];
    }

    private function passhash($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}
