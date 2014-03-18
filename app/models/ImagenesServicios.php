<?php

class ImagenesServicios extends Eloquent {

	protected $table = 'imagenes_servicios';
	public $timestamps = false;

	public function posts(){
		return $this->belongsTo('Post', 'relationships');
	}
	

}