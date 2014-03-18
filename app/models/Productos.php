<?php

class Productos extends Eloquent {

	protected $table = 'productos';
	public $timestamps = false;

	public function productos(){
		//return $this->belongsTo('Post', 'relationships');
		//return $this->hasOne('Pasaporte', 'persona_id');
		//return $this->hasMany('Productos',"id_categoria_servicio");
	}
	

}