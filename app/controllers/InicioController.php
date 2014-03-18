<?php

class InicioController extends BaseController {

	public function action_index(){

		$catgs_prods  = CategoriasProductos::all();
		//$categories = Category::all()->lists('name', 'id');
		return View::make('inicio.index')->with('catgs_prods', $catgs_prods);
	}
}