<?php
/**
 * Website
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Website'], function () {
        Route::resource('websites', 'WebsitesController');
        //For Datatable
        Route::post('websites/get', 'WebsitesTableController')->name('websites.get');
    });
    
});