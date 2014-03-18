<?php

class Servicios extends Eloquent {

	protected $table = 'servicios';
	public $timestamps = false;

	public function categoriasservicios(){
		return $this->belongsTo('CategoriasServicios', 'id_categoria_servicio');
	}
	

}