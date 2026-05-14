<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\LandingPages\LandingPageController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPages\LandingPageController::index');
$routes->get('/auth', 'Vendors\AuthController::index');
$routes->get('/login', 'Vendors\AuthController::login');
$routes->get('/register', 'Vendors\AuthController::register');

$routes->get('/loginUser', 'Users\AuthController::login');
$routes->get('/registerUser', 'Users\AuthController::register');
$routes->get('/userDashboard', 'Users\AuthController::userDashboard');
$routes->get('/api/getVendorDocs', 'Users\UserController::getAllVendorDocs');
$routes->get('/vendor-documents/(:num)', 'Users\UserController::vendorDocumentsPage/$1');
$routes->get('api/vendor-documents/(:num)','Users\UserController::getVendorDocuments/$1');

$routes->post('/api/update-vendor-status/(:num)', 'Users\UserController::updateVendorStatus/$1');

$routes->post(
    '/api/update-remarks/(:num)',
    'Users\UserController::updateRemarks/$1'
);

$routes->post('/api/user/register', 'Users\AuthController::createUser');
$routes->post('/api/user/login', 'Users\AuthController::checkLogIn');




$routes->get('/api/renderForm', 'Vendors\ProfileController::renderForm');
$routes->get('/profileCreation', 'Vendors\ProfileController::profileCreation');
$routes->get('/VendorDashboard', 'Vendors\ProfileController::VendorDashboard');
$routes->get('/api/getDocuments', 'Vendors\ProfileController::getDocuments');






$routes->post('/savestep_one', 'Vendors\VendorController::savestep_one');
$routes->post('/savestep_two', 'Vendors\VendorController::savestep_two');
$routes->post('/savestep_three', 'Vendors\VendorController::savestep_three');





$routes->post('/api/login', 'Vendors\AuthController::checkLogIn');
$routes->post('/api/register', 'Vendors\AuthController::createUser');



