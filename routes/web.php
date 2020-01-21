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
Auth::routes();

/*Front End*/
Route::get('/', function () {
    return view('front');
});




/*Route for Ajax request*/
Route::post('/__checkToken', 'TestController@checkToken')->name('__checkToken');
Route::get('/__getQuestions', 'TestController@getQuestions')->name('__getQuestions');
Route::post('/_submitTest', 'TestController@submitTest')->name('__submitTest');

/*Login required*/
Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/forms', 'CandidateController@forms')->name('forms');
    Route::get('/test', 'TestController@index')->name('test');
    Route::get('/dotest', 'TestController@doTest')->name('test.start');
    Route::get('/print/{candidate}', 'CandidateController@print')->name('print');

    /*Admin area*/
    /*Settings*/
    Route::get('/settings', 'SettingController@edit')->name('settings');
    Route::post('/update_settings', 'SettingController@update')->name('update_settings');

    /*Dashboard*/
    Route::get('admin/dashboard','DashboardController@index')->name('dashboard');

    /*Manage Questions*/
    Route::get('admin/question/', 'QuestionController@index')->name('question.index');
    Route::get('admin/question/create', 'QuestionController@create')->name('question.create');
    Route::get('admin/question/{question}/edit', 'QuestionController@edit')->name('question.edit');
    Route::post('admin/question/store', 'QuestionController@store')->name('question.store');
    Route::post('admin/question/update/{question}', 'QuestionController@update')->name('question.update');
    Route::get('admin/question/delete/{question}', 'QuestionController@destroy')->name('question.destroy');
    Route::get('admin/question/upload/', 'QuestionController@upload')->name('question.upload');
    Route::post('admin/question/import/', 'QuestionController@import')->name('question.import');

    /*Manage Majors*/
    Route::get('admin/major/', 'MajorController@index')->name('major.index');
    Route::get('admin/major/create', 'MajorController@create')->name('major.create');
    Route::get('admin/major/{major}/edit', 'MajorController@edit')->name('major.edit');
    Route::post('admin/major/store', 'MajorController@store')->name('major.store');
    Route::post('admin/major/update/{major}', 'MajorController@update')->name('major.update');
    Route::get('admin/major/delete/{major}', 'MajorController@destroy')->name('major.destroy');

    /*Manage Candidates*/
    Route::get('admin/candidate/', 'CandidateController@index')->name('candidate.index');
    Route::get('admin/candidate/{candidate}/detail/', 'CandidateController@show')->name('candidate.show');
    Route::get('admin/candidate/create', 'CandidateController@create')->name('candidate.create');
    Route::get('admin/candidate/{candidate}/edit', 'CandidateController@edit')->name('candidate.edit');
    Route::post('admin/candidate/store', 'CandidateController@store')->name('candidate.store');
    Route::post('admin/candidate/update/{candidate}', 'CandidateController@update')->name('candidate.update');
    Route::post('admin/candidate/upload/{candidate}/{document}', 'CandidateController@upload')->name('candidate.upload');
    Route::get('admin/candidate/remove_file/{candidate}/{document}', 'CandidateController@removeDocument')->name('candidate.remove_document');
    Route::get('admin/candidate/document_pass/{candidate}', 'CandidateController@document_pass')->name('candidate.document_pass');
    Route::get('admin/candidate/document_fail/{candidate}', 'CandidateController@document_fail')->name('candidate.document_fail');

    /*Test*/
    Route::post('test/finish', 'TestController@finishTest')->name('test.finish');
    Route::get('admin/test/review/{test}', 'TestController@review')->name('test.review');
    Route::get('admin/test/result/{majore_id?}/', 'TestController@results')->name('test.results');
    Route::post('admin/test/admissionProcess/', 'TestController@admissionProcess')->name('test.admissionProcess');

    /*Report*/
    Route::get('admin/report/candidates', 'CandidateController@report')->name('candidate.report');

    /*Users*/
    Route::get('admin/user/', 'UserController@index')->name('user.index');
    Route::get('admin/user/create', 'UserController@create')->name('user.create');
    Route::get('admin/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::post('admin/user/store', 'UserController@store')->name('user.store');
    Route::post('admin/user/update/{user}', 'UserController@update')->name('user.update');
    Route::get('admin/user/delete/{user}', 'UserController@destroy')->name('user.destroy');

});
