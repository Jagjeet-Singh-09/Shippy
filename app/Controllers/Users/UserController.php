<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Service\UserService\UserService;





class UserController extends BaseController
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function getAllVendorDocs()
    {
        $limit = (int) $this->request->getGet('limit');

        $page = (int) $this->request->getGet('page');
        $data = $this->userService->getVendorDocs($limit, $page);

        return $this->response->setJSON([
            'status' => 'success',

            'page' => $page,

            'limit' => $limit,

            'data' => $data



        ]);
    }

    // GET DOCUMENTS
    public function getVendorDocuments($id)
    {
        //$id = session()->get('id');

        $result = $this->userService->getVendorDocuments($id);

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
    public function updateRemarks($id)
    {
        $remarks = $this->request->getPost('remarks');

        $result = $this->userService
            ->updateRemarks($id, $remarks);

        return $this->response->setJSON($result);
    }



    // UPDATE STATUS
    public function updateVendorStatus($id)
    {
        $status = $this->request->getPost('status');
        $type = $this->request->getPost('type');


        $result = $this->userService->updateVendorStatus($id, $status, $type);

        return $this->response->setJSON($result);
    }

    public function vendorDocumentsPage($id)
    {
        return view('UserView/UserDocuments');
    }
}
