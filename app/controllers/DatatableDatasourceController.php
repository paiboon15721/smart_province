<?php

class DatatableDatasourceController extends BaseController {

    private $datatableDatasource;

    function __construct() {
        $this->datatableDatasource = new DatatableDatasourceClass();
    }

    public function datasourceProblem() {
        return $this->datatableDatasource->datasourceProblem();
    }

    public function datasourceGroupMember() {
        return $this->datatableDatasource->datasourceGroupMember();
    }

    public function datasourceOtop() {
        return $this->datatableDatasource->datasourceOtop();
    }

    public function datasourceTravel() {
        return $this->datatableDatasource->datasourceTravel();
    }

    public function datasourceMeeting() {
        return $this->datatableDatasource->datasourceMeeting();
    }

    public function datasourcePlan() {
        return $this->datatableDatasource->datasourcePlan();
    }

    public function datasourceActivity() {
        return $this->datatableDatasource->datasourceActivity();
    }

    public function datasourceGroupPositionCareer() {
        return $this->datatableDatasource->datasourceGroupPositionCareer();
    }

}
