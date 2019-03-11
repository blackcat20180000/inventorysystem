<?php

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
    return view('welcome');
});
Route::get('/block',function()
{
  return view('block');
})->name('inactivity');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard'.'AdminController@index')->name('dashboard');
Route::get('/logoout','HomeController@Logoout')->name('logoout');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/organzation','OrganazationController@index')->name('organzation');
Route::post('/add/organzation','OrganazationController@addorgnazation')->name('addorgnazation');
Route::get('/user','UserController@index')->name('user');
Route::get('/invertory','InvertoryController@index')->name('inventory');
Route::post('/updateorg','OrganazationController@updateorg')->name('updateorg');
Route::post('/deleteorg','OrganazationController@deleteorg')->name('deleteorg');
Route::post('/subuser','UserController@subuser')->name('subuser');
Route::post('/getorgname','UserController@getorgname')->name('getorgname');
Route::post('/profileupdate','ProfileController@updateprofile')->name('profileupdate');
Route::post('/searchuer','UserController@searchuser')->name('searchuer');
Route::post('/subInvertory','InvertoryController@addinvertory')->name('subInvertory');
Route::post('invertory_group','InvertoryController@changebyorgname')->name('invertory_group');
Route::post('updateinver','InvertoryController@updateinver')->name('updateinver');
Route::post('delinver','InvertoryController@delinver')->name('delinver');
Route::get('/invertory/order','OrderController@index')->name('order');
Route::get('admin/index','admin\IndexController@index')->name('admin.index');
Route::get('groupowner','admin\UserController@getownerinterface')->name('admin.owner');
Route::get('admin/staff','admin\UserController@getstaffinterface')->name('admin.staff');
Route::get('admin/invertory','admin\InvertoryController@index')->name('admin.invertory');
Route::get('admin/orgnaization','admin\OrganazationController@index')->name('admin.orgnaization');
Route::get('/logout','admin\IndexController@logout')->name('admin.logout');
Route::get('/setting',' admin\IndexController@Setting')->name('admin.setting');
Route::get('/adminprofile','admin\IndexController@profile')->name('admin.profile');
Route::get('/owner/edit/{id}','admin\UserController@owneredit')->name('edit');
Route::post('/owner/change','admin\UserController@ownerchange')->name('owner.change');
Route::get('/user_delete/{id}','admin\Usercontroller@user_delete')->name('owner.delete');
Route::get('/login/invalid','HomeController@permissiondenied')->name('permissiondenied');
Route::get('/new/order','OrderController@neworder')->name('neworder');
Route::post('/json/order','OrderController@getneworderbyogrid')->name('jsondata');
Route::get('/new/inventory','InvertoryController@newinventory')->name('newinventory');
Route::get('/new/purchase','InvertoryController@purchase')->name('purchase');
Route::get('/new/unit','InvertoryUnitController@index')->name('Inventory_unit');
Route::post('/add/unit','InvertoryUnitController@Addunit')->name('addunit');
Route::post('/update/unit','InvertoryUnitController@updateunit')->name('updateunit');
Route::post('/delete/unit','InvertoryUnitController@deleteunit')->name('deleteunit');
Route::post('/getunit/org','InvertoryUnitController@getunit')->name('inventory_unit');
Route::post('/add/item','InvertoryUnitController@additem')->name('additem');
Route::post('/move/purchase','InvertoryUnitController@movepurchase')->name('movpurchase');
Route::post('/move/order','InvertoryUnitController@moveorder')->name('moveorder');
Route::post('/move/createorder','InvertoryUnitController@movecreateorder')->name('createorder');
Route::post('/move/stock','InvertoryUnitController@movestock')->name('movestock');
Route::post('/user/permission','UserController@setpermission')->name('userpermission');
Route::post('/staff/permission','UserController@staffpermission')->name('staffpermissioninfo');
Route::post('/upload/receipt','InvertoryController@file_upload')->name('receiptupload');
Route::post('/render/purchase','InvertoryController@render_purchase')->name('render_purchase');
Route::post('/order/item','OrderController@orderitem')->name('orderitem');
//admin part
?>
