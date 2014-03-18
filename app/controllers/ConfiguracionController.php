<?php

class ConfiguracionController extends BaseController {


	function editConfiguration($id){
		$configs  = Configuracion::where('id_configuracion', '=', $id)->first();

		return View::make('admin.configuracion.edit')->with('configs', $configs)->with('id', $id);		
	}

	
	function updateConfiguration($id){
		
		$rules = [];
		$rules = array_merge($rules, array("valor_configuracion.0"=>"required|min:1|max:100")); 
	        
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
	    	$mensaje = array('confirm' => 'Error al actualizar la configuracion, intente nuevamente.');
	        return Redirect::action('ConfiguracionController@editConfiguration', array($id))->withErrors($validation)->with($mensaje);						
	    }else{

            $data = [];
			$data = array_merge($data, array("valor_configuracion" => Input::get('valor_configuracion.0') )); 
			
            $config = Configuracion::where('id_configuracion', '=', $id)->update($data);    
            $mensaje = array('confirm' => 'Se actualizo correctamente la configuracion.');                
            return Redirect::action('ConfiguracionController@listConfiguration')->with($mensaje);			
	    }		

	}

	

	function listConfiguration(){
		$configs = Configuracion::all();
		return View::make('admin.configuracion.lista')->with('configs', $configs);	
	}

	
}