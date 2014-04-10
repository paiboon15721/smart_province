<?php

class ProblemDic extends Eloquent {

    protected $table = 'tab_problem_dic';
    public $timestamps = false;
    protected $primaryKey = 'problem_dic_id';

    public function problem() {
        return $this->hasMany('Problem', 'problem_running_id');
    }

}
