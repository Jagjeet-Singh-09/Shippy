<?php

namespace App\Models\VendorModel;

use Config\Database;

class ProfileModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // GET USER ID
    public function getId($email)
    {
        $sql = "SELECT id FROM vendors WHERE email = ?";

        $query = $this->db->query($sql, [$email]);

        $result = $query->getRowArray();

        return $result['id'];
    }

    // GET STEP
    public function getStep($id)
    {
        $sql = "SELECT step_one, step_two, step_three
                FROM vendor_register_steps
                WHERE user_id = ?";

        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }

    public function savestep_one($data, $id)
    {

        $sql = "UPDATE vendors 
                SET 
                    first_name = ?,
                    last_name = ?,
                    date_of_birth=?
                   

                    
                    
                WHERE id = ?";

        $querry = $this->db->query($sql, [

            $data['firstname'],
            $data['lastname'],
            $data['dob'],


            $id
        ]);


        $sql2 = "UPDATE vendor_register_steps
SET step_one = CURRENT_TIMESTAMP
WHERE user_id = ?;";


        return $this->db->query($sql2, [

            $id

        ]);
    }


    public function savestep_two($data, $id)
    {

        $sql = "UPDATE vendors 
                SET 
                    permanent_address = ?,
                    shipping_address = ?  
                WHERE id = ?";

        $querry = $this->db->query($sql, [

            $data['permanentAddress'],
            $data['shippingAddress'],
            $id
        ]);


        $sql2 = "UPDATE vendor_register_steps
SET step_two = CURRENT_TIMESTAMP
WHERE user_id = ?;";


        return $this->db->query($sql2, [

            $id

        ]);
    }


    public function savestep_three($data, $id)
{
    // AUTO GENERATED IDS
    $aadharCardId = uniqid();
    $panCardId    = uniqid();
    $gstId        = uniqid();

    $sql = "INSERT INTO vendor_docs (

        vendor_id,

        aadhar_card_id,
        pan_card_id,
        gst_id,

        aadhar_card,
        aadhar_card_path,

        pan_card,
        pan_card_path,

        gst_number,
        gst_path,

        aadhar_card_status,
        pan_card_status,
        gst_status,

        final_status,
        remarks

    ) VALUES (

        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?

    )";

    $query = $this->db->query($sql, [

        $id,

        $aadharCardId,
        $panCardId,
        $gstId,

        $data['aadharCardNumber'],
        $data['aadharCardImage'],

        $data['panCardNumber'],
        $data['panCardImage'],

        $data['gstNumber'],
        $data['gst'],

        'pending',
        'pending',
        'pending',

        'pending',
        null
    ]);

    return $query;
}

    public function getDocuments($id)
    {
        $sql = "SELECT 
                vendor_id,
        aadhar_card,
        aadhar_card_path,
        pan_card,
        pan_card_path,
        gst_number,
        gst_path,
        status as doc_status
            FROM vendor_docs
            WHERE vendor_id = ?";

        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }

    public function updateStep($id)
    {
        $sql = "UPDATE vendor_register_steps
                SET step_three = '0000-00-00 00:00:00'
                WHERE user_id = ?";

        return $this->db->query($sql, [$id]);
}
}