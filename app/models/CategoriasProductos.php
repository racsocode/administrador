<?php

class CategoriasProductos extends Eloquent {

	protected $table = 'categorias_productos';
	public $timestamps = false;

	public function categoriasProductos(){
		//return $this->belongsTo('Post', 'relationships');
		//return $this->hasOne('Pasaporte', 'persona_id');
		//return $this->hasMany('Servicios',"id_categoria_servicio");
	}
	

}