<?php

class ControllerDashboard extends Controller {

	public function action_index(){

		return View::make('admin.dashboard');
	}

}