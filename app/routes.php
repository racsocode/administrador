<?php
//Route::pattern('id_categoria_servicio', '[0-9]+');

Route::get("/","InicioController@action_index");
Route::get('/nosotros', 'NosotrosController@action_index');
Route::get("/categorias-servicios","ProductosController@action_categorias");

Route::get('/productos', array('as' => 'get_categorias', 'uses' => 'ProductosController@action_get_categorias'));
Route::get('/productos/{cat}', array('as' => 'get_servicios', 'uses' => 'ProductosController@action_get_servicios'));
Route::get('/productos/{cat}/{serv}', array('as' => 'get_servicio', 'uses' => 'ProductosController@action_get_servicio'));



Route::get("/tutoriales","TutorialesController@action_index");
Route::get("/contactar","ContactarController@action_index");




Route::get('/login', function(){
  /*  $user = new User;
    $user->id_rol = 3;//admin
    $user->nombres_usuario = "oscar javier";
    $user->apellidos_usuario = "rodriguez villanueva";
    $user->username = "picatrons@gmail.com";
    $user->password = Hash::make("123456");
    $user->estado = 1;
    $user->save(); */

    if (Auth::check()){
      return Redirect::to('/admin/productos/1');
    }
    return View::make('admin.loging');
});

Route::post('/login', function(){

  $userdata = array(
    'username' => Input::get("email"), 
    'password' => Input::get("password"), 
    'estado' => 1
  );

 // if (Auth::loginUsingId(1)) {
  if (Auth::attempt($userdata)) {
    return Redirect::to('admin/productos/1')->with('message', 'You are now logged in!');
  }else{
    return Redirect::to('login')
        ->with('message', 'Tu correo/contraseña combinacion es incorrecta.')
        ->withInput();
  }  

});


Route::get('logout', array('as' => 'logout', function () {
    Auth::logout();

    return Redirect::route('home')
        ->with('flash_notice', 'You are successfully logged out.');
}))->before('auth');



//Route::group(array('prefix' => 'admin', 'before' => 'auth'), function(){
Route::group(array('prefix' => 'admin'), function(){  

  
  Route::get("/index","ControllerDashboard@action_index");

  Route::get('/configuracion', 'ConfiguracionController@listConfiguration');
  Route::get('/configuracion/edit/{id}/', 'ConfiguracionController@editConfiguration');
  Route::post('/configuracion/edit/{id}/', 'ConfiguracionController@updateConfiguration');

  Route::get('/usuarios', 'UsuariosController@listAction');
  Route::get('/usuarios/agregar', 'UsuariosController@addAction');


  Route::get('/productos/{parent_cat}', 'ProductosController@getLista');
    Route::get('/productos/add-cat/{parent}', 'ProductosController@addCateg');
    Route::post('/productos/add-cat/{parent}','ProductosController@insertCateg');
    
    Route::get('/productos/edit-cat/{parent}/{cat}' , 'ProductosController@editCategProd');
    Route::post('/productos/edit-cat/{parent}/{cat}' , 'ProductosController@updateCategProd');

    Route::get('/productos/delete-cat/{parent}/{cat}', 'ProductosController@deleteCateg');

    Route::get('/productos/categoria-imagenes/{cat}', 'ProductosController@getImgCateg');
    Route::post('/productos/categoria-imagenes/{cat}', 'ProductosController@postImgCateg');
      Route::get('/productos/categoria-imagenes/edit/{cat}', 'ProductosController@getEditImgCateg');
      Route::post('/productos/categoria-imagenes/edit/{cat}','ProductosController@postEditImgCateg');


  Route::get('/productos/add/{prod}', 'ProductosController@addProd');  
  Route::post('/productos/add/{prod}', 'ProductosController@insertProd');   
  Route::get('/productos/edit/{parent}/{prod}' , 'ProductosController@editProd');
  Route::post('/productos/edit/{parent}/{prod}' , 'ProductosController@updateProd');  
  Route::get('/productos/delete/{parent}/{prod}', 'ProductosController@deleteProd');

  Route::get('/productos/imagenes/{parent}/{prod}', 'ProductosController@getImgProd');
    Route::get('/productos/agregar-imagenes/{parent}/{prod}', 'ProductosController@getAgregarImgProd');
    Route::post('/productos/agregar-imagenes/{parent}/{prod}','ProductosController@postAgregarImgProd');    

    Route::get('/productos/edit-imagenes/{parent}/{prod}/{id_img}', 'ProductosController@getEditImgProd');
    Route::post('/productos/edit-imagenes/{parent}/{prod}/{id_img}','ProductosController@postEditImgProd');  
  
    Route::get('/productos/eliminar-imagen/{parent}/{prod}/{id_img}', 'ProductosController@deleteImgProd');

});


/*
Route::get('work/(:any)', function($slug){

  list($id, $title) = preg_split('/-/', $slug, 2);

  $portfoliopost = Portfoliopost::find($id);

  if ( is_null($portfoliopost) || Str::slug($portfoliopost->portfoliotitle) !== $title ){
    return Response::error(404);
  }
   return $slug;
  //return View::make('home.work')->with('portfoliopost', $portfoliopost);
});


Route::get('servicios/{id_cat}/{name}', function($id, $name){
    
})
Route::post('servicios/(:num)/(:any)', function ($courseid, $slug) {
    $course = Course::where('id', '=', $courseid)->get();
    return View::make('courses.show')->with('course', $course);
    return View::make('servicios.categorias')->with('catgs_servs', $catgs_servs);
}
*/

Route::get('/current/url', function(){
    //return URL::current();
   // return URL::previous();
    //return Redirect::to('second');
    return URL::full();
});



App::missing(function($exception){
	return Response::view('error', array(), 404);
});
