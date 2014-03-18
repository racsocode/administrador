<?php

class UsuariosController extends BaseController {

	public function listAction(){
		return View::make('admin.usuarios.list');
	}

	public function addAction(){
		return View::make('admin.usuarios.list');
	}

}