<?php

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function fetchAllOrder()
    {
        $this->db->query(
            "select * from orders"
        );
        
        $rows = $this->db->resultSet();
        if ($this->db->rowCount() >0) {
            return json_encode($rows);
        } else {
            return false;
        }
    }

    public function checkOrderStatus($id)
    {
        $this->db->query("select * from order where id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return json_encode($row);
        } else {
            return false;
        }
    }
}