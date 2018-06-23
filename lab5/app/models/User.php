<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query(
            "insert into users (firstName, lastName, city) values (:firstName, :lastName, :city)"
        );
        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':city', $data['city']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function allUsers()
    {
        $this->db->query(
            "select * from users"
        );
        
        $rows = $this->db->resultSet();
        if ($this->db->rowCount() >0) {
            return $rows;
        } else {
            return false;
        }

    }

}
