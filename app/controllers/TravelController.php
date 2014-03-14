<?php

class TravelController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $travel;

    function __construct() {
        $this->travel = new TravelClass();
    }

    public function displayTravel() {
        return View::make('content.tablecloth.travel.travel')
                        ->with('title', $this->travel->getTravelTitleForDisplay())
                        ->with('headers', $this->travel->getTravelHeaderForDisplay())
                        ->with('listOfData', $this->travel->getTravelDataForDisplay());
    }

}
