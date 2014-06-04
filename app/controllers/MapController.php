<?php

class MapController extends BaseController {

    protected $layout = 'layouts.map';

    public function index() {
        $catms = Catm::all();
        return View::make('map.index')->with('catms', $catms);
    }

    public function main() {
        return View::make('map.main')
                        ->with('catms', Catm::lists('catm_name_th', 'catm_id'));
    }

}
