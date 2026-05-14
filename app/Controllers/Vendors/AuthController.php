<?php

namespace App\Controllers\Vendors;

use App\Controllers\BaseController;
use App\Service\VendorService\AuthService;
use App\Validation\UserValidation\UserValidations;
use League\OAuth2\Client\Provider\Google;






class AuthController extends BaseController


{
    protected $authService;
    protected $userValidations;
    private $provider;


    public function __construct()
    {
        $this->authService = new AuthService();
        $this->userValidations = new UserValidations();

        $this->provider = new Google([
            'clientId'     => env('GOOGLE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
            'redirectUri'  => env('GOOGLE_REDIRECT_URI'),
        ]);
    }
    public function googleLogin()
    {
        $authUrl = $this->provider->getAuthorizationUrl();

        session()->set('oauth2state', $this->provider->getState());

        return redirect()->to($authUrl);
    }

    public function googleCallback()
    {
        try {

            $token = $this->provider->getAccessToken(
                'authorization_code',
                [
                    'code' => $this->request->getVar('code')
                ]
            );

            $owner = $this->provider->getResourceOwner($token);

            $user = $owner->toArray();

            session()->set([
                'name'       => $user['name'],
                'email'      => $user['email'],
                'isLoggedIn' => true
            ]);
            $phoneNumber = null;
            $email = $user['email'];
            $hashedPassword = null;

            $this->authService->createUser($phoneNumber, $email, $hashedPassword);

            return redirect()->to('/profileCreation');
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
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
