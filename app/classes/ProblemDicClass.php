<?php

class ProblemDicClass {

    public function getProblemDicForCombobox() {
        return ProblemDic::lists('problem_name', 'problem_dic_id');
    }

}
