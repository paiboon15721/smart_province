<?php

class MapController extends BaseController {
		
	protected $layout = 'layouts.map';
	
	public function index() {
		$catms = Catm::all();
		return View::make('map.index')->with('catms', $catms);
	}		
}
	