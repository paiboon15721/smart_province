<?php

class GroupPositionCareerController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $groupPositionCareer;

    function __construct() {
        $this->groupPositionCareer = new GroupPositionCareerClass();
    }

    public function insertGet() {
        return View::make('groupPositionCareer.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->groupPositionCareer->getMenuNameForDisplay())
                        ->with('backUrl', URL::to('groupPositionCareerTable'));
    }

    public function insertPost() {
        $this->groupPositionCareer->setPositionId(Input::get('positionId'));
        $this->groupPositionCareer->setPositionName(Input::get('positionName'));
        $this->groupPositionCareer->setPositionMember(Input::get('positionMember'));
        $this->groupPositionCareer->setPositionBudget(Input::get('positionBudget'));
        $v = $this->groupPositionCareer->validate();
        if ($v->fails()) {
            return Redirect::to('groupPositionCareerTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        $this->groupPositionCareer->insertToDatabase();
        return Redirect::to('groupPositionCareerTable/insert')
                        ->with('insertSuccess', true);
    }

    public function updateGet($positionId) {
        $this->groupPositionCareer->setPositionId($positionId);
        $groupPositionCareer = $this->groupPositionCareer->getGroupPositionCareer();
        return View::make('groupPositionCareer.update')
                        ->with('actionType', 'แก้ไข')
                        ->with('menuName', $this->groupPositionCareer->getMenuNameForDisplay())
                        ->with('groupPositionCareer', $groupPositionCareer)
                        ->with('backUrl', URL::to('groupPositionCareerTable'));
    }

    public function updatePost($positionId) {
        $this->groupPositionCareer->setPositionId($positionId);
        $this->groupPositionCareer->setPositionName(Input::get('positionName'));
        $this->groupPositionCareer->setPositionMember(Input::get('positionMember'));
        $this->groupPositionCareer->setPositionBudget(Input::get('positionBudget'));
        $v = $this->groupPositionCareer->validate();
        if ($v->fails()) {
            return Redirect::to('groupPositionCareerTable/update/' . $positionId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->groupPositionCareer->updateToDatabase();
        return Redirect::to('groupPositionCareerTable/update/' . $positionId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($positionId) {
        $this->groupPositionCareer->setPositionId($positionId);
        $this->groupPositionCareer->deleteToDatabase();
        return Redirect::to('groupPositionCareerTable')
                        ->with('deleteSuccess', true);
    }

    public function displayDatatable() {
        return View::make('groupPositionCareer.index')
                        ->with('datasourceUrl', URL::to('datasourceGroupPositionCareer'))
                        ->with('menuName', $this->groupPositionCareer->getMenuNameForDisplay())
                        ->with('url', 'groupPositionCareerTable');
    }

}
