<?php

class ProblemController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $problem;
    private $problemDic;

    function __construct() {
        $this->problem = new ProblemClass();
        $this->problemDic = new ProblemDicClass();
    }

    public function displayProblemEconomy() {
        return View::make('content.tablecloth.problem.problemEconomy')
                        ->with('title', $this->problem->getProblemEconomyTitleForDisplay())
                        ->with('headers', $this->problem->getProblemEconomyHeaderForDisplay())
                        ->with('listOfData', $this->problem->getProblemEconomyDataForDisplay());
    }

    public function displayProblemSocial() {
        return View::make('content.tablecloth.problem.problemSocial')
                        ->with('title', $this->problem->getProblemSocialTitleForDisplay())
                        ->with('headers', $this->problem->getProblemSocialHeaderForDisplay())
                        ->with('listOfData', $this->problem->getProblemSocialDataForDisplay());
    }

    public function displayProblemEnvironment() {
        return View::make('content.tablecloth.problem.problemEnvironment')
                        ->with('title', $this->problem->getProblemEnvironmentTitleForDisplay())
                        ->with('headers', $this->problem->getProblemEnvironmentHeaderForDisplay())
                        ->with('listOfData', $this->problem->getProblemEnvironmentDataForDisplay());
    }

    public function displayProblemManagement() {
        return View::make('content.tablecloth.problem.problemManagement')
                        ->with('title', $this->problem->getProblemManagementTitleForDisplay())
                        ->with('headers', $this->problem->getProblemManagementHeaderForDisplay())
                        ->with('listOfData', $this->problem->getProblemManagementDataForDisplay());
    }

    public function displayProblemStable() {
        return View::make('content.tablecloth.problem.problemStable')
                        ->with('title', $this->problem->getProblemStableTitleForDisplay())
                        ->with('headers', $this->problem->getProblemStableHeaderForDisplay())
                        ->with('listOfData', $this->problem->getProblemStableDataForDisplay());
    }

    public function displayProblemFarmer() {
        return View::make('content.tablecloth.problem.problemFarmer')
                        ->with('title', $this->problem->getProblemFarmerTitleForDisplay())
                        ->with('headers', $this->problem->getProblemFarmerHeaderForDisplay())
                        ->with('listOfData', $this->problem->getProblemFarmerDataForDisplay());
    }

    public function displayProblemSocialPerformance() {
        return View::make('content.tablecloth.problem.problemSocialPerformance')
                        ->with('title', $this->problem->getProblemSocialPerformanceTitleForDisplay())
                        ->with('headers', $this->problem->getProblemSocialPerformanceHeaderForDisplay())
                        ->with('listOfData', $this->problem->getProblemSocialPerformanceDataForDisplay());
    }

    public function insertGet() {
        return View::make('problem.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->problem->getMenuNameForDisplay())
                        ->with('problemDic', $this->problemDic->getProblemDicForCombobox())
                        ->with('backUrl', URL::to('problemTable'));
    }

    public function insertPost() {
        $this->problem->setProblemId(Input::get('problemId'));
        $this->problem->setProblemDesc(Input::get('problemDesc'));
        $this->problem->setCause(Input::get('cause'));
        $this->problem->setHowTo(Input::get('howTo'));
        $this->problem->setBeginDate(Input::get('beginDate'));
        $this->problem->setEndDate(Input::get('endDate'));
        $this->problem->setStatus(Input::get('status'));
        $v = $this->problem->validate();
        if ($v->fails()) {
            return Redirect::to('problemTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        $this->problem->insertToDatabase();
        return Redirect::to('problemTable/insert')
                        ->with('insertSuccess', true);
    }

    public function updateGet($problemRunningId) {
        $this->problem->setProblemRunningId($problemRunningId);
        $problem = $this->problem->getProblem();
        return View::make('problem.update')
                        ->with('actionType', 'แก้ไข')
                        ->with('menuName', $this->problem->getMenuNameForDisplay())
                        ->with('problemDic', $this->problemDic->getProblemDicForCombobox())
                        ->with('problem', $problem)
                        ->with('backUrl', URL::to('problemTable'));
    }

    public function updatePost($problemRunningId) {
        $this->problem->setProblemRunningId($problemRunningId);
        $this->problem->setProblemId(Input::get('problemId'));
        $this->problem->setProblemDesc(Input::get('problemDesc'));
        $this->problem->setCause(Input::get('cause'));
        $this->problem->setHowTo(Input::get('howTo'));
        $this->problem->setBeginDate(Input::get('beginDate'));
        $this->problem->setEndDate(Input::get('endDate'));
        $this->problem->setStatus(Input::get('status'));
        $v = $this->problem->validate();
        if ($v->fails()) {
            return Redirect::to('problemTable/update/' . $problemRunningId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->problem->updateToDatabase();
        return Redirect::to('problemTable/update/' . $problemRunningId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($problemRunningId) {
        $this->problem->setProblemRunningId($problemRunningId);
        $this->problem->deleteToDatabase($problemRunningId);
        return Redirect::to('problemTable')
                        ->with('deleteSuccess', true);
    }

    public function displayDatatableProblem() {
        return View::make('problem.index')
                        ->with('datasourceUrl', URL::to('datasourceProblem'))
                        ->with('menuName', $this->problem->getMenuNameForDisplay())
                        ->with('insertUrl', URL::to('problemTable/insert'))
                        ->with('updateUrl', URL::to('problemTable/update'))
                        ->with('deleteUrl', URL::to('problemTable/delete'));
    }

}
