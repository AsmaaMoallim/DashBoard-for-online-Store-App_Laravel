<?php

use Illuminate\Support\Facades\Auth;
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
    if (\auth()->check()){
        return view('adminLayout');
    }
    return view('auth.login');
});


////////////////////////////////////////////////////  Loging
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware([\App\Http\Middleware\CheckLoggedOrNot::class])->group(function () {

    Route::get('/adminPanel', function (){
        return view('adminLayout');
    })->name('adminPanel');


////////////////////////////////////////////////////  fetch_image
    Route::get('media_library/fetch_image/{id}', [\App\Http\Controllers\MediaLibraryController::class, 'fetch_image']);
    Route::get('media_library/{id}/update/fetch_image', [\App\Http\Controllers\MediaLibraryController::class, 'fetch_image']);

    Route::get('main_sections/fetch_image/{id}', [\App\Http\Controllers\MediaLibraryController::class, 'fetch_image']);
    Route::get('sub_sections/fetch_image/{id}', [\App\Http\Controllers\MediaLibraryController::class, 'fetch_image']);
    Route::get('banners/fetch_image/{id}', [\App\Http\Controllers\MediaLibraryController::class, 'fetch_image']);
    Route::get('/measure/update-measures-form/fetch_image/{id}', [\App\Http\Controllers\MediaLibraryController::class, 'fetch_image']);

    Route::get('products/new-product-form/fetch_image/{id}', [\App\Http\Controllers\productController::class, 'fetch_image']);
    Route::get('products/{int}/update/fetch_image/{id}', [\App\Http\Controllers\productController::class, 'fetch_image']);
    Route::get('products/{int}/update/fetch_image', [\App\Http\Controllers\productController::class, 'fetch_image']);
    Route::get('products/{int}/update/fetch_image', [\App\Http\Controllers\productController::class, 'fetch_image']);

    Route::get('products/new-product-form/fetch_measures/{id}', [\App\Http\Controllers\productController::class, 'fetch_measures']);
    Route::get('products/{int}/update/fetch_measures/{id}', [\App\Http\Controllers\productController::class, 'fetch_measures']);
    Route::get('products/{int}/update/fetch_measures', [\App\Http\Controllers\productController::class, 'fetch_measures']);



    Route::get('banners/new-banner-form/fetch_image/{id}', [\App\Http\Controllers\bannerController::class, 'fetch_image']);
    Route::get('banners/{int}/update/fetch_image/{id}', [\App\Http\Controllers\bannerController::class, 'fetch_image']);

    Route::get('main_sections/new-maninSection-form/fetch_image/{id}', [\App\Http\Controllers\mainSectionController::class, 'fetch_image']);
    Route::get('main_sections/{int}/update/fetch_image/{id}', [\App\Http\Controllers\mainSectionController::class, 'fetch_image']);

    Route::get('sub_sections/new-subSection-form/fetch_image/{id}', [\App\Http\Controllers\subSectionController::class, 'fetch_image']);
    Route::get('sub_sections/{int}/update/fetch_image/{id}', [\App\Http\Controllers\subSectionController::class, 'fetch_image']);

    Route::get('clients/fetch_image/{id}', [\App\Http\Controllers\clientController::class, 'fetch_image']);
    Route::get('clients/{id}/update/fetch_image', [\App\Http\Controllers\clientController::class, 'fetch_image']);

    Route::get('bank_transaction/fetch_image/{id}', [\App\Http\Controllers\bankTransactionController::class, 'fetch_image']);

//Route::get('social_media_link/new-social-media-form/fetch_image/{id}', [\App\Http\Controllers\socialMediaLinksController::class, 'fetch_image']);
    Route::get('social_media_link/fetch_image/{id}', [\App\Http\Controllers\socialMediaLinksController::class, 'fetch_image']);
    Route::get('social_media_link/{id}/update/fetch_image', [\App\Http\Controllers\socialMediaLinksController::class, 'fetch_image']);

    Route::get('measure/fetch_image/{id}', [\App\Http\Controllers\MeasureController::class, 'fetch_image']);


//Route::get('banners/new-banner-form/fetch_image/{id}', [\App\Http\Controllers\bannerController::class, 'fetch_image']);


////////////////////////////////////////////////////  displayDetailes
    Route::get('/products/{int}/displayDetailes', [\App\Http\Controllers\productController::class, 'displayDetailes'])->name('products.displayDetailes');
    Route::get('/email_box/{int}/displayDetailes', [App\Http\Controllers\emailBoxController::class, 'displayDetailes'])->name('email_box.displayDetailes');
    Route::get('/orders/{int}/displayDetailes', [App\Http\Controllers\orderController::class, 'displayDetailes'])->name('order.displayDetailes');


////////////////////////////////////////////////////  enableordisable state
    Route::get('/manager/{int}/enableordisable', [\App\Http\Controllers\ManagerController::class, 'enableordisable'])->name('manager.enableordisable');
    Route::get('/positions_permissions/{int}/enableordisable', [App\Http\Controllers\positions_permissionsController::class, 'enableordisable'])->name('positions_permissionsController.enableordisable');
    Route::get('/media_library/{int}/enableordisable', [App\Http\Controllers\MediaLibraryController::class, 'enableordisable'])->name('media_Library.enableordisable');
    Route::get('/banners/{int}/enableordisable', [App\Http\Controllers\bannerController::class, 'enableordisable'])->name('banners.enableordisable');
    Route::get('/main_sections/{int}/enableordisable', [\App\Http\Controllers\mainSectionController::class, 'enableordisable'])->name('main_Sections.enableordisable');
    Route::get('/sub_sections/{int}/enableordisable', [\App\Http\Controllers\subSectionController::class, 'enableordisable'])->name('sub_sections.index');
    Route::get('/products/{int}/enableordisable', [\App\Http\Controllers\productController::class, 'enableordisable'])->name('products.enableordisable');
    Route::get('/clients/{int}/enableordisable', [\App\Http\Controllers\clientController::class, 'enableordisable'])->name('clients.enableordisable');
    Route::get('/orders/{int}/enableordisable', [\App\Http\Controllers\orderController::class, 'enableordisable'])->name('orders.enableordisable');
    Route::get('/social_media_link/{int}/enableordisable', [\App\Http\Controllers\socialMediaLinksController::class, 'enableordisable'])->name('social_media_link.enableordisable');
    Route::get('/sys_bank_account/{int}/enableordisable', [\App\Http\Controllers\bankAccountController::class, 'enableordisable'])->name('bank_accounts.enableordisable');
    Route::get('/comments/{int}/enableordisable', [\App\Http\Controllers\commentController::class, 'enableordisable'])->name('comments.enableordisable');
    Route::get('/contact_information/{int}/enableordisable', [App\Http\Controllers\sysContactInfoController::class, 'enableordisable'])->name("contact_information.enableordisable");
    Route::get('/contact_information_2/{int}/enableordisable', [App\Http\Controllers\sysContactInfoController::class, 'enableordisable2'])->name("contact_information.enableordisable2");
    Route::get('/reports/{int}/enableordisable', [App\Http\Controllers\reportController::class, 'enableordisable'])->name('report.enableordisable');


////////////////////////////////////////////////////   delete row
    Route::get('/manager/{int}/delete', [\App\Http\Controllers\ManagerController::class, 'delete'])->name('manager.delete');
    Route::get('/positions_permissions/{int}/delete', [App\Http\Controllers\positions_permissionsController::class, 'delete'])->name('positions_permissionsController.delete');
    Route::get('/media_library/{int}/delete', [App\Http\Controllers\MediaLibraryController::class, 'delete'])->name('media_Library.delete');
    Route::get('/banners/{int}/delete', [App\Http\Controllers\bannerController::class, 'delete'])->name('banners.delete');
    Route::get('/main_sections/{int}/delete', [\App\Http\Controllers\mainSectionController::class, 'delete'])->name('main_Sections.delete');
    Route::get('/sub_sections/{int}/delete', [\App\Http\Controllers\subSectionController::class, 'delete'])->name('sub_sections.delete');
    Route::get('/products/{int}/delete', [\App\Http\Controllers\productController::class, 'delete'])->name('products.delete');
    Route::get('/clients/{int}/delete', [\App\Http\Controllers\clientController::class, 'delete'])->name('clients.delete');
    Route::get('/measure/{int}/delete', [\App\Http\Controllers\MeasureController::class, 'delete'])->name('measure.delete');
    Route::get('/orders/{int}/delete', [\App\Http\Controllers\orderController::class, 'delete'])->name('orders.delete');
    Route::get('/social_media_link/{int}/delete', [\App\Http\Controllers\socialMediaLinksController::class, 'delete'])->name('social_media_link.delete');
    Route::get('/sys_bank_account/{int}/delete', [\App\Http\Controllers\bankAccountController::class, 'delete'])->name('bank_accounts.delete');
    Route::get('/comments/{int}/delete', [\App\Http\Controllers\commentController::class, 'delete'])->name('comments.delete');
    Route::get('/shipping_charge/{int}/delete', [App\Http\Controllers\shippingChargeController::class, 'delete'])->name("shipping_charge.delete");
    Route::get('/contact_information/{int}/delete', [App\Http\Controllers\sysContactInfoController::class, 'delete'])->name("contact_information.delete");
    Route::get('/contact_information_2/{int}/delete', [App\Http\Controllers\sysContactInfoController::class, 'delete2'])->name("contact_information.delete2");
    Route::get('/reports/{int}/delete', [App\Http\Controllers\reportController::class, 'delete'])->name('report.delete');


////////////////////////////////////////////////////   search row
    Route::get('/manager/search', [\App\Http\Controllers\ManagerController::class, 'search'])->name('manager.search');
    Route::get('/positions_permissions/search', [App\Http\Controllers\positions_permissionsController::class, 'search'])->name('positions_permissions.search');
    Route::get('/media_library/search', [App\Http\Controllers\MediaLibraryController::class, 'search'])->name('media_library.search');
    Route::get('/banners/search', [App\Http\Controllers\bannerController::class, 'search'])->name('banners.search');
    Route::get('/main_sections/search', [\App\Http\Controllers\mainSectionController::class, 'search'])->name('main_sections.search');
    Route::get('/sub_sections/search', [\App\Http\Controllers\subSectionController::class, 'search'])->name('sub_sections.search');
    Route::get('/products/search', [\App\Http\Controllers\productController::class, 'search'])->name('products.search');
    Route::get('/clients/search', [\App\Http\Controllers\clientController::class, 'search'])->name('clients.search');
    Route::get('/orders/search', [\App\Http\Controllers\orderController::class, 'search'])->name('orders.search');
    Route::get('/measure/search', [App\Http\Controllers\MeasureController::class, 'search'])->name('measure.search');
    Route::get('/measure/search2', [App\Http\Controllers\MeasureController::class, 'search'])->name('measure.search2');
    Route::get('/social_media_link/search', [\App\Http\Controllers\socialMediaLinksController::class, 'search'])->name('social_media_link.search');
    Route::get('/shipping_charge/search', [\App\Http\Controllers\shippingChargeController::class, 'search'])->name('shipping_charge.search');
    Route::get('/sys_bank_account/search', [\App\Http\Controllers\bankAccountController::class, 'search'])->name('sys_bank_account.search');
    Route::get('/bank_transaction/search', [\App\Http\Controllers\bankTransactionController::class, 'search'])->name('bank_transaction.search');
    Route::get('/comments/search', [\App\Http\Controllers\commentController::class, 'search'])->name('comments.search');
    Route::get('/notifications/search', [\App\Http\Controllers\notificationsController::class, 'search'])->name('notifications.search');
    Route::get('/email_box/search', [\App\Http\Controllers\emailBoxController::class, 'search'])->name('email_box.search');
    Route::get('/contact_information/search', [\App\Http\Controllers\sysContactInfoController::class, 'search'])->name('contact_information.search');
    Route::get('/contact_information_2/search', [\App\Http\Controllers\sysContactInfoController::class, 'search2'])->name('contact_information.search2');
    Route::get('/comment_reports/display', [App\Http\Controllers\reportController::class, 'search'])->name('reports.search');


////////////////////////////////////////////////////  update button
    Route::get('/manager/{int}/update', [\App\Http\Controllers\ManagerController::class, 'update'])->name('manager.update');
    Route::get('/positions_permissions/{int}/update', [\App\Http\Controllers\positions_permissionsController::class, 'update'])->name('positions_permissions.update');
    Route::get('/media_library/{int}/update', [\App\Http\Controllers\MediaLibraryController::class, 'update'])->name('media_Library.update');
    Route::get('/banners/{int}/update', [\App\Http\Controllers\bannerController::class, 'update'])->name('banners.update');
    Route::get('/main_sections/{int}/update', [\App\Http\Controllers\mainSectionController::class, 'update'])->name('main_sections.update');
    Route::get('/sub_sections/{int}/update', [\App\Http\Controllers\subSectionController::class, 'update'])->name('sub_sections.update');
    Route::get('/products/{int}/update', [\App\Http\Controllers\productController::class, 'update'])->name('products.update');
    Route::get('/clients/{int}/update', [\App\Http\Controllers\clientController::class, 'update'])->name('clients.update');
    Route::get('/measure/{int}/update', [App\Http\Controllers\MeasureController::class, 'update'])->name('measure.update');
    Route::get('/social_media_link/{int}/update', [\App\Http\Controllers\socialMediaLinksController::class, 'update'])->name('social_media_link.update');
    Route::get('/sys_bank_account/{int}/update', [\App\Http\Controllers\bankAccountController::class, 'update'])->name('bank_accounts.update');
    Route::get('/shipping_charge/{int}/update', [App\Http\Controllers\shippingChargeController::class, 'update'])->name("shipping_charge.update");
    Route::get('/contact_information/{int}/update', [\App\Http\Controllers\sysContactInfoController::class, 'update'])->name("contact_information.update");
    Route::get('/contact_information_2/{int}/update', [\App\Http\Controllers\sysContactInfoController::class, 'update2'])->name("contact_information.update2");
    Route::get('/orders/{int}/update', [\App\Http\Controllers\orderController::class, 'update'])->name('orders.update');

////////////////////////////////////////////////////  store_update button
    Route::post('/manager/{int}/update', [\App\Http\Controllers\ManagerController::class, 'store_update'])->name('manager.store_update');
    Route::post('/positions_permissions/{int}/update', [\App\Http\Controllers\positions_permissionsController::class, 'store_update'])->name('positions_permissions.store_update');
    Route::post('/media_library/{int}/update', [\App\Http\Controllers\MediaLibraryController::class, 'store_update'])->name('media_Library.store_update');
    Route::post('/banners/{int}/update', [\App\Http\Controllers\bannerController::class, 'store_update'])->name('banners.store_update');
    Route::post('/main_sections/{int}/update', [\App\Http\Controllers\mainSectionController::class, 'store_update'])->name('main_sections.store_update');
    Route::post('/sub_sections/{int}/update', [\App\Http\Controllers\subSectionController::class, 'store_update'])->name('sub_sections.store_update');
    Route::post('/products/{int}/update', [\App\Http\Controllers\productController::class, 'store_update'])->name('products.store_update');
    Route::post('/clients/{int}/update', [\App\Http\Controllers\clientController::class, 'store_update'])->name('clients.store_update');
    Route::post('/measure/{int}/update', [App\Http\Controllers\MeasureController::class, 'store_update'])->name('measure.store_update');
    Route::post('/social_media_link/{int}/update', [\App\Http\Controllers\socialMediaLinksController::class, 'store_update'])->name('social_media_link.store_update');
    Route::post('/sys_bank_account/{int}/update', [\App\Http\Controllers\bankAccountController::class, 'store_update'])->name('bank_accounts.store_update');
    Route::post('/shipping_charge/{int}/update', [App\Http\Controllers\shippingChargeController::class, 'store_update'])->name('shipping_charge.store_update');
    Route::post('/contact_information_email/{int}/update', [\App\Http\Controllers\sysContactInfoController::class, 'store_update'])->name("contact_information.store_update");
    Route::post('/contact_information_phone/{int}/update', [\App\Http\Controllers\sysContactInfoController::class, 'store_update2'])->name("contact_information.store_update2");
    Route::post('/orders/{int}/update', [\App\Http\Controllers\orderController::class, 'store_update'])->name('orders.store_update');


////////////////////////////////////////////////////  tables   + cancel button
    Route::get('/manager', [\App\Http\Controllers\ManagerController::class, 'index'])->name('manager.index');
    Route::get('/manager_operations_record', [\App\Http\Controllers\ManagerController::class, 'index'])->name('manager_operations_record.index');
    Route::get('/positions_permissions', [App\Http\Controllers\positions_permissionsController::class, 'index'])->name('positions_permissions.index');
    Route::get('/media_library', [App\Http\Controllers\MediaLibraryController::class, 'index'])->name('media_Library.index');
    Route::get('/banners', [App\Http\Controllers\bannerController::class, 'index'])->name('banners.index');
    Route::get('/main_sections', [\App\Http\Controllers\mainSectionController::class, 'index'])->name('main_sections.index');
    Route::get('/sub_sections', [\App\Http\Controllers\subSectionController::class, 'index'])->name('sub_sections.index');
    Route::get('/products', [\App\Http\Controllers\productController::class, 'index'])->name('products.index');
    Route::get('/clients', [\App\Http\Controllers\clientController::class, 'index'])->name('clients.index');
    Route::get('/orders', [\App\Http\Controllers\orderController::class, 'index'])->name('orders.index');
    Route::get('/measure', [App\Http\Controllers\MeasureController::class, 'index'])->name('measure.index');
    Route::get('/contact_information', [\App\Http\Controllers\sysContactInfoController::class, 'index'])->name('contact_information.index');
    Route::get('/social_media_link', [\App\Http\Controllers\socialMediaLinksController::class, 'index'])->name('social_media_link.index');
    Route::get('/shipping_charge', [\App\Http\Controllers\shippingChargeController::class, 'index'])->name('shipping_charge.index');
    Route::get('/sys_bank_account', [\App\Http\Controllers\bankAccountController::class, 'index'])->name('bank_accounts.index');
    Route::get('/bank_transaction', [\App\Http\Controllers\bankTransactionController::class, 'index'])->name('bank_transaction.index');
    Route::get('/comments', [\App\Http\Controllers\commentController::class, 'index'])->name('comments.index');
    Route::get('/notifications', [\App\Http\Controllers\notificationsController::class, 'index'])->name('notifications.index');
    Route::get('/email_box', [\App\Http\Controllers\emailBoxController::class, 'index'])->name('email_box.index');


//    Route::get('/profile', function () {
//        //
//    })->withoutMiddleware([EnsureTokenIsValid::class]);
//Route::group(['middleware' => 'web'], function () {
//
//
//});


////////////////////////////////////////////////////   go to forms
    Route::get('manager/new-manager-form/insertData', [App\Http\Controllers\managerController::class, 'insertData']);
    Route::get('positions_permissions/new-position-form/insertData', [App\Http\Controllers\positions_permissionsController::class, 'insertData']);
    Route::get('media_library/new-mediaLibrary-form/insertData', [App\Http\Controllers\MediaLibraryController::class, 'insertData']);
    Route::get('banners/new-banner-form/insertData', [App\Http\Controllers\bannerController::class, 'insertData']);
    Route::get('main_sections/new-maninSection-form/insertData', [App\Http\Controllers\mainSectionController::class, 'insertData']);
    Route::get('social_media_link/new-social-media-form/insertData', [App\Http\Controllers\socialMediaLinksController::class, 'insertData']);
    Route::get('sub_sections/new-subSection-form/insertData', [App\Http\Controllers\subSectionController::class, 'insertData']);
    Route::get('products/new-product-form/insertData', [App\Http\Controllers\productController::class, 'insertData']);

    Route::get('clients/new-client-form/insertData', [App\Http\Controllers\clientController::class, 'insertData']);
    Route::get('measure/update-measures-form/insertData', [App\Http\Controllers\MeasureController::class, 'insertData']);
    Route::get('sys_bank_account/new-bank-account-form/insertData', [App\Http\Controllers\bankAccountController::class, 'insertData']);
    Route::get('notifications/new-notifications-form/insertData', [App\Http\Controllers\notificationsController::class, 'insertData']);
    Route::get('shipping_charge/new-shipping-charge-form/insertData', [\App\Http\Controllers\shippingChargeController::class, 'insertData']);
    Route::get('/contact_information/new-email-form/insertData', [\App\Http\Controllers\sysContactInfoController::class, 'insertData'])->name("contact_information.insertData");
    Route::get('/contact_information/new-phone-form/insertData', [App\Http\Controllers\sysContactInfoController::class, 'insertData2'])->name("contact_information.insertData2");


////////////////////////////////////////////////////   save btn
    Route::Post('/store-manager', [App\Http\Controllers\managerController::class, 'store'])->name("store_new_manager");
    Route::Post('/store-bank-account', [App\Http\Controllers\bankAccountController::class, 'store'])->name("store_new_bank_account");
    Route::Post('/store-media-library', [App\Http\Controllers\MediaLibraryController::class, 'store'])->name("store-media-library");
    Route::Post('/store-banner', [App\Http\Controllers\bannerController::class, 'store'])->name("store_banner");
    Route::Post('/store-main-section', [App\Http\Controllers\mainSectionController::class, 'store'])->name("store_main_section");
    Route::Post('/store-sub-section', [App\Http\Controllers\subSectionController::class, 'store'])->name("store_sub_section");
    Route::Post('/store-client', [App\Http\Controllers\clientController::class, 'store'])->name("store-client");
    Route::Post('/store-position', [App\Http\Controllers\positions_permissionsController::class, 'store'])->name("store-position");
    Route::Post('/store-product', [App\Http\Controllers\productController::class, 'store'])->name("store-product");
    Route::Post('/store-social-media-links', [App\Http\Controllers\socialMediaLinksController::class, 'store'])->name("store-social-media-links");
    Route::Post('/store-notification', [App\Http\Controllers\notificationsController::class, 'store'])->name("store-social-media-links");
    Route::post('/store-measure', [App\Http\Controllers\MeasureController::class, 'store'])->name('store-measure');
    Route::post('/store-shipping-charge', [App\Http\Controllers\shippingChargeController::class, 'store'])->name("store-shipping-charge");
    Route::post('/store-contact-information-email', [\App\Http\Controllers\sysContactInfoController::class, 'store'])->name("contact_information.store");
    Route::post('/store-contact-information-phone', [\App\Http\Controllers\sysContactInfoController::class, 'store2'])->name("contact_information.store2");


////////////////////////////////////////////////////   display
    Route::get('manager/manager_operations_record/display', [App\Http\Controllers\ManagerController::class, 'index'])->name('manager_operations_record.index');
    Route::get('products/product_details/display', [App\Http\Controllers\productController::class, 'display'])->name('product_details.display');
//Route::get('sys_info_phone/contact_info/display', [App\Http\Controllers\sysContactInfoController::class, 'index'])->name('sys_info_phone.index');
    Route::get('comments/comment_reports/display', [App\Http\Controllers\reportController::class, 'index'])->name('comment_reports');
    Route::get('email_box/email_display/display', [App\Http\Controllers\emailBoxController::class, 'display'])->name('email_box.display');

});

Route::view('/test', 'test');

//
////Ruba
//Route::post('/addManager', [App\Http\Controllers\managerController::class, 'addManager']);
////for testing edit
//Route::post('/update', [App\Http\Controllers\managerController::class, 'update']);
//Route::post('/TestEdit', [App\Http\Controllers\managerController::class, 'update']);
//Route::view('/new-role-form','new-role-form');
//Route::view('/new-photolibrary-form','new-photolibrary-form');
//Route::view('/new-banner-form','new-banner-form');
//Route::view('/new-mainDepartment-form','new-mainDepartment-form');
//Route::view('/new-subDepartment-form','new-subDepartment-form');
//Route::view('/new-client-form','new-client-form');
//Route::view('/new-social-media-form','new-social-media-form');
//Route::view('/new-bank-account-form','new-bank-account-form');
//Route::view('/new-product-form','new-product-form');
//Route::view('/measures-form','measures-form');
//Route::view('/notifications-form','notifications-form');
//Route::view('/TestEdit','TestEditting');
//
