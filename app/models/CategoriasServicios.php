<?php

class CategoriasServicios extends Eloquent {

	protected $table = 'categorias_servicios';
	public $timestamps = false;

	public function servicios(){
		//return $this->belongsTo('Post', 'relationships');
		//return $this->hasOne('Pasaporte', 'persona_id');
		return $this->hasMany('Servicios',"id_categoria_servicio");
	}
	

}