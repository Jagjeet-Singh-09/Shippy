<?php

namespace App\Models\UserModel;

use Config\Database;

class UserModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getVendorDocs($limit, $offset)
    {
        $limit = (int)$limit;

        $offset = (int)$offset;

        $sql = "SELECT * 
            FROM vendor_docs AS vd
            INNER JOIN vendors AS v
            ON vd.vendor_id = v.id
            LIMIT {$limit} OFFSET {$offset}";

        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function getVendorDocuments($id)
    {
        $sql = "SELECT 

                aadhar_card,
                aadhar_card_id,
                aadhar_card_path,
                aadhar_card_status,

                pan_card,
                pan_card_id,
                pan_card_path,
                pan_card_status,

                gst_number,
                gst_id,
                gst_path,
                gst_status,

                final_status,
                remarks

            FROM vendor_docs

            WHERE vendor_id = ?";

        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }


    // UPDATE STATUS
    public function updateVendorStatus($id, $status,$type)
    {
        if($type == "aadhar_card_status"){

        $sql = "UPDATE vendor_docs
                SET aadhar_card_status = ?
                WHERE vendor_id = ?";


        $result = $this->db->query($sql, [
            $status,
            $id

        ]);
            
        }else if($type == "pan_card_status"){
            $sql = "UPDATE vendor_docs
                SET pan_card_status = ?
                WHERE vendor_id = ?";


        $result = $this->db->query($sql, [
            $status,
            $id

        ]);
        }else if($type == "gst_status"){
            $sql = "UPDATE vendor_docs
                SET gst_status = ?
                WHERE vendor_id = ?";


        $result = $this->db->query($sql, [
            $status,
            $id

        ]);
        }else{
            $result=null;
        }


        


        return [

            'success' => (bool)$result,

            'message' => 'Vendor Status Updated Successfully'

        ];
    }

    public function updateRemarks($id, $remarks)
{
    $sql = "UPDATE vendor_docs
            SET remarks = ?
            WHERE vendor_id = ?";

    $result = $this->db->query($sql, [

        $remarks,
        $id

    ]);

    return [

        'success' => (bool)$result,

        'message' => 'Remarks Updated Successfully'

    ];
}

    public function getFinalStatus($id){
        $sql = "SELECT * FROM vendor_docs WHERE vendor_id = ?";

        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }

    public function updateFinalStatus($id, $finalStatus){
        $sql = "UPDATE vendor_docs
                SET final_status = ?
                WHERE vendor_id = ?";

        $result = $this->db->query($sql, [
            $finalStatus,
            $id

        ]);

        return [

            'success' => (bool)$result,

            'message' => 'Final Status Updated Successfully'

        ];
    }
}
