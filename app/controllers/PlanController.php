<?php

class PlanController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $plan;

    function __construct() {
        $this->plan = new PlanClass();
    }

    public function displayTravel() {
        return View::make('content.tablecloth.travel.travel')
                        ->with('title', $this->travel->getTravelTitleForDisplay())
                        ->with('headers', $this->travel->getTravelHeaderForDisplay())
                        ->with('listOfData', $this->travel->getTravelDataForDisplay());
    }

    public function insertGet() {
        return View::make('plan.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->plan->getMenuNameForDisplay())
                        ->with('backUrl', URL::to('planTable'));
    }

    public function insertPost() {
        $this->plan->setPlanName(Input::get('planName'));
        $this->plan->setPlanType(Input::get('planType'));
        $this->plan->setPlanDate(Input::get('planDate'));
        $this->plan->setPlanSize(Input::get('planSize'));
        $this->plan->setPlanBudget(Input::get('planBudget'));
        $this->plan->setPlanHead(Input::get('planHead'));
        $this->plan->setPlanBudgetResource(Input::get('planBudgetResource'));
        $this->plan->setPlanStartYear(Input::get('planStartYear'));
        $this->plan->setPlanEndYear(Input::get('planEndYear'));
        $this->plan->setPlanStatus(Input::get('planStatus'));
        $this->plan->setPlanImage(Input::file('planImage'));
        $v = $this->plan->validate();
        if ($v->fails()) {
            return Redirect::to('planTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        $this->plan->insertToDatabase();
        return Redirect::to('planTable/insert')
                        ->with('insertSuccess', true);
    }

    public function updateGet($planId) {
        $this->plan->setPlanId($planId);
        $plan = $this->plan->getPlan();
        return View::make('plan.update')
                        ->with('actionType', 'แก้ไข')
                        ->with('menuName', $this->plan->getMenuNameForDisplay())
                        ->with('plan', $plan)
                        ->with('backUrl', URL::to('planTable'));
    }

    public function updatePost($planId) {
        $this->plan->setPlanId($planId);
        $this->plan->setPlanName(Input::get('planName'));
        $this->plan->setPlanType(Input::get('planType'));
        $this->plan->setPlanDate(Input::get('planDate'));
        $this->plan->setPlanSize(Input::get('planSize'));
        $this->plan->setPlanBudget(Input::get('planBudget'));
        $this->plan->setPlanHead(Input::get('planHead'));
        $this->plan->setPlanBudgetResource(Input::get('planBudgetResource'));
        $this->plan->setPlanStartYear(Input::get('planStartYear'));
        $this->plan->setPlanEndYear(Input::get('planEndYear'));
        $this->plan->setPlanStatus(Input::get('planStatus'));
        $this->plan->setPlanImage(Input::file('planImage'));
        $v = $this->plan->validate();
        if ($v->fails()) {
            return Redirect::to('planTable/update/' . $planId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->plan->updateToDatabase();
        return Redirect::to('planTable/update/' . $planId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($planId) {
        $this->plan->setPlanId($planId);
        $this->plan->deleteToDatabase();
        return Redirect::to('planTable')
                        ->with('deleteSuccess', true);
    }

    public function displayDatatable() {
        return View::make('plan.index')
                        ->with('datasourceUrl', URL::to('datasourcePlan'))
                        ->with('menuName', $this->plan->getMenuNameForDisplay())
                        ->with('url', 'planTable');
    }

}
