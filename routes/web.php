<?php

Route::group(['middleware' => 'user'], function()
{
    Route::post('/pictures/{id}/comment', 'CommentController@insertComment');
    
    Route::post('/pictures/{id}/update/{cId}', 'CommentController@updateComment');
    
    Route::get('/pictures/{id}/delete/{cId}', 'CommentController@deleteComment');
    
    Route::get('/share', 'FrontEndController@getShare');
    
    Route::post('/share/share', 'PictureController@sharePicture')->name('sharePicture');
    
    Route::get('/share/delete/{id}', 'PictureController@deletePicture');
    
    Route::post('/share/change/{id}', 'UserController@changeUser');
    
    Route::get('/logout', 'UserController@logout')->name('logout');
});

Route::group(['middleware' => 'admin'], function()
{
    Route::get('/admin-panel/users/{id?}', 'AdminController@showUsers');
    
    Route::post('/admin-panel/users/insert', 'UserController@insertUser')->name('insertUser');
    
    Route::post('/admin-panel/users/update/{id}', 'UserController@updateUser');

    Route::get('/admin-panel/users/delete/{id}', 'UserController@deleteUser');

    Route::get('/admin-panel/pictures/{id?}', 'AdminController@showPictures');
    
    Route::post('/admin-panel/pictures/insert', 'PictureController@insertPicture')->name('insertPicture');
    
    Route::post('/admin-panel/pictures/update/{id}', 'PictureController@updatePicture');
    
    Route::get('/admin-panel/pictures/delete/{id}', 'PictureController@deletePicture');

    Route::get('/admin-panel/categories/{id?}', 'AdminController@showCategories');
    
    Route::post('/admin-panel/categories/insert', 'CategoryController@insertCategory')->name('insertCategory');
    
    Route::post('/admin-panel/categories/update/{id}', 'CategoryController@updateCategory');
    
    Route::get('/admin-panel/categories/delete/{id}', 'CategoryController@deleteCategory');

    Route::get('/admin-panel/navigation/{id?}', 'AdminController@showNavigation');
    
    Route::post('/admin-panel/navigation/insert', 'NavigationController@insertNavigation')->name('insertNavigation');
    
    Route::post('/admin-panel/navigation/update/{id}', 'NavigationController@updateNavigation');
    
    Route::get('/admin-panel/navigation/delete/{id}', 'NavigationController@deleteNavigation');
    
    Route::get('/admin-panel/roles/{id?}', 'AdminController@showRoles');
    
    Route::post('/admin-panel/roles/insert', 'RoleController@insertRole')->name('insertRole');
    
    Route::post('/admin-panel/roles/update/{id}', 'RoleController@updateRole');
    
    Route::get('/admin-panel/roles/delete/{id}', 'RoleController@deleteRole');

    Route::get('/admin-panel/polls/{id?}', 'AdminController@showPolls');
    
    Route::post('/admin-panel/polls/insert', 'PollController@insertPoll')->name('insertPoll');
    
    Route::get('admin-panel/polls/activate/{id}', 'PollController@activatePoll');
    
    Route::post('/admin-panel/polls/update/{id}', 'PollController@updatePoll');
    
    Route::get('/admin-panel/polls/delete/{id}', 'PollController@deletePoll');
});

Route::get('/', 'FrontEndController@getHome');

Route::get('/home', 'FrontEndController@getHome');

Route::post('/home/register', 'UserController@register')->name('register');

Route::post('/home/login', 'UserController@login')->name('login');

Route::get('/home/showPoll', 'PollController@showPoll');

Route::post('/home/insertVote', 'PollController@insertVote')->name('insertVote');

Route::get('/gallery', 'FrontEndController@getGallery');

Route::get('/gallery/{cat}', 'FrontEndController@showCategorized');

Route::get('/pictures/{id}/{cId?}', 'FrontEndController@getPicture');

Route::get('/information', 'FrontEndController@getInformation');

Route::get('/information/download', 'FrontEndController@download')->name('download');

Route::post('/information/mail', 'MailController@sendMail')->name('mail');












