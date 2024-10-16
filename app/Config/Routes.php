<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/employees', 'EmployeeController::index');   
$routes->get('/employees/list', 'EmployeeController::listEmployee');     
// $routes->get('/employees/(:num)', 'EmployeeController::show/$1'); 
$routes->post('/employees', 'EmployeeController::store'); 
$routes->post('/employees/(:num)', 'EmployeeController::update/$1');
$routes->delete('/employees/(:num)', 'EmployeeController::delete/$1'); 

$routes->get('/employees/add_employee_page', 'EmployeeController::create'); 
$routes->get('/employees/edit_employee_page/(:num)', 'EmployeeController::edit/$1'); 






