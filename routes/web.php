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


Route::view('/datatable','skpi.datatable');
Route::get('/frontend/visimisi','DashboardController@visimisi');
Route::get('/','DashboardController@home_frontend');

Route::get('/login','AuthController@login')->name('login');
Route::post('skpi/postlogin','AuthController@postlogin');

Route::get('/register','AuthController@register')->name('register');




Route::post('fileDownload', function(){
    $file = request('file');
    return response()->download($file);
})->name('file.download');



Route::group(['middleware' => 'auth'], function(){
        Route::get('/dashboard','DashboardController@index');
        Route::get('/ormawa','OrmawaController@index');
        Route::post('/ormawa/create', 'OrmawaController@create');
        Route::get('/ormawa/{id}/edit', 'OrmawaController@edit');
        Route::post('/ormawa/{id}/update', 'OrmawaController@update');
        Route::get('/ormawa/{id}/delete', 'OrmawaController@delete');
        Route::get('/ormawa/{id}/profile', 'OrmawaController@profile');


        Route::get("/kalbiser/profile/{id}/printlist", "KalbiserController@print_skpi_list")->name("skpi.printlist");

        Route::get('/prodi','ProdiController@index');
        Route::post('/prodi/create', 'ProdiController@create');
        Route::get('/approveprodi', 'ProdiController@approve');
        Route::get('/prodi/{id}/edit', 'ProdiController@edit');
        Route::post('/prodi/{id}/update', 'ProdiController@update');
        Route::get('/prodi/{id}/delete', 'ProdiController@delete');


        Route::get('/kegiatan','KegiatanController@index');
        Route::post('/kegiatan/create', 'KegiatanController@create');
        Route::get('/kegiatan/{id}/edit', 'KegiatanController@edit');
        Route::post('/kegiatan/{id}/update', 'KegiatanController@update');
        Route::get('/kegiatan/{id}/delete', 'KegiatanController@delete');
        Route::get('/pendaftaran_kegiatan/{id}', 'KegiatanController@pendaftaran_kegiatan_index');
        Route::post('/pendaftaran_kegiatan/create', 'KegiatanController@pendaftaran_kegiatan_create');
        Route::get('/pendaftaran_kegiatan/ricardo/export_excel', 'ExportController@export_excel');

        Route::get('/kegiatan_anggota', 'KegiatanController@data_anggota_ormawa_index')->name("kegiatan_anggota.index");
        Route::get('/kegiatan_anggota/create', 'KegiatanController@data_anggota_ormawa_create');

        Route::post('/kegiatan_anggota/post', 'KegiatanController@data_anggota_ormawa_post')->name("kegiatan_anggota.post");

        Route::get('/k-internal', 'KompetisiinternalController@index');
        Route::get('/kompetisiinternal/create', 'KompetisiinternalController@create');
        Route::post('/kompetisiinternal/create', 'KompetisiinternalController@store');


        Route::get('/kompetisiinternal/{id}/edit', 'KompetisiinternalController@edit');
        Route::post('/kompetisiinternal/{id}/update', 'KompetisiinternalController@update');
        Route::get('/kompetisiinternal/{id}/delete', 'KompetisiinternalController@delete');
        Route::get('/kompetisiinternal/fileupload/{id}', 'KompetisiinternalController@fileUpload');
        Route::post('/kompetisiinternal/fileupload/{id}', 'KompetisiinternalController@doUpload');
        Route::delete('/kompetisiinternal/removeFile/{id}', 'KompetisiinternalController@removeFile');

        // Approval kompetisi
        Route::get('/approvekompetisi', 'KompetisiinternalController@approveindex');
        Route::get('/approvekompetisi/{id}', 'KompetisiinternalController@approvestatus');
        Route::get('/approvekompetisi2/{id}', 'KompetisiinternalController@approvestatus2');
        Route::get('/approvekompetisiall', 'KompetisiinternalController@approvestatuskompetisiall');
        // Approval kegiatan
        Route::get('/approvekegiatan', 'KegiatanController@approveindex');
        Route::get('/approvekegiatan/{id}', 'KegiatanController@approvestatus');
        Route::get('/approvekegiatan2/{id}', 'KegiatanController@approvestatus2');
        Route::get('/approvekegiatanall', 'KegiatanController@approvestatusall');
        // Approval Skpi
        Route::get('/approveskpi', 'SkpiController@approveindex');
        Route::get('/approveskpi/{id}', 'SkpiController@approvestatus');
        Route::get('/approveskpi2/{id}', 'SkpiController@approvestatus2');
        Route::get('/approveskpiall', 'SkpiController@approvestatusall');




        Route::get('/kalbiser','KalbiserController@index');
        Route::post('/kalbiser/create', 'KalbiserController@create');
        Route::get('/kalbiser/{kalbiser}/edit', 'KalbiserController@edit');
        Route::post('/kalbiser/{id}/update', 'KalbiserController@update');
        Route::get('/kalbiser/{id}/delete', 'KalbiserController@delete');
        Route::get('/kalbiser/{id}/profile', 'KalbiserController@profile');

        Route::get('/skpi','SkpiController@index');
        Route::post('/skpi/create','SkpiController@create');
        Route::get('/skpi/{id}/delete','SkpiController@delete');
        Route::get('/skpi/{skpi}/edit', 'SkpiController@edit');
        Route::post('/skpi/{id}/update', 'SkpiController@update');
        Route::post('/skpi/downloadword', 'DokumenController@worddownload');

        Route::resource('background_images', 'BackgroundImageController');
        
        Route::get('/logout','AuthController@logout');
});

Route::group(["middleware" => "auth"], function(){
    Route::get("/ajax/datas", "AjaxRequestController@getDatas")->name("ajax.datas");
});

Route::get('/ormawa/{id}','hmjController@index');
Route::get('generate-docx','SkpiController@generate-docx');

Route::post('/kalbiser/profile/downloadword', 'KalbiserController@wordkalbiser');
Route::get('/kegiatan/nosertif', 'KegiatanController@tabelnosertif');