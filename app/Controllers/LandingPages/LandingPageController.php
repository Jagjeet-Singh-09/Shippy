<?php 
namespace App\Controllers\LandingPages;
use App\Controllers\BaseController;


class LandingPageController extends BaseController{

public function index(): string
    {
        return view('LandingPage');
    }


}
