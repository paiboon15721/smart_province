<?php

class ProblemController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $problem;

    function __construct() {
        $this->problem = new ProblemClass();
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
                        ->with('backUrl', URL::to('problemTable'));
    }

    public function displayDatatableProblem() {
        return View::make('layouts.datatable')
                        ->with('datasourceUrl', URL::to('datasourceProblem'))
                        ->with('insertUrl', URL::to('problemTable/insert'))
                        ->with('updateUrl', URL::to('problemTable/update'))
                        ->with('deleteUrl', URL::to('problemTable/delete'));
    }

}
