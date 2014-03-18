<?php

class ProductosController extends BaseController {
	private $_idioma;

	public function addCateg($parent=0){
		$rows_idiomas  = Idiomas::all();
		$rows_idiomas->toArray();
		return View::make('admin.productos.add-categ')->with('rows_idiomas', $rows_idiomas)->with('parent', $parent);
	}
	public function insertCateg($parent=0){
		$rows_idiomas  = Idiomas::all();
		$rows_idiomas->toArray();

		$rules = [];
		for($x = 0; $x < count($rows_idiomas); $x++){
			$rules = array_merge($rules, array("nombre_categoria.".$x=>"required|min:1|max:100")); 
			$rules = array_merge($rules, array("descripcion_categoria.".$x=>"min:2|max:100")); 
		}
			        
		$messages = array(
			'required'  => 'El campo :attribute es obligatorio.',
			'min'       => 'El campo :attribute no puede tener menos de :min carácteres.',
			'email'     => 'El campo :attribute debe ser un email válido.',
			'max'       => 'El campo :attribute no puede tener más de :min carácteres.',
			'unique'    => 'El email ingresado ya está registrado en el blog',
			'confirmed' => 'Los passwords no coinciden'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);
 
	    if ($validation->fails()){
			return Redirect::action('ProductosController@addCateg', array($parent))->with(array('confirm' => 'Error al insertar la categoria, intente nuevamente.'));			
	    }else{
			$categs_prods = new CategoriasProductos();
			$categs_prods->id_categoria = '';
			$categs_prods->original_img_categoria = 'original-no-disponible.jpg';
			$categs_prods->big_img_categoria = 'big-no-disponible.jpg';
			$categs_prods->thumb_img_categoria = 'thumb-no-disponible.jpg';
			$categs_prods->mini_thumb_img_categoria = 'mini-thumb-no-disponible.jpg';
			$categs_prods->id_parent = $parent;
			$categs_prods->orden_categoria = 1;

			$categs_prods->save();

			$id = $categs_prods->id;
			
			for($i = 0; $i < count($rows_idiomas); $i++){
				$categs_prods_idiomas = new CategoriasProductosIdiomas();
				$categs_prods_idiomas->id_categoria = $id;
				$categs_prods_idiomas->id_idioma = $rows_idiomas[$i]->id_idioma;
				$categs_prods_idiomas->nombre_categoria = Input::get("nombre_categoria.".$i);
				$categs_prods_idiomas->descripcion_categoria = Input::get("descripcion_categoria.".$i);
				$categs_prods_idiomas->save();
			}
			return Redirect::action('ProductosController@getLista', array($parent))->with(array('confirm' => 'Se insertado correctamente la categoria.'));			
	    }
	}

 	public function editCategProd($parent,$cat){
 		//$data2 = DB::table('users')->where('correoinstitucional', $data)->first();

 		if($cat>0){
			$row_cat  = CategoriasProductos::where('id_categoria', '=', $cat)->first();
			$imagen = $row_cat->imagen_categoria;			

			$cats_idioma  = CategoriasProductosIdiomas::where('id_categoria', '=', $cat)->get();
			$cats_idioma->toArray();

			foreach($cats_idioma as $cat_idioma){
				$contenido_idiomas[$cat_idioma->id_idioma] = array(
					'nombre' => $cat_idioma->nombre_categoria,
					'descripcion' => $cat_idioma->descripcion_categoria
				);				
			}		

	 		$rows_idiomas  = Idiomas::all();

			return View::make('admin.productos.edit-categ')->with('rows_idiomas', $rows_idiomas)->with('contenido', $contenido_idiomas)->with('imagen', $imagen)->with('cat', $cat)->with('parent', $parent);
 		}else{
 			return Response::view('error', array(), 404);
 		}
	}

 	public function updateCategProd($parent,$cat){
		$rows_idiomas  = Idiomas::all();

		$rules = [];
		for($x = 0; $x < count($rows_idiomas); $x++){
			$rules = array_merge($rules, array("nombre_categoria.".$x=>"required|min:1|max:100")); 
			$rules = array_merge($rules, array("descripcion_categoria.".$x=>"min:2|max:100")); 
		}
	        
		$messages = array(
			'required'  => 'El campo :attribute es obligatorio.',
			'min'       => 'El campo :attribute no puede tener menos de :min carácteres.',
			'email'     => 'El campo :attribute debe ser un email válido.',
			'max'       => 'El campo :attribute no puede tener más de :min carácteres.',
			'unique'    => 'El email ingresado ya está registrado en el blog',
			'confirmed' => 'Los passwords no coinciden'
		);
		
		$validation = Validator::make(Input::all(), $rules, $messages);
 
	    if ($validation->fails()){
	    	$mensaje = array('confirm' => 'Error al actualizar la categoria, intente nuevamente.');
	        return Redirect::action('ProductosController@editCategProd', array($parent,$cat))->withErrors($validation)->with($mensaje);						
	    }else{

            $data = [];
			for($i = 0; $i < count($rows_idiomas); $i++){
				$data = array_merge($data, array("id_categoria" => $cat )); 
				$data = array_merge($data, array("id_idioma" => $rows_idiomas[$i]->id_idioma)); 
				$data = array_merge($data, array("nombre_categoria" => Input::get('nombre_categoria.'.$i) )); 
				$data = array_merge($data, array("descripcion_categoria" => Input::get("descripcion_categoria.".$i))); 
			}
            $cats_idioma = CategoriasProductosIdiomas::where('id_idioma', '=', 1)->where('id_categoria', '=', $cat)->update($data);                    
            return Redirect::action('ProductosController@getLista', array($parent))->with(array('confirm' => 'Se actualizo correctamente la categoria.'));			
	    }
	}	

	public function deleteCateg($parent,$cat){
		$affected_row_cat  = CategoriasProductos::where('id_categoria', '=', $cat)->delete();
		$affectedRows = CategoriasProductosIdiomas::where('id_categoria', '=', $cat)->delete();

		if($affected_row_cat && $affectedRows){
			return Redirect::action('ProductosController@getLista', array($parent))->with(array('confirm' => 'Se elimino correctamente la categoria.'));
		}else{
			return Redirect::action('ProductosController@getLista', array($parent))->with(array('confirm' => 'Error al eliminar la categoria, intente nuevamente.'));			
		}
	}


	public function getImgCateg($cat){
		//ImageProcess::prueba();
 		if($cat>0){
			$rows_cat  = CategoriasProductos::where('id_categoria', '=', $cat)->get();
			$rows_cat->toArray();
			return View::make('admin.productos.img-categ-prod')->with('cat', $cat)->with('rows_cat', $rows_cat);
 		}else{
 			return Response::view('error', array(), 404);
 		}

	}


	public function postImgCateg($cat){



    }

	public function getEditImgCateg($cat){
		//ImageProcess::prueba();
 		if($cat>0){
			$row_cat  = CategoriasProductos::where('id_categoria', '=', $cat)->first();
			$row_cat->toArray();
			$imagen = $row_cat["original_img_categoria"];		

			return View::make('admin.productos.edit-catg-img')->with('cat', $cat)->with('imagen', $imagen);
 		}else{
 			return Response::view('error', array(), 404);
 		}

	}

	public function postEditImgCateg($cat){
	    $success = "ERROR";
	    $message = "ERROR";
	    $baseurl =  BaseUrl::get_base_url();
	    $url_parent = action('ProductosController@getImgCateg', $cat);

		$path = BaseUrl::get_base_url()."/img/uploads/";

	    if(Request::ajax()){	
			$result = Tools::valida_imagen("archivo0","original");

			if($result["message"]=="OK"){
				$success = $result["success"];
			}
			if($result["success"]=="ERROR"){
				$row_cat  = CategoriasProductos::where('id_categoria', '=', $cat)->first()->toArray();
				$success = $row_cat["original_img_categoria"];
			}
			$message = $result["message"];

			if ( isset($_POST["x1"])  ) {

				$img_big = $_POST["img_big"];
				$x1 = $_POST["x1"];
				$y1 = $_POST["y1"];
				$x2 = $_POST["x2"];
				$y2 = $_POST["y2"];
				$w = $_POST["w"];
				$h = $_POST["h"];

				$img_big = $path.$img_big; 
				$pieces = explode("/", $img_big);
				$imagen_original = $pieces[count($pieces)-1];

				$extension = pathinfo($img_big, PATHINFO_EXTENSION);
				$imagen_big = "big-".date("ymdhis").$extension;
				$imagen_thumb = "thumb-".date("ymdhis").$extension;
				$imagen_mini_thumb = "mini-thumb-".date("ymdhis").$extension;


				$scale_big = 400/$w;
				$crop_big = ImageProcess::resizeThumbnailImage(public_path()."/img/uploads/".$imagen_big, $img_big,$w,$h,$x1,$y1,$scale_big);
				$scale_thumb = 250/$w;
				$crop_thumb = ImageProcess::resizeThumbnailImage(public_path()."/img/uploads/".$imagen_thumb, $img_big,$w,$h,$x1,$y1,$scale_thumb);
				$scale_mini_thumb = 100/$w;
				$crop_mini_thumb = ImageProcess::resizeThumbnailImage(public_path()."/img/uploads/".$imagen_mini_thumb, $img_big,$w,$h,$x1,$y1,$scale_mini_thumb);

				$data = array('original_img_categoria' => $imagen_original,'big_img_categoria' => $imagen_big,'thumb_img_categoria' => $imagen_thumb,'mini_thumb_img_categoria' => $imagen_mini_thumb);
				
				$affected_row_cat = CategoriasProductos::where('id_categoria', '=', $cat)->update($data);

				if($affected_row_cat){
					$success = $path.$imagen_big;
					$message = 'Imagen cargada y guadada satisfatoriamente.';
				}else{
					$message = 'Error actualizar la imagen en la base de datos.';
				}	

			}
	    }else{
	    	$success = "NO IMG";
	 		$message = "No es una peticion ajax."; 
	    }
		

		return Response::json(array(
		    'success' 		=> 	$success,
		    'message' 		=> 	$message,
		    'baseurl' 		=> 	$baseurl,
			'url_parent' 	=> 	$url_parent
		));	
    }


	public function ordenarCatProdAjax(){
	/*	foreach($_GET['list_item'] as $position => $item){
			$type_val = explode("|",$item);

			if($type_val[1] == 'cat'){
				$objc  = new Categoria($type_val[0], $this->_idioma);
				$query = new Consulta("UPDATE  categorias SET orden_categoria = $position 
											WHERE id_categoria = $type_val[0] AND id_parent = '".$objc->__get("_parent")."'"); 	
			}else{
				$obju  = new Producto($type_val[0], $this->_idioma);
				$query = new Consulta("UPDATE  productos SET orden_producto = $position 
											WHERE id_producto = $type_val[0] 
											AND id_categoria = '".$obju->__get("_categoria")->__get("_id")."'"); 
			}
		}*/
	}



	public function addProd($parent){
		//$row_idioma  = Idiomas::where('id_idioma', '=', 1)->first();
		$rows_idiomas  = Idiomas::all();
		$rows_idiomas->toArray();
		return View::make('admin.productos.add-prod')->with('rows_idiomas', $rows_idiomas)->with('parent', $parent);
	}
	public function insertProd($parent){
		$rows_idiomas  = Idiomas::all();
		$rows_idiomas->toArray();

		$rules = [];
		for($x = 0; $x < count($rows_idiomas); $x++){
			$rules = array_merge($rules, array("nombre_producto.".$x=>"required|min:1|max:100")); 
			$rules = array_merge($rules, array("descripcion_producto.".$x=>"min:10|max:350")); 
			$rules = array_merge($rules, array("preparacion_producto.".$x=>"min:10|max:1000")); 
		}
			        
		$messages = array(
			'required'  => 'El campo :attribute es obligatorio.',
			'min'       => 'El campo :attribute no puede tener menos de :min carácteres.',
			'email'     => 'El campo :attribute debe ser un email válido.',
			'max'       => 'El campo :attribute no puede tener más de :min carácteres.',
			'unique'    => 'El email ingresado ya está registrado en el blog',
			'confirmed' => 'Los passwords no coinciden'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);
 
	    if ($validation->fails()){
	    	$mensaje = array('confirm' => 'Error al insertar el producto, intente nuevamente.');
			return Redirect::action('ProductosController@addProd', array($parent))->withErrors($validation)->with($mensaje);			
	    }else{
			$new_prod = new Productos();
			$new_prod->id_producto = '';
			$new_prod->id_categoria = $parent;

			if (Input::has('novedad_producto') == 1) {
				$new_prod->novedad_producto = 1;
			}else if(Input::has('novedad_producto') == 0){
				$new_prod->novedad_producto = 0;
			}
			if (Input::has('destacado_producto') == 1) {
				$new_prod->destacado_producto = 1;
			}else if(Input::has('destacado_producto') == 0){
				$new_prod->destacado_producto = 0;
			}
			if (Input::has('disponibilidad_producto') == 1) {
				$new_prod->disponibilidad_producto = 1;
			}else if(Input::has('disponibilidad_producto') == 0){
				$new_prod->disponibilidad_producto = 0;
			}

			$new_prod->orden_producto = 1;
			$new_prod->save();

			$id = $new_prod->id;


			$new_prod_img = new ImagenesProductos();
			$new_prod_img->id_producto = $id;
			$new_prod_img->original_img_producto = "original-no-disponible.jpg";
			$new_prod_img->big_img_producto = "big-no-disponible.jpg";
			$new_prod_img->thumb_img_producto = "thumb-no-disponible.jpg";
			$new_prod_img->mini_thumb_img_categoria = "mini-thumb-no-disponible.jpg";
			$new_prod_img->orden_imagen = 1;
			$new_prod_img->save();


			
			for($i = 0; $i < count($rows_idiomas); $i++){
				$prods_idiomas = new ProductosIdiomas();
				$prods_idiomas->id_producto = $id;
				$prods_idiomas->id_idioma = $rows_idiomas[$i]->id_idioma;
				$prods_idiomas->nombre_producto = Input::get("nombre_producto.".$i);
				$prods_idiomas->descripcion_producto = Input::get("descripcion_producto.".$i);
				$prods_idiomas->preparacion_producto = Input::get("preparacion_producto.".$i);
				$prods_idiomas->save();
			}
			return Redirect::action('ProductosController@getLista', array($parent))->with(array('confirm' => 'Se insertado correctamente el producto.'));			
	    }
	}

 	public function editProd($parent,$prod){
 		$row_idioma  = Idiomas::where('id_idioma', '=', 1)->first();

 		if($prod>0){		

			$prods  = Productos::where('id_producto', '=', $prod)->orderBy('orden_producto', 'ASC')->first();

			//$prods->toArray();

			$prods_idioma  = ProductosIdiomas::where('id_producto', '=', $prod)->get();
			$prods_idioma->toArray();


			foreach($prods_idioma as $prod_idioma){
				$contenido_idiomas[$prod_idioma->id_idioma] = array(
					'nombre' => $prod_idioma->nombre_producto,
					'descripcion' => $prod_idioma->descripcion_producto,
					'preparacion' => $prod_idioma->preparacion_producto
				);				
			}		

	 		$rows_idiomas  = Idiomas::all();

			return View::make('admin.productos.edit-prod')->with('rows_idiomas', $rows_idiomas)->with('prods', $prods)->with('contenido', $contenido_idiomas)->with('parent', $parent)->with('prod', $prod);
 		}else{
 			return Response::view('error', array(), 404);
 		}		
	}

 	public function updateProd($parent,$prod){
		$rows_idiomas  = Idiomas::all();

		$rules = [];
		for($x = 0; $x < count($rows_idiomas); $x++){
			$rules = array_merge($rules, array("nombre_producto.".$x=>"required|min:1|max:100")); 
			$rules = array_merge($rules, array("descripcion_producto.".$x=>"min:2|max:100")); 
			$rules = array_merge($rules, array("preparacion_producto.".$x=>"min:2|max:300")); 
		}
	        
		$messages = array(
			'required'  => 'El campo :attribute es obligatorio.',
			'min'       => 'El campo :attribute no puede tener menos de :min carácteres.',
			'email'     => 'El campo :attribute debe ser un email válido.',
			'max'       => 'El campo :attribute no puede tener más de :min carácteres.',
			'unique'    => 'El email ingresado ya está registrado en el blog',
			'confirmed' => 'Los passwords no coinciden'
		);
		
		$validation = Validator::make(Input::all(), $rules, $messages);
 
	    if ($validation->fails()){
	    	$mensaje = array('confirm' => 'Error al actualizar la categoria, intente nuevamente.');
	        return Redirect::action('ProductosController@editProd', array($parent,$prod))->withErrors($validation)->with($mensaje);						
	    }else{
	    	$atributos = [];
	    	$atributos = array_merge($atributos, array("id_producto" => $prod )); 

			if (Input::has('novedad_producto') == 1) {
				$atributos = array_merge($atributos, array("novedad_producto" => 1 )); 
			}else if(Input::has('novedad_producto') == 0){
				$atributos = array_merge($atributos, array("novedad_producto" => 0 )); 
			}

			if (Input::has('destacado_producto') == 1) {
				$atributos = array_merge($atributos, array("destacado_producto" => 1 )); 
			}else if(Input::has('destacado_producto') == 0){
				$atributos = array_merge($atributos, array("destacado_producto" => 0 )); 
			}
			
			if (Input::has('disponibilidad_producto') == 1) {
				$atributos = array_merge($atributos, array("disponibilidad_producto" => 1 )); 
			}else if(Input::has('disponibilidad_producto') == 0){
				$atributos = array_merge($atributos, array("disponibilidad_producto" => 0 )); 
			}

			$prods  = Productos::where('id_producto', '=', $prod)->update($atributos);

            $data = [];
			for($i = 0; $i < count($rows_idiomas); $i++){
				$data = array_merge($data, array("id_producto" => $prod )); 
				$data = array_merge($data, array("id_idioma" => $rows_idiomas[$i]->id_idioma)); 
				$data = array_merge($data, array("nombre_producto" => Input::get('nombre_producto.'.$i) )); 
				$data = array_merge($data, array("descripcion_producto" => Input::get("descripcion_producto.".$i))); 
				$data = array_merge($data, array("preparacion_producto" => Input::get("preparacion_producto.".$i))); 
			}
            $cats_idioma = ProductosIdiomas::where('id_idioma', '=', 1)->where('id_producto', '=', $prod)->update($data);     
            $mensaje = array('confirm' => 'Se actualizo correctamente el producto.  ' );
            return Redirect::action('ProductosController@getLista', array($parent))->with($mensaje);			
	    }
	}	


 	public function deleteProd($parent,$prod){
		$affected_row_prod  = Productos::where('id_producto', '=', $prod)->delete();
		$affectedRows = ProductosIdiomas::where('id_producto', '=', $prod)->delete();
		$affected_img_Rows = ImagenesProductos::where('id_producto', '=', $prod)->delete();


		if($affected_row_prod && $affectedRows && $affected_img_Rows){
			return Redirect::action('ProductosController@getLista', array($parent))->with(array('confirm' => 'Se elimino correctamente el producto.'));
		}else{
			return Redirect::action('ProductosController@getLista', array($parent))->with(array('confirm' => 'Error al eliminar el producto, intente nuevamente.'));			
		}
	}


	public function getImgProd($cat,$prod){
		//ImageProcess::prueba();
 		if($prod>0){
			$imgs  = ImagenesProductos::where('id_producto', '=', $prod)->get();
			$imgs->toArray();
			return View::make('admin.productos.img-prod')->with('prod', $prod)->with('imgs', $imgs)->with('cat', $cat);
 		}else{
 			return Response::view('error', array(), 404);
 		}
	}
		public function getAgregarImgProd($parent,$prod=0){
			return View::make('admin.productos.add-prod-img')->with('parent', $parent)->with('prod', $prod);
		}

		public function postAgregarImgProd($parent,$prod){
		    $success = "ERROR";
		    $message = "ERROR";
		    $baseurl =  BaseUrl::get_base_url();
		    $url_parent = action('ProductosController@getImgProd', array($parent,$prod));

			$path = BaseUrl::get_base_url()."/img/uploads/";

		    if(Request::ajax()){	
				$result = Tools::valida_imagen("archivo0","original");

				if($result["message"]=="OK"){
					$success = $result["success"];
				}

				$message = $result["message"];

				if ( isset($_POST["x1"])  ) {

					$img_big = $_POST["img_big"];
					$x1 = $_POST["x1"];
					$y1 = $_POST["y1"];
					$x2 = $_POST["x2"];
					$y2 = $_POST["y2"];
					$w = $_POST["w"];
					$h = $_POST["h"];

					$img_big = $path.$img_big; 
					$pieces = explode("/", $img_big);
					$imagen_original = $pieces[count($pieces)-1];

					$new_prod_img = new ImagenesProductos();
					$new_prod_img->id_producto = $prod;
					$new_prod_img->original_img_producto = $imagen_original;
					$new_prod_img->big_img_producto = $imagen_big;
					$new_prod_img->thumb_img_producto = $imagen_thumb;
					$new_prod_img->mini_thumb_img_categoria = $imagen_mini_thumb;
					$new_prod_img->x1 = $x1;
					$new_prod_img->y1 = $y1;
					$new_prod_img->x2 = $x2;
					$new_prod_img->y2 = $y2;
					$new_prod_img->orden_imagen = 1;
					$new_prod_img->save();

					if($new_prod_img){
						$success = $path.$imagen_big;
						$message = 'Imagen cargada y guadada satisfatoriamente.';
					}else{
						$message = 'Error actualizar la imagen en la base de datos.';
					}	

				}
		    }else{
		    	$success = "NO IMG";
		 		$message = "No es una peticion ajax."; 
		    }
			

			return Response::json(array(
			    'success' 		=> 	$success,
			    'message' 		=> 	$message,
			    'baseurl' 		=> 	$baseurl,
				'url_parent' 	=> 	$url_parent
			));	

		}



		public function getEditImgProd($parent,$prod,$id_img){
			$img  = ImagenesProductos::where('id_producto_imagen', '=', $id_img)->first();
			$img->toArray();
			return View::make('admin.productos.edit-prod-img')->with('cat', $parent)->with('prod', $prod)->with('img', $img);
		}

		public function postEditImgProd($cat,$prod,$id_img){
		    $success = "ERROR";
		    $message = "ERROR";
		    $baseurl =  BaseUrl::get_base_url();
		    $url_parent = action('ProductosController@getImgProd', array($cat,$prod) );

			$path = BaseUrl::get_base_url()."/img/uploads/";

		    if(Request::ajax()){	
				$result = Tools::valida_imagen("archivo0","original");

				if($result["message"]=="OK"){
					$success = $result["success"];
				}

				$message = $result["message"];

				if ( isset($_POST["x1"])  ) {

					$img_big = $_POST["img_big"];
					$x1 = $_POST["x1"];
					$y1 = $_POST["y1"];
					$x2 = $_POST["x2"];
					$y2 = $_POST["y2"];
					$w = $_POST["w"];
					$h = $_POST["h"];

					$img_big = $path.$img_big; 
					$pieces = explode("/", $img_big);
					$imagen_original = $pieces[count($pieces)-1];

					$extension = pathinfo($img_big, PATHINFO_EXTENSION);
					$imagen_big = "big-".date("ymdhis").".".$extension;
					$imagen_thumb = "thumb-".date("ymdhis").".".$extension;
					$imagen_mini_thumb = "mini-thumb-".date("ymdhis").".".$extension;


					$scale_big = 400/$w;
					$crop_big = ImageProcess::resizeThumbnailImage(public_path()."/img/uploads/".$imagen_big, $img_big,$w,$h,$x1,$y1,$scale_big);
					$scale_thumb = 250/$w;
					$crop_thumb = ImageProcess::resizeThumbnailImage(public_path()."/img/uploads/".$imagen_thumb, $img_big,$w,$h,$x1,$y1,$scale_thumb);
					$scale_mini_thumb = 100/$w;
					$crop_mini_thumb = ImageProcess::resizeThumbnailImage(public_path()."/img/uploads/".$imagen_mini_thumb, $img_big,$w,$h,$x1,$y1,$scale_mini_thumb);

					$data = array('original_img_producto' => $imagen_original,'big_img_producto' => $imagen_big,'thumb_img_producto' => $imagen_thumb,'mini_thumb_img_categoria' => $imagen_mini_thumb,'x1' => $x1,'y1' => $y1,'x2' => $x2,'y2' => $y2);
					
					$affected_row_prod = ImagenesProductos::where('id_producto_imagen', '=', $id_img)->update($data);

					if($affected_row_prod){
						$success = $path.$imagen_big;
						$message = 'Imagen cargada y guadada satisfatoriamente.';
					}else{
						$message = 'Error actualizar la imagen en la base de datos.';
					}	

				}
		    }else{
		    	$success = "NO IMG";
		 		$message = "No es una peticion ajax."; 
		    }
			

			return Response::json(array(
			    'success' 		=> 	$success,
			    'message' 		=> 	$message,
			    'baseurl' 		=> 	$baseurl,
				'url_parent' 	=> 	$url_parent
			));	
	    }

	 	public function deleteImgProd($parent,$prod,$id_img){
			$affected_img_Rows = ImagenesProductos::where('id_producto_imagen', '=', $id_img)->delete();
			if($affected_img_Rows){
				$mensaje = array('confirm' => 'Se elimino correctamente la imagen.' );
			}else{
				$mensaje = array('confirm' => 'Error al eliminar la imagen, intente nuevamente.' );
			}
			return Redirect::action('ProductosController@getImgProd', array($parent,$prod))->with($mensaje);			
		}



	private $prods,$cats;

	public function getLista($parent){
		$rows_cat  = CategoriasProductos::where('id_parent', '=', $parent)->orderBy('orden_categoria', 'ASC')->get();
		$rows_cat->toArray();


		foreach($rows_cat as $row_cat){
			$cat_idioma  = CategoriasProductosIdiomas::where('id_idioma', '=', 1)->where('id_categoria', '=', $row_cat->id_categoria)->first();
			
			$this->cats[] = array(
				'id_categoria' 		=> $row_cat->id_categoria,
				'id_idioma' 		=> $cat_idioma['id_idioma'],
				'nombre_categoria' 	=> $cat_idioma['nombre_categoria'],
				'id_parent' 		=> $row_cat->id_parent,
				'orden_categoria' 	=> $row_cat->orden_categoria,
			);
		}		


		$rows_prods  = Productos::where('id_categoria', '=', $parent)->orderBy('orden_producto', 'ASC')->get();
		$rows_prods->toArray();

		foreach($rows_prods as $row_prod){
			$prod_idioma  = ProductosIdiomas::where('id_idioma', '=', 1)->where('id_producto', '=', $row_prod->id_producto)->first();
			$prod_idioma->toArray();
			
			$this->prods[] = array(
				'id_producto' 			  => $row_prod->id_producto,
				'id_categoria' 			  => $row_prod->id_categoria,
				'nombre_producto' 		  => $prod_idioma->nombre_producto,
				'descripcion_producto' 	  => $prod_idioma->descripcion_producto,
				'preparacion_producto' 	  => $prod_idioma->preparacion_producto,
				'novedad_producto' 		  => $row_prod->novedad_producto,
				'destacado_producto'  	  => $row_prod->destacado_producto,
				'disponibilidad_producto' => $row_prod->disponibilidad_producto,
				'orden_producto' 		  => $row_prod->orden_producto
			);
		}	
		return View::make('admin.productos.lista')->with('cats', $this->cats)->with('prods', $this->prods)->with('parent', $parent);
 				
	}	

	

}
