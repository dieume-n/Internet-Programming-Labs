<?php
class Api
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function generateApi()
    {
        $lenght = 64;
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $bytes = openssl_random_pseudo_bytes(3*$lenght/4+1);
        $rep = unpack('C2', $bytes);
        $first = $chars[$rep[1] % 62];
        $second = $chars[$rep[1] % 62];
        return strtr(substr(base64_encode($bytes), 0, $lenght), '+/', "$first$second" );
    }

    public function save($userID, $apiKey)
    {
        // die(var_dump($userID, $apiKey));
        $this->db->query(
            "insert into api (user_id, apiKey) values (:user_id, :key)"
        );
        $this->db->bind(':user_id', $userID);
        $this->db->bind(':key', $apiKey);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }

    public function checkApi($api)
    {
        $this->db->query("select * from api where apiKey = :api");
        $this->db->bind(':api', $api);
        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getApiByUserID($id)
    {
        $this->db->query(
            "select * from api where user_id=:id"
        );
        $this->db->bind(':id', $id);
        $rows = $this->db->resultSet();
        if ($this->db->rowCount() >0) {
            return $rows;
        } else {
            return false;
        }
    }

}