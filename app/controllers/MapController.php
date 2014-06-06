<?php

class MapController extends BaseController {

    protected $layout = 'layouts.map';

    public function index() {
        $catms = Catm::all();
        return View::make('map.index')->with('catms', $catms);
    }

    public function main() {
        Session::flush();
        $catms = Catm::all();
        return View::make('map.main')
                        ->with('catmNameThList', Catm::lists('catm_name_th', 'catm_id'))
                        ->with('catms', $catms);
    }

}
