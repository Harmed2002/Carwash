<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Users
Route::get('/listUsers', 'Admin\UserController@index')->name('listUsers');
Route::get('/deleteUser/{idUser}', 'Admin\UserController@delete')->name('deleteUser');
Route::post('/saveUser/{idUser?}', 'Admin\UserController@save')->name('saveUser');
Route::get('/formUser/{idUser?}/{show?}', 'Admin\UserController@form')->name('formmUser');
//Permissions
Route::get('/listPermissions', 'Admin\PermissionController@index')->name('listPermissions');
Route::get('/deletePermission/{idPermission}', 'Admin\PermissionController@delete')->name('deletePermission');
Route::post('/savePermission/{idPermission?}', 'Admin\PermissionController@save')->name('savePermission');
Route::get('/formPermission/{idPermission?}/{show?}', 'Admin\PermissionController@form')->name('formPermission');
//Roles
Route::get('/listRoles', 'Admin\RoleController@index')->name('listRoles');
Route::get('/deleteRole/{idRole}', 'Admin\RoleController@delete')->name('deleteRole');
Route::post('/saveRole/{idRole?}', 'Admin\RoleController@save')->name('saveRole');
Route::get('/formRole/{idRole?}/{show?}', 'Admin\RoleController@form')->name('fromRole');
// Asociar permiso a rol.
Route::get('/listRolePermissions', 'Admin\RolePermissionController@index')->name('listRolPermissions');
Route::get('/deleteRolPermission/{id_role}/{id_permission}', 'Admin\RolePermissionController@delete')->name('deleteRolPermission');
Route::post('/saveRolPermission/{idRolPermission?}', 'Admin\RolePermissionController@save')->name('saveRolPermission');
Route::get('/formRolPermission/{permission_id?}/{role_id?}/{show?}', 'Admin\RolePermissionController@form')->name('formRolPermission');
// Asociar rol a usuario.
Route::get('/listUserRoles', 'Admin\UserRolController@index')->name('listUserRoles');
Route::get('/deleteUserRol/{id_user}/{id_role}', 'Admin\UserRolController@delete')->name('deleteUserRol');
Route::post('/saveUserRol/{idUserRol?}', 'Admin\UserRolController@save')->name('saveUserRol');
Route::get('/formUserRol/{role_id?}/{model_id?}/{show?}', 'Admin\UserRolController@form')->name('formUserRol');

// Personas
Route::get('/showPerson/{id}', 'PersonController@show')->name('showPerson');

// Empleados
Route::get('/listEmpl', 'EmployeeController@index')->name('listEmpl');
Route::get('/getCities/{idState}', 'EmployeeController@Cities')->name('Cities');
Route::get('/deleteEmployee/{id}', 'EmployeeController@destroy')->name('deleteEmployee');
Route::post('/saveEmployee', 'EmployeeController@store')->name('saveEmployee');
Route::post('/updateEmployee/{id}', 'EmployeeController@update')->name('updateEmployee');
Route::get('/showEmpl/{id}', 'EmployeeController@searchEmployee')->name('showEmployee');
Route::get('/formEmployee/{id?}/{show?}', 'EmployeeController@create')->name('formEmployee');

// Cargos de empleados
Route::get('/listPosition', 'PositionController@index')->name('listPosition');
Route::get('/formPosition/{id?}/{show?}', 'PositionController@create')->name('formPosition');
Route::post('/savePosition', 'PositionController@store')->name('savePosition');
Route::post('/updatePosition/{id}', 'PositionController@update')->name('updatePosition');
Route::get('/deletePosition/{id}', 'PositionController@destroy')->name('deletePosition');

// Clientes
Route::get('/listClients', 'ClientController@index')->name('listClients');
Route::get('/getCities/{idState}', 'ClientController@Cities')->name('Cities');
// Route::get('/showClient/{id}', 'ClientController@showClient')->name('showClient');
Route::get('/deleteClient/{id}', 'ClientController@destroy')->name('deleteClient');
Route::post('/saveClient', 'ClientController@store')->name('saveClient');
Route::post('/updateClient/{id}', 'ClientController@update')->name('updateClient');
Route::get('/showClient/{id}', 'ClientController@searchClient')->name('showClient');
Route::get('/formClient/{id?}/{show?}', 'ClientController@create')->name('formClient');

// Proveedores
Route::get('/listSuppliers', 'SupplierController@index')->name('listSuppliers');
Route::get('/getCities/{idState}', 'SupplierController@Cities')->name('Cities');
Route::get('/formSupplier/{id?}/{show?}', 'SupplierController@create')->name('formSupplier');
Route::post('/saveSupplier', 'SupplierController@store')->name('saveSupplier');
Route::post('/updateSupplier/{id}', 'SupplierController@update')->name('updateSupplier');
Route::get('/deleteSupplier/{idSupplier}', 'SupplierController@destroy')->name('deleteSupplier');
Route::post('/searchEconomica', 'SupplierController@searchEconomica')->name('searchEconomica');
Route::get('/showSupplier/{id}', 'SupplierController@searchSupplier')->name('showSupplier');

// Vehículos
Route::get('/listVehicles', 'VehicleController@index')->name('listVehicles');
Route::get('/formVehicle/{id?}/{show?}', 'VehicleController@create')->name('formVehicle');
Route::post('/saveVehicle', 'VehicleController@store')->name('saveVehicle');
Route::post('/updateVehicle/{id}', 'VehicleController@update')->name('updateVehicle');
Route::get('/deleteVehicle/{id}', 'VehicleController@destroy')->name('deleteVehicle');

// Tipo de Vehículos
Route::get('/listVehicleTypes', 'VehicleTypeController@index')->name('listVehicleTypes');
Route::get('/formVehicleType/{id?}/{show?}', 'VehicleTypeController@create')->name('formVehicleType');
Route::post('/saveVehicleType', 'VehicleTypeController@store')->name('saveVehicleType');
Route::post('/updateVehicleType/{id}', 'VehicleTypeController@update')->name('updateVehicleType');
Route::get('/deleteVehicleType/{id}', 'VehicleTypeController@destroy')->name('deleteVehicleType');

// Tipo de Servicios
Route::get('/listServiceTypes', 'ServiceTypeController@index')->name('listServiceTypes');
Route::get('/formServiceType/{id?}/{show?}', 'ServiceTypeController@create')->name('formServiceType');
Route::post('/saveServiceType', 'ServiceTypeController@store')->name('saveServiceType');
Route::post('/updateServiceType/{id}', 'ServiceTypeController@update')->name('updateServiceType');
Route::get('/deleteServiceType/{id}', 'ServiceTypeController@destroy')->name('deleteServiceType');
Route::get('/service', 'ServiceTypeController@trService')->name('service');


////////////////////////////////////////////////

//  Inventory
Route::get('/inventory', 'InventoryController@index')->name('inventory');
Route::get('/formInventory', 'InventoryController@form')->name('formInventory');
Route::get('/deleteInventory', 'InventoryController@delete')->name('deleteInventory');
Route::post('/save', 'InventoryController@save')->name('save');
Route::get('/inventoryControl', 'InventoryController@inventoryControl')->name('inventoryControl');

//Report
Route::get('/reports', 'ReportController@index')->name('reports');
Route::get('/reportDocument', 'ReportController@reportDocument')->name('reportDocument');
Route::get('/reportRemissions', 'ReportController@reportRemissions')->name('reportRemissions');
Route::get('/pdfReportRemissions', 'ReportController@pdfReportRemissions')->name('pdfReportRemissions');
Route::get('/pdfReportRemissionAssignments', 'ReportController@pdfReportRemissionAssignments')->name('pdfReportRemissionAssignments');

// Lista de Precios
Route::get('/getPriceList/{idObra?}/{idMaterial?}', 'PriceListController@getPriceList')->name('getPriceList');
Route::get('/listPriceList', 'PriceListController@index')->name('listPriceList');
Route::get('/formPriceList/{priceList_id?}/{show?}', 'PriceListController@create')->name('formPriceList');
Route::get('/deletePriceList/{priceList_id}', 'PriceListController@destroy')->name('deletePriceList');
Route::post('/savePriceList', 'PriceListController@store')->name('savePriceList');
Route::get('/searchMaterial/{material_id}', 'PriceListController@searchMaterial')->name('searchMaterial');

//Excel
Route::get('/reportMachineMov', 'ReportController@reportMachineMov')->name('reportMachineMov');
Route::get('/showConstruction/{id}', 'ConstructionController@show')->name('showConstruction');

;
