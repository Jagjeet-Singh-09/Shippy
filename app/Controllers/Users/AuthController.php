<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Service\UserService\AuthService;
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

    public function userDashboard(){
        return view('UserView/UserDashboard');
    }

   
    public function login(): string
    {
        return view('UserView/UserLoginView');
    }

    public function register(): string
    {
        return view('UserView/UserRegisterView');
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

        $phoneNumber = $this->request->getPost('phone');
        if (!$this->userValidations->checkMobileNumber($phoneNumber)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Phone Number'
                ]);
        }


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $firstname = $this->request->getPost('first_name');

        if (!$this->userValidations->checkFirstName($firstname)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid First Name'
                ]);
        }
        $lastname = $this->request->getPost('last_name');

        if (!$this->userValidations->checkLastName($lastname)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Please add Valid Last Name'
                ]);
        }
        $result = $this->authService->createUser($phoneNumber, $email, $hashedPassword, $firstname, $lastname);



        
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

}


