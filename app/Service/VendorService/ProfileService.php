<?php

namespace App\Service\VendorService;

use App\Models\VendorModel\ProfileModel;

class ProfileService
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function AddingProfileDetails($user){


    }

    public function getStep($id){
        return $this->profileModel->getStep($id);

    }

     public function getId($email){
        return $this->profileModel->getId($email);
        
    }

   

    public function savestep_one($data,$id){
        return $this->profileModel->savestep_one($data,$id);
    }

    public function savestep_two($data,$id){
        return $this->profileModel->savestep_two($data,$id);

    }
    public function savestep_three($data,$id){
        return $this->profileModel->savestep_three($data,$id);

    }

    public function getDocuments($id){
        return $this->profileModel->getDocuments($id);
    }

    public function updateStep($id)
    {
        return $this->profileModel->updateStep($id);
    }

}