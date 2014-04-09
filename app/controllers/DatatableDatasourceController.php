<?php

class DatatableDatasourceController extends BaseController {

    private $datatableDatasource;

    function __construct() {
        $this->datatableDatasource = new DatatableDatasourceClass();
    }

    public function datasourceProblem() {
        return $this->datatableDatasource->datasourceProblem();
    }

}
