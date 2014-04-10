<?php

class Problem extends Eloquent {

    protected $table = 'tab_problem';
    public $timestamps = false;
    protected $primaryKey = 'problem_running_id';

    public function problemDic() {
        return $this->belongsTo('ProblemDic', 'problem_dic_id')->select('problem_dic_id', 'problem_name');
    }

}
