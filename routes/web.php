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

Route::get('admin', [
    'uses' => 'AdminController@getAdminLogin',
    'as' => 'admin.login',
    'middleware' => ['guest']
]);
Route::post('admin', [
    'uses' => 'AdminController@authUser',
    'as' => 'admin.auth',
    'middleware' => ['guest']
]);
Route::get('admin/logout', [
    'uses' => 'AdminController@getAdminLogout',
    'as' => 'admin.logout',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard', [
    'uses' => 'AdminController@getDashboard',
    'as' => 'admin.dashboard',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/category', [
    'uses' => 'AdminController@getCategories',
    'as' => 'admin.category',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/category/add', [
    'uses' => 'AdminController@addCategories',
    'as' => 'admin.category.add',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/category/insert', [
    'uses' => 'AdminController@insertCategories',
    'as' => 'admin.category.insert',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/category/edit/{id}', [
    'uses' => 'AdminController@editCategories',
    'as' => 'admin.category.edit',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/category/update/', [
    'uses' => 'AdminController@updateCategories',
    'as' => 'admin.category.update',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/category/delete', [
    'uses' => 'AdminController@deleteCategories',
    'as' => 'admin.category.delete',
    'middleware' => ['not_admin']
]);

Route::get('admin/dashboard/sub-category', [
    'uses' => 'AdminController@getSubCategories',
    'as' => 'admin.sub_category',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/sub-category/add', [
    'uses' => 'AdminController@addSubCategories',
    'as' => 'admin.sub_category.add',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/sub-category/insert', [
    'uses' => 'AdminController@insertSubCategories',
    'as' => 'admin.sub_category.insert',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/sub-category/edit/{id}', [
    'uses' => 'AdminController@editSubCategories',
    'as' => 'admin.sub_category.edit',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/sub-category/update/', [
    'uses' => 'AdminController@updateSubCategories',
    'as' => 'admin.sub_category.update',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/sub-category/delete', [
    'uses' => 'AdminController@deleteSubCategories',
    'as' => 'admin.sub_category.delete',
    'middleware' => ['not_admin']
]);

Route::get('admin/dashboard/unit/', [
    'uses' => 'AdminController@getUnit',
    'as' => 'admin.unit',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/unit/action', [
    'uses' => 'AdminController@actionUnit',
    'as' => 'admin.unit.action',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/unit/delete', [
    'uses' => 'AdminController@deleteUnit',
    'as' => 'admin.unit.delete',
    'middleware' => ['not_admin']
]);

Route::get('admin/dashboard/grade/', [
    'uses' => 'AdminController@getGrade',
    'as' => 'admin.grade',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/grade/action', [
    'uses' => 'AdminController@actionGrade',
    'as' => 'admin.grade.action',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/grade/delete', [
    'uses' => 'AdminController@deleteGrade',
    'as' => 'admin.grade.delete',
    'middleware' => ['not_admin']
]);

Route::get('admin/dashboard/package/', [
    'uses' => 'AdminController@getPackage',
    'as' => 'admin.package',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/package/action', [
    'uses' => 'AdminController@actionPackage',
    'as' => 'admin.package.action',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/package/delete', [
    'uses' => 'AdminController@deletePackage',
    'as' => 'admin.package.delete',
    'middleware' => ['not_admin']
]);


Route::get('admin/dashboard/about-us', [
    'uses' => 'AdminController@getAbout',
    'as' => 'admin.about',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/about-us/add', [
    'uses' => 'AdminController@addAbout',
    'as' => 'admin.about.add',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/about-us/insert', [
    'uses' => 'AdminController@insertAbout',
    'as' => 'admin.about.insert',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/about-us/edit/{id}', [
    'uses' => 'AdminController@editAbout',
    'as' => 'admin.about.edit',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/about-us/update/', [
    'uses' => 'AdminController@updateAbout',
    'as' => 'admin.about.update',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/about-us/delete', [
    'uses' => 'AdminController@deleteAbout',
    'as' => 'admin.about.delete',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/banner', [
    'uses' => 'AdminController@getBanners',
    'as' => 'admin.banner',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/banner/add', [
    'uses' => 'AdminController@addBanner',
    'as' => 'admin.banner.add',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/banner/insert', [
    'uses' => 'AdminController@insertBanner',
    'as' => 'admin.banner.insert',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/banner/edit/{id}', [
    'uses' => 'AdminController@editBanner',
    'as' => 'admin.banner.edit',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/banner/update', [
    'uses' => 'AdminController@updateBanner',
    'as' => 'admin.banner.update',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/banner/delete/', [
    'uses' => 'AdminController@deleteBanner',
    'as' => 'admin.banner.delete',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/testimonial', [
    'uses' => 'AdminController@getTestimonials',
    'as' => 'admin.testimonial',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/testimonial/add', [
    'uses' => 'AdminController@addTestimonial',
    'as' => 'admin.testimonial.add',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/testimonial/insert', [
    'uses' => 'AdminController@insertTestimonial',
    'as' => 'admin.testimonial.insert',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/testimonial/edit/{id}', [
    'uses' => 'AdminController@editTestimonial',
    'as' => 'admin.testimonial.edit',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/testimonial/update', [
    'uses' => 'AdminController@updateTestimonial',
    'as' => 'admin.testimonial.update',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/testimonial/delete/', [
    'uses' => 'AdminController@deleteTestimonial',
    'as' => 'admin.testimonial.delete',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/profile/', [
    'uses' => 'AdminController@getAdminProfile',
    'as' => 'admin.profile',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/profile/update', [
    'uses' => 'AdminController@updateAdminProfile',
    'as' => 'admin.profile.update',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/settings/', [
    'uses' => 'AdminController@getAdminSettings',
    'as' => 'admin.settings',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/settings/update', [
    'uses' => 'AdminController@updateAdminSettings',
    'as' => 'admin.settings.update',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/supplier/', [
    'uses' => 'AdminController@getSuppliers',
    'as' => 'admin.suppliers',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/supplier/update', [
    'uses' => 'AdminController@updateSuppliers',
    'as' => 'admin.suppliers.update',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/contact', [
    'uses' => 'AdminController@getContacts',
    'as' => 'admin.contact',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/contact/add', [
    'uses' => 'AdminController@addContact',
    'as' => 'admin.contact.add',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/contact/insert', [
    'uses' => 'AdminController@insertContact',
    'as' => 'admin.contact.insert',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/contact/edit/{id}', [
    'uses' => 'AdminController@editContact',
    'as' => 'admin.contact.edit',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/contact/update', [
    'uses' => 'AdminController@updateContact',
    'as' => 'admin.contact.update',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/contact/delete/', [
    'uses' => 'AdminController@deleteContact',
    'as' => 'admin.contact.delete',
    'middleware' => ['not_admin']
]);
Route::get('admin/dashboard/social/', [
    'uses' => 'AdminController@getSocial',
    'as' => 'admin.social',
    'middleware' => ['not_admin']
]);
Route::post('admin/dashboard/social/update', [
    'uses' => 'AdminController@updateSocial',
    'as' => 'admin.social.update',
    'middleware' => ['not_admin']
]);


Route::get('/', [
    'uses' => 'WebController@getHome',
    'as' => 'web.home'
]);
Route::get('/about-us', [
    'uses' => 'WebController@getAbout',
    'as' => 'web.about.us'
]);
Route::get('/contact-us', [
    'uses' => 'WebController@getContact',
    'as' => 'web.contact.us'
]);
Route::get('/categories', [
    'uses' => 'WebController@getCategories',
    'as' => 'web.categories'
]);
Route::get('/category/{id}/{title}', [
    'uses' => 'WebController@getCategoryProducts',
    'as' => 'web.category.products'
]);
Route::get('/product/{id}/{title}', [
    'uses' => 'WebController@getProduct',
    'as' => 'web.products'
]);
Route::get('/for-buyers/', [
    'uses' => 'WebController@getBuyers',
    'as' => 'web.for.buyers'
]);
Route::get('/for-suppliers/', [
    'uses' => 'WebController@getSuppliers',
    'as' => 'web.for.suppliers'
]);

Route::get('app/payment/{price}/{uid}/', [
    'uses' => 'WebController@getPayParameter'
]);
Route::post('app/payment/redirect', [
    'uses' => 'WebController@getPaymentResponse'
]);