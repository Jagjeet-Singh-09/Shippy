<?php

namespace App\Controllers\Vendors;

use App\Controllers\BaseController;
use App\Service\VendorService\ProfileService;



class ProfileController extends BaseController
{
    protected $profileService;

    public function __construct()
    {
        $this->profileService = new ProfileService();
    }

    public function profileCreation()
    {
        return view('VendorsView/ProfileForm');
    }

    public function VendorDashboard()
    {
        return view('VendorsView/VendorDashboard');
    }




    public function renderForm()
    {
        $email = session()->get('email');
        $userID = $this->profileService->getId($email);
        $step = $this->profileService->getStep($userID);

        if ($step['step_one'] == "0000-00-00 00:00:00") {

            return $this->response->setJson([
                'message' => 'step_oneView'
            
            ]);
        } else if ($step['step_two'] == "0000-00-00 00:00:00") {
            return $this->response->setJson([
                'message' => 'step_twoView'
                
            ]);
        } else if ($step['step_three'] == "0000-00-00 00:00:00") {
            return $this->response->setJson([
                'message' => 'step_threeView'
               
            ]);
        } else {
            return $this->response->setJson([
                'message' => 'DashboardView'
            ]);
        }
    }

    public function AddingProfileDetails()
    {
        $userData = $this->request->getPost();
        $email = $this->request->getPost('email');
        $userID = $this->profileService->getId($email);
        $step = $this->profileService->getStep($userID);

        $this->profileService->AddingProfileDetails($userData);
    }

    public function getDocuments()
{
    $id = session()->get('id');

    $result = $this->profileService->getDocuments($id);

    if (!$result) {

        return $this->response->setJSON([

            'status' => false,
            'message' => 'No documents found'

        ]);

    }

    return $this->response->setJSON([

        'status' => true,

        'aadhar_card' => $result['aadhar_card'],

        'aadhar_card_id' => $result['aadhar_card_id'],

        'aadhar_card_path' => base_url(
            $result['aadhar_card_path']
        ),

        'aadhar_card_status' => $result['aadhar_card_status'],

        'pan_card' => $result['pan_card'],

        'pan_card_id' => $result['pan_card_id'],

        'pan_card_path' => base_url(
            $result['pan_card_path']
        ),

        'pan_card_status' => $result['pan_card_status'],

        'gst_number' => $result['gst_number'],

        'gst_id' => $result['gst_id'],

        'gst_path' => base_url(
            $result['gst_path']
        ),

        'gst_status' => $result['gst_status'],

        'final_status' => $result['final_status'],
        'remarks' => $result['remarks']

    ]);
}
}
