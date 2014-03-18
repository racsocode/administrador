<?php

class ServiciosController extends BaseController {


	public function action_add_categoria($id){
		$insert = array(
			'nombre_categoria' =>'Honda Civic',
			'descripcion_categoria' => 'HFU 88J',
			'imagen_categoria' => "",
			'id_parent' => 2010,
			'orden_categoria' => 2010
		);
		CategoriasServicios::create($insert);
		return View::make('servicios.categorias');
	}
	public function action_delete_categoria($id){
		$categorias_servicios = CategoriasServicios::find($id);
		$categorias_servicios->delete();		
		return View::make('servicios.categorias');
	}
	public function action_delete_lotes_categorias($id){
		$arreglo = array(2, 3, 4, 7);   
		CategoriasServicios::destroy($arreglo);			
		return View::make('servicios.categorias');
	}	
 	public function action_update_categorias(){
		$categorias_servicios = CategoriasServicios::find( $id );
		$categorias_servicios->nombre_categoria = 'MDY 00J';
		$categorias_servicios->descripcion_categoria = 'MDY 00J';
		$categorias_servicios->imagen_categoria = 'imagen.jpg';
		$categorias_servicios->id_parent = 0;
		$categorias_servicios->orden_categoria = 0;
		$categorias_servicios->save();
		return View::make('servicios.categorias');
	}

	public function action_get_categorias(){
		$campos = array(
			'id_categoria_servicio',
			'nombre_categoria',
			'descripcion_categoria',
			'imagen_categoria',
			'id_parent',
			'ruta_categoria',
			'orden_categoria'
		);		
		$catgs_servs  = CategoriasServicios::all($campos);
		return View::make('servicios.categorias')->with('catgs_servs', $catgs_servs);
	}

	public function action_get_servicios($cat){
		//$this.layout->content = View::make('servicios.lista')->with("servicios",$servicios);
		$row_cat  = CategoriasServicios::where('ruta_categoria', '=', $cat)->first();
		$id_cat=$row_cat->id_categoria_servicio;

		//if( is_null($row_cat->id_categoria_servicio) || $row_cat->id_categoria_servicio=0 ){
			//return Response::view('error', array(), 404);
		//}

		$servicios = Servicios::where('id_categoria_servicio', '=', $id_cat)->paginate(12);
		return View::make('servicios.servicios')->with("servicios",$servicios)->with("ruta_categoria",$cat);
	}
	//->where('name', '[A-Za-z]+');

	public function action_get_servicio($cat,$serv){

		$row_cat  = CategoriasServicios::where('ruta_categoria', '=', $cat)->first();
		
		if( is_null($row_cat) ){
			return Response::view('error', array(), 404);
		}else{
			$id_cat=$row_cat->id_categoria_servicio;
			$row_serv = Servicios::where('ruta_servicio', '=', $serv)->where('id_categoria_servicio', '=', $id_cat)->first();
			
			if( is_null($row_serv)){
				return Response::view('error', array(), 404);
			}else{
				$id_serv=$row_serv->id_servicio;
				$imagenes_servicios = ImagenesServicios::where('id_servicio', '=', $id_serv)->get();
				$caracteristicas = CaracteristicasServicios::where('id_servicio', '=', $id_serv)->get();
				return View::make('servicios.servicio')->with("servicio",$row_serv)->with("imagenes_servicios",$imagenes_servicios)->with("caracteristicas",$caracteristicas);
			}
		}
		return "no pasa nada";
	}




	public function adminListServicios($cat){
		$rows_cat  = CategoriasServicios::where('id_parent', '=', $cat)->orderBy('orden_categoria', 'ASC')->get();
		$rows_serv  = Servicios::where('id_categoria', '=', $cat)->orderBy('orden_servicio', 'ASC')->get();

		return View::make('admin.servicios')->with('row_cat', $row_cat);
	}

}
