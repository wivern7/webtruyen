<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('install', 'HomeController@install');

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => 'dashboard'], function(){
        // Member Normal
        Route::get('/',['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);
        Route::get('/password',['as' => 'dashboard.changepassword', 'uses' => 'DashboardController@password']);
        Route::put('/password',['as' => 'dashboard.changepassword', 'uses' => 'UserController@passwordChange']);

        // Composer
        Route::group(['middleware' => ['composer']], function() {
            Route::get('search',['as' => 'dashboard.search', 'uses' => 'DashboardController@search']);

            Route::resource('story', 'StoryController',['except' => ['show']]);
            Route::resource('chapter', 'ChapterController',['except' => ['show']]);
            Route::resource('author', 'AuthorController', ['except' => ['show']]);
            Route::post('api/author', ['as' => 'dashboard.author.ajax.create', 'uses' => 'AuthorController@ajaxCreate']);
            Route::group(['prefix' => 'chapter'], function(){
                Route::get('list/{id}', ['as' => 'dashboard.chapter.list', 'uses' => 'ChapterController@listChapter']);
            });
        });

        // Admin
        Route::group(['middleware' => ['admin']], function() {
            Route::resource('category', 'CategoryController', ['except' => ['show']]);
            Route::resource('user', 'UserController', ['except' => ['show']]);
            Route::resource('report', 'ReportController', ['except' => ['show', 'store', 'edit', 'delete', 'create', 'update']]);
            Route::get('setting', ['as' => 'dashboard.setting.index', 'uses' => 'OptionController@index']);
            Route::get('setting/tos', ['as' => 'dashboard.setting.tos', 'uses' => 'OptionController@tos']);
            Route::put('setting', ['as' => 'dashboard.setting.update', 'uses' => 'OptionController@update']);
            Route::get('setting/ads', ['as' => 'dashboard.setting.ads', 'uses' => 'OptionController@ads']);
            Route::put('setting/ads', ['as' => 'dashboard.setting.adsupdate', 'uses' => 'OptionController@update']);
            Route::get('leech', 'LeechController@index');
            // AJAX
            Route::group(['prefix' => 'api'], function(){
                Route::post('category', ['as' => 'dashboard.category.ajax.create', 'uses' => 'CategoryController@ajaxCreate']);
                 // leech tool
                Route::get('leech/story', 'LeechController@getListChapters');
                Route::get('leech/chapter', 'LeechController@getContentChapter');
            });
        });
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
    Route::get('/home', function(){
        Session::forget('viewed.0');
        foreach (Session::get('viewed') as $key => $value) {
          echo $key;
          dd($value);
        }
        //redirect('/');
    });

    // Page
    Route::get('tos', 'HomeController@tos');
    Route::get('contact', 'HomeController@contact');
    Route::put('contact', 'HomeController@sendContact')->middleware('api');
    Route::get('sitemap.xml', 'HomeController@sitemap');

    // Index List
    Route::get('the-loai/{category}', ['as' => 'category.list.index', 'uses' => 'StoryController@getListByCategory']);
    Route::get('tac-gia/{author}', ['as' => 'author.list.index', 'uses' => 'StoryController@getListByAuthor']);
    Route::group(['prefix' => 'danh-sach'], function() {
        Route::get('truyen-hot', ['as' => 'danhsach.truyenhot', 'uses' => 'StoryController@getListHotStory']);
        Route::get('truyen-moi', ['as' => 'danhsach.truyenmoi', 'uses' => 'StoryController@getListNewStory']);
        Route::get('truyen-full', ['as' => 'danhsach.truyenfull', 'uses' => 'StoryController@getListFullStory']);
    });
    Route::get('search', ['as' => 'danhsach.search', 'uses' => 'StoryController@getListBySearch']);
    // API
    Route::group(['prefix' => 'api', 'middleware' => 'api'], function(){
        Route::any('new-post', 'StoryController@getAjaxListNewStories');
        Route::any('hot-post', 'StoryController@getAjaxListHotStories');
        Route::any('report-chapter', 'ReportController@store');
    });
    //Show
    Route::get('{story}', ['as' => 'story.show', 'uses' => 'StoryController@showInfoStory']);
    Route::get('{story}/{chapter}', ['as' => 'chapter.show', 'uses' => 'StoryController@showInfoChapter']);
});
