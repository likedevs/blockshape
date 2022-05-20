<?php

Route::group(['prefix' => 'admin'], function()
{
    /*
    |-------------------------------------------------------
    | Authentication
    |-------------------------------------------------------
    */
    Route::get('login', 'Terranet\Administrator\AuthController@getLogin');
    Route::post('login', 'Terranet\Administrator\AuthController@postLogin');
    Route::get('logout', 'Terranet\Administrator\AuthController@logout');
});

Route::group(['prefix' => 'admin', 'middleware' => '\Terranet\Administrator\Middleware\Authenticate'], function()
{
    Route::get('/', function()
    {
        $homepage = config('administrator.home_page', '/members');

        return \Redirect::to($homepage);
    });

    /*
    |-------------------------------------------------------
    | Settings
    |-------------------------------------------------------
    */
    Route::group(['middleware' => '\Terranet\Administrator\Middleware\Settings'], function()
    {
        Route::get('settings/{page}',
            [
                'as'    => 'admin_settings_edit',
                'uses'  => 'Terranet\Administrator\Controller@listSettings'
            ]);

        Route::post('settings/{page}',
            [
                'as'    => 'admin_settings_update',
                'uses'  => 'Terranet\Administrator\Controller@saveSettings'
            ]);
    });

    /*
    |-------------------------------------------------------
    | Main Scaffolding routes
    |-------------------------------------------------------
    */
    Route::group(['middleware' => '\Terranet\Administrator\Middleware\Module'], function()
    {
        /*
        |-------------------------------------------------------
        | Custom routes
        |-------------------------------------------------------
        |
        | Controllers that shouldn't be handled by Scaffolding controller
        | goes here.
        |
        */
//        Route::controllers([
//            'test' => 'App\Http\Controllers\Admin\TestController'
//        ]);



        /*
        |-------------------------------------------------------
        | Scaffolding routes
        |-------------------------------------------------------
        */
        // Dashboard
        Route::get('dashboard',
            [
                'as'    => 'admin_dashboard',
                'uses'  => 'Terranet\Administrator\Controller@dashboard'
            ]);

        // Index
         
        // Route::get('/history_records',function(){
        //     dd('hbgf');
        // });

        Route::get('{page}',
            [
                'as'    => 'admin_model_index',
                'uses'  => 'Terranet\Administrator\Controller@index'
            ]);

        // Create new Item
        Route::get('{page}/create',
            [
                'as'    => 'admin_model_create',
                'uses'  => 'Terranet\Administrator\Controller@create'
            ]);

        // Save new item
        Route::post('{page}/create', 'Terranet\Administrator\Controller@update');

        // View Item
        Route::get('{page}/{id}',
            [
                'as'    => 'admin_model_view',
                'uses'  => 'Terranet\Administrator\Controller@view'
            ]);

        // Edit Item
        Route::get('{page}/{id?}/edit',
            [
                'as'    => 'admin_model_edit',
                'uses'  => 'Terranet\Administrator\Controller@edit'
            ]);

        // Save Item
        Route::post('{page}/{id?}/edit',
            [
                'as'    => 'admin_model_save',
                'uses'  => 'Terranet\Administrator\Controller@update'
            ]);

        // Delete Item
        Route::get('{page}/{id}/delete',
            [
                'as'    => 'admin_model_delete',
                'uses'  => 'Terranet\Administrator\Controller@delete'
            ]);

        // Custom Item Action
        Route::get('{page}/{id}/do-{action}',
            [
                'as'   => 'admin_model_custom_action',
                'uses' => 'Terranet\Administrator\Controller@custom'
            ]);

        // Custom Global Action
        Route::post('{page}/do-custom',
            [
                'as'   => 'admin_model_global_action',
                'uses' => 'Terranet\Administrator\Controller@customGlobal'
            ]);
    });
});
