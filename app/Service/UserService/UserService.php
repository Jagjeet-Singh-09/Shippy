<?php

namespace App\Service\UserService;

use App\Models\UserModel\UserModel;

class UserService
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getVendorDocs($limit,$page){
        $offset=($page-1)*$limit;
        return $this->userModel->getVendorDocs($limit,$offset);
    }

     // GET DOCUMENTS
    public function getVendorDocuments($id)
    {
        return $this->userModel->getVendorDocuments($id);
    }

    public function updateRemarks($id, $remarks)
{
    $result = $this->userModel
        ->updateRemarks($id, $remarks);

    return $result;
}


    // UPDATE STATUS
    public function updateVendorStatus($id, $status,$type)
    {
        return $this->userModel->updateVendorStatus($id, $status,$type);
    }

}