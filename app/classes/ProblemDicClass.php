<?php

class ProblemDicClass {

    public function getProblemDicList() {
        return ProblemDic::lists('problem_name', 'problem_dic_id');
    }

}
