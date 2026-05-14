<?php

namespace App\Controllers\Vendors;

use App\Controllers\BaseController;
use App\Service\VendorService\ProfileService;
use App\Validation\UserValidation\UserValidations;


class VendorController extends BaseController
{
    protected $profileService;
    protected $userValidations;

    public function __construct()
    {
        $this->profileService = new ProfileService();
        $this->userValidations = new UserValidations();
    }

    public function savestep_one()
    {
        $firstname = $this->request->getPost('firstname');

        if (!$this->userValidations->checkFirstName($firstname)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid First Name'
                ]);
        }
        $lastname = $this->request->getPost('lastname');

        if (!$this->userValidations->checkLastName($lastname)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Last Name'
                ]);
        }

        $dob = $this->request->getPost('dob');



        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'dob' => $dob,
        ];
        $id = session()->get('id');

        $resData = $this->profileService->savestep_one($data, $id);



        return $this->response->setJSON([
            'message' => 'Step One Saved'
        ]);
    }

    public function savestep_two()
    {

        $data = [

            'permanentAddress' => $this->request->getPost('permanent_address'),
            'shippingAddress' => $this->request->getPost('shipping_address')
        ];

        $id = session()->get('id');

        $this->profileService->savestep_two($data, $id);


        return $this->response->setJSON([
            'message' => 'Step Two Saved'
        ]);
    }



    public function savestep_three()
    {

        $aadharCardImage = $this->request->getFile('aadhar_upload');
        $aadharName = $aadharCardImage->getRandomName();

        $aadharCardImage->move(FCPATH . 'uploads', $aadharName);

        $aadharUrl = 'uploads/' . $aadharName;

        $panCardImage = $this->request->getFile('pan_upload');
        $panName = $panCardImage->getRandomName();

        $panCardImage->move(FCPATH . 'uploads', $panName);
        $panUrl = 'uploads/' . $panName;

        $gstfile=$this->request->getFile('gst_upload');
        $gstName=$gstfile->getRandomName();
        $gstfile->move(FCPATH . 'uploads', $gstName);
        $gstUrl = 'uploads/' . $gstName;


        



        $aadharCardNumber =$this->request->getPost('aadhar_no');
        if (!$this->userValidations->checkAadharNumber($aadharCardNumber)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Aadhar Card Number'
                ]);
        }

        $panCardNumber  = $this->request->getPost('pan_no');
        if (!$this->userValidations->checkPanCard($panCardNumber)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Pan Card Number'
                ]);
        }

        $gstNumber = $this->request->getPost('gst_no');
        if (!$this->userValidations->checkGSTNumber($gstNumber)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid GST number'
                ]);
        }

        






        $data = [

            'aadharCardNumber' => $aadharCardNumber,
            'panCardNumber' => $panCardNumber,
            'gstNumber' => $gstNumber,
            'panCardImage' => $panUrl,
            'aadharCardImage' => $aadharUrl,
            'gst'=>$gstUrl,
            

        ];

        $id = session()->get('id');

        $resData =  $this->profileService->savestep_three($data, $id);

        return $this->response->setJSON([
            'message' => 'Form Submitted Successfully',
            'id' => $id
        ]);
    }

    public function stepUpdate()
    {
        $id = session()->get('id');

        $result = $this->profileService->updateStep($id);

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Step updated successfully'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update step'
        ]);
}

}
