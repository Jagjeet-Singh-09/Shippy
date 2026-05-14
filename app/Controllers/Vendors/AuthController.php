<?php

namespace App\Controllers\Vendors;

use App\Controllers\BaseController;
use App\Service\VendorService\AuthService;
use App\Validation\UserValidation\UserValidations;



class AuthController extends BaseController


{
    protected $authService;
    protected $userValidations;


    public function __construct()
    {
        $this->authService = new AuthService();
        $this->userValidations = new UserValidations();

        
    }

    public function index(): string
    {
        return view('VendorsView/RegisterView');
    }
    public function login(): string
    {
        return view('VendorsView/LoginView');
    }

    public function register(): string
    {
        return view('VendorsView/RegisterView');
    }

    public function checkLogIn()
    {
        $email = $this->request->getPost('email');

        if (!$this->userValidations->checkEmail($email)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid First Name'
                ]);
        }

        
        $password = $this->request->getPost('password');

        if (!$this->userValidations->checkPassword($password)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid First Name'
                ]);
        }

        $result = $this->authService->checkLogIn($email, $password);
        if ($result['status'] == 'error') {

            return $this->response
                ->setStatusCode(401)
                ->setJSON($result);
        }

        // SUCCESS
        return $this->response
            ->setStatusCode(200)
            ->setJSON($result);
    }

    public function createUser()
    {
        $email = $this->request->getPost('email');

        if (!$this->userValidations->checkEmail($email)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Email'
                ]);
        }

        
        $password = $this->request->getPost('password');

        if (!$this->userValidations->checkPassword($password)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Password'
                ]);
        }

        $phoneNumber = $this->request->getPost('phoneNumber');
        if (!$this->userValidations->checkMobileNumber($phoneNumber)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Phone Number'
                ]);
        }


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->authService->createUser($phoneNumber, $email, $hashedPassword);



        
        if ($result) {

            return $this->response->setJSON([
                "status" => "success",
                "message" => "User registered successfully"
            ]);
        }

        return $this->response->setJSON([
            "status" => "error",
            "message" => "Registration failed"
        ]);
    }
}
