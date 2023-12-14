<?php



/*

|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------

*/
Route::get("/offline",function(){
    return view("front.offline");
})->name("");

Route::prefix("admin")->name('admin.')->group(function () {
  

    Route::middleware('isLogin')->group(function () {
        Route::get('login', 'Back\Auth@login')->name('login');
        Route::post('login', 'Back\Auth@loginPost')->name('login.post');
    });


    Route::middleware('isAdmin')->group(function () {
      
        Route::get('panel', 'Back\Dashboard@index')->name('dashboard');
        // Articles routes
        Route::get('articles/removed','Back\ArticleController@removed')->name('removed.article');
        Route::resource('articles','Back\ArticleController');
       
        Route::get('/switch','Back\ArticleController@switch')->name('switch');
        Route::get('/deletearticle/{id}','Back\ArticleController@delete')->name('delete.article');
        Route::get('/harddeletearticle/{id}','Back\ArticleController@harddelete')->name('hard.delete.article');
        Route::get('/recoverdarticle/{id}','Back\ArticleController@recover')->name('recover.article');
        // Category routes;
        Route::get('categories','Back\CategoryController@index')->name('category.index');
        Route::get('categories/status','Back\CategoryController@status')->name('category.status');
        Route::post('categories/create','Back\CategoryController@create')->name('category.create');
        Route::post('categories/update','Back\CategoryController@update')->name('category.update');
        Route::get('categories/getData','Back\CategoryController@getData')->name('category.getdata');
        Route::post('categories/delete','Back\CategoryController@delete')->name('category.delete');
        Route::get('logout', 'Back\Auth@logout')->name('logout');
  

        // PAGE'S ROUTE'S

        Route::get('/pages','Back\PageController@index')->name('pages.index');
        Route::get('/pages/create','Back\PageController@create')->name('pages.create');
        Route::post('/pages/create','Back\PageController@store')->name('pages.store');
        Route::get('/pages/status','Back\PageController@status')->name('pages.status');
        Route::get('/pages/update/{id}','Back\PageController@edit')->name('pages.edit');
        Route::put('/pages/update/{id}','Back\PageController@update')->name('pages.update');
        Route::get('/pages/delete/{id}','Back\PageController@delete')->name('pages.delete');
        Route::get('/pages/orders','Back\PageController@orders')->name('pages.orders');

        // Config'S ROUTE'S 
        Route::get('/settings','Back\ConfigController@index')->name('config.index');
        Route::post('/settings/update','Back\ConfigController@update')->name('config.update');
    });

    });

/*

|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------

*/

Route::get('/', 'Front\Homepage@index')->name('homepage');
Route::get('/sayfa', 'Front\Homepage@index');
Route::get('/iletisim', 'Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}', 'Front\Homepage@category')->name('category');
Route::get('/kategori/{category}/sayfa', 'Front\Homepage@category');
Route::get('/{category}/{slug}', 'Front\Homepage@single')->name('single');
Route::get('/{sayfa}', 'Front\Homepage@page')->name('page');


