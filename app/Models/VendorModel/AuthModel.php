<?php

namespace App\Models\VendorModel;

use Config\Database;

class AuthModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function createUser($phoneNumber, $email, $password)
    {
        // INSERT USER
        $sql = "INSERT INTO vendors (phone_number, email, password)
            VALUES (?, ?, ?)";

        $this->db->query($sql, [$phoneNumber, $email, $password]);

        // GET INSERTED USER ID
        $userId = $this->db->insertID();

        // INSERT STEP DATA
        $sql2 = "INSERT INTO vendor_register_steps
            (user_id, step_one, step_two, step_three)
            VALUES (?, 0, 0, 0)";

        $this->db->query($sql2, [$userId]);

        // FETCH USER DATA
        $sql3 = "SELECT * FROM vendors WHERE id = ?";

        $query = $this->db->query($sql3, [$userId]);

        return $query->getRowArray();
    }

    public function getDataByMail($email)
    {
        $sql = "SELECT * FROM vendors WHERE email = ?";

        $query = $this->db->query($sql, [$email]);

        return $query->getRowArray();
    }
}
