<?php

class ActivityController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $activity;

    function __construct() {
        $this->activity = new ActivityClass();
    }

    public function displayTravel() {
        return View::make('content.tablecloth.travel.travel')
                        ->with('title', $this->travel->getTravelTitleForDisplay())
                        ->with('headers', $this->travel->getTravelHeaderForDisplay())
                        ->with('listOfData', $this->travel->getTravelDataForDisplay());
    }

    public function insertGet() {
        return View::make('travel.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->travel->getMenuNameForDisplay())
                        ->with('travelTypeList', $this->travelType->getTravelTypeList())
                        ->with('backUrl', URL::to('travelTable'));
    }

    public function insertPost() {
        $this->travel->setTravelType(Input::get('travelTypeId'));
        $this->travel->setTravelName(Input::get('travelName'));
        $this->travel->setTravelStar(Input::get('travelStar'));
        $this->travel->setTravelDetail(Input::get('travelDetail'));
        $this->travel->setContractName(Input::get('contractName'));
        $this->travel->setContractTel(Input::get('contractTel'));
        $this->travel->setContractAddr(Input::get('contractAddr'));
        $this->travel->setLatitude(Input::get('latitude'));
        $this->travel->setLongtitude(Input::get('longtitude'));
        $this->travel->setTravelImage(Input::get('travelImage'));
        $v = $this->travel->validate();
        if ($v->fails()) {
            return Redirect::to('travelTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        $this->travel->insertToDatabase();
        return Redirect::to('travelTable/insert')
                        ->with('insertSuccess', true);
    }

    public function updateGet($travelId) {
        $this->travel->setTravelId($travelId);
        $travel = $this->travel->getTravel();
        return View::make('travel.update')
                        ->with('actionType', 'แก้ไข')
                        ->with('menuName', $this->travel->getMenuNameForDisplay())
                        ->with('travelTypeList', $this->travelType->getTravelTypeList())
                        ->with('travel', $travel)
                        ->with('backUrl', URL::to('travelTable'));
    }

    public function updatePost($travelId) {
        $this->travel->setTravelId($travelId);
        $this->travel->setTravelType(Input::get('travelTypeId'));
        $this->travel->setTravelName(Input::get('travelName'));
        $this->travel->setTravelStar(Input::get('travelStar'));
        $this->travel->setTravelDetail(Input::get('travelDetail'));
        $this->travel->setContractName(Input::get('contractName'));
        $this->travel->setContractTel(Input::get('contractTel'));
        $this->travel->setContractAddr(Input::get('contractAddr'));
        $this->travel->setLatitude(Input::get('latitude'));
        $this->travel->setLongtitude(Input::get('longtitude'));
        $this->travel->setTravelImage(Input::get('travelImage'));
        $v = $this->travel->validate();
        if ($v->fails()) {
            return Redirect::to('travelTable/update/' . $travelId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->travel->updateToDatabase();
        return Redirect::to('travelTable/update/' . $travelId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($travelId) {
        $this->travel->setTravelId($travelId);
        $this->travel->deleteToDatabase();
        return Redirect::to('travelTable')
                        ->with('deleteSuccess', true);
    }

    public function displayDatatable() {
        return View::make('activity.index')
                        ->with('datasourceUrl', URL::to('datasourceActivity'))
                        ->with('menuName', $this->activity->getMenuNameForDisplay())
                        ->with('url', 'activityTable');
    }

}
