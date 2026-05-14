<?php

namespace App\Service\VendorService;

use App\Models\VendorModel\AuthModel;

class AuthService
{
    protected $AuthModel;

    public function __construct()
    {
        $this->AuthModel = new AuthModel();
    }

    public function createUser($phoneNumber, $email, $password)
    {
        $user= $this->AuthModel->createUser($phoneNumber, $email, $password);
        $session = session();

            $session->set([
                'email' => $user['email'],
                'name'  => $user['first_name'],
                'id' => $user['id'],
            ]);

        return $user;
    }

    public function checkLogIn($email, $password)
    {
        $user = $this->AuthModel->getDataByMail($email);

    
        if (!$user) {

            return [
                "status" => "error",
                "message" => "Email not found"
            ];
        }

        if (password_verify($password,$user['password'])) {

            // CREATE SESSION
            $session = session();

            $session->set([
                'email' => $user['email'],
                'name'  => $user['first_name'],
                'id' => $user['id'],
                'isLoggedIn' => true
            ]);

            return [
                "status" => "success",
                "message" => "Login successful",
                "user" => $user
            ];
        }

        // WRONG PASSWORD
        return [
            "status" => "error",
            "code" => 401,
            "message" => "Invalid password"
        ];
    }
}