<?php

class CaracteristicasServicios extends Eloquent {

	protected $table = 'caracteristicas_servicios';
	public $timestamps = false;

	public function posts(){
		return $this->belongsTo('Post', 'relationships');
	}
	

}
