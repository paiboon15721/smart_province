<?php

class OtopController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $otop;

    function __construct() {
        $this->otop = new OtopClass();
    }

    public function displayOtop() {
        return View::make('content.tablecloth.otop.otop')
                        ->with('title', $this->otop->getOtopTitleForDisplay())
                        ->with('headers', $this->otop->getOtopHeaderForDisplay())
                        ->with('listOfData', $this->otop->getOtopDataForDisplay());
    }

}
