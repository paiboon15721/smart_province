<?php

class OtopController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $otop;
    private $otopType;

    function __construct() {
        $this->otop = new OtopClass();
        $this->otopType = new OtopTypeClass();
    }

    public function displayOtop() {
        return View::make('content.tablecloth.otop.otop')
                        ->with('title', $this->otop->getOtopTitleForDisplay())
                        ->with('headers', $this->otop->getOtopHeaderForDisplay())
                        ->with('listOfData', $this->otop->getOtopDataForDisplay());
    }

    public function insertGet() {
        return View::make('otop.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->otop->getMenuNameForDisplay())
                        ->with('otopTypeList', $this->otopType->getOtopTypeList())
                        ->with('backUrl', URL::to('otopTable'));
    }

    public function insertPost() {
        $this->otop->setOtopType(Input::get('otopTypeId'));
        $this->otop->setOtopName(Input::get('otopName'));
        $this->otop->setOtopGroup(Input::get('otopGroup'));
        $this->otop->setOtopStar(Input::get('otopStar'));
        $this->otop->setOtopDetail(Input::get('otopDetail'));
        $this->otop->setContractName(Input::get('contractName'));
        $this->otop->setContractTel(Input::get('contractTel'));
        $this->otop->setContractAddr(Input::get('contractAddr'));
        $this->otop->setOtopImage(Input::get('otopImage'));
        $v = $this->otop->validate();
        if ($v->fails()) {
            return Redirect::to('otopTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        $this->otop->insertToDatabase();
        return Redirect::to('otopTable/insert')
                        ->with('insertSuccess', true);
    }

    public function updateGet($otopId) {
        $this->otop->setOtopId($otopId);
        $otop = $this->otop->getOtop();
        return View::make('otop.update')
                        ->with('actionType', 'แก้ไข')
                        ->with('menuName', $this->otop->getMenuNameForDisplay())
                        ->with('otopTypeList', $this->otopType->getOtopTypeList())
                        ->with('otop', $otop)
                        ->with('backUrl', URL::to('otopTable'));
    }

    public function updatePost($otopId) {
        $this->otop->setOtopId($otopId);
        $this->otop->setOtopType(Input::get('otopTypeId'));
        $this->otop->setOtopName(Input::get('otopName'));
        $this->otop->setOtopGroup(Input::get('otopGroup'));
        $this->otop->setOtopStar(Input::get('otopStar'));
        $this->otop->setOtopDetail(Input::get('otopDetail'));
        $this->otop->setContractName(Input::get('contractName'));
        $this->otop->setContractTel(Input::get('contractTel'));
        $this->otop->setContractAddr(Input::get('contractAddr'));
        $this->otop->setOtopImage(Input::get('otopImage'));
        $v = $this->otop->validate();
        if ($v->fails()) {
            return Redirect::to('otopTable/update/' . $otopId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->otop->updateToDatabase();
        return Redirect::to('otopTable/update/' . $otopId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($otopId) {
        $this->otop->setOtopId($otopId);
        $this->otop->deleteToDatabase();
        return Redirect::to('otopTable')
                        ->with('deleteSuccess', true);
    }

    public function displayDatatable() {
        return View::make('otop.index')
                        ->with('datasourceUrl', URL::to('datasourceOtop'))
                        ->with('menuName', $this->otop->getMenuNameForDisplay())
                        ->with('url', 'otopTable');
    }

}
