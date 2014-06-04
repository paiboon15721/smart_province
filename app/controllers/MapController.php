<?php

class MapController extends BaseController {

    protected $layout = 'layouts.map';

    function __construct() {
        $this->catm = new CatmClass();
    }

    public function index() {
        $catms = Catm::all();
        return View::make('map.index')->with('catms', $catms);
    }

    public function main() {
        return View::make('map.main')
                        ->with('catmNameThList', $this->catm->getCatmNameThList());
    }

}
