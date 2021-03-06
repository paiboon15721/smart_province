<?php

class ProblemClass {

    private $problemRunningId;
    private $problemId;
    private $problemDesc;
    private $cause;
    private $howTo;
    private $beginDate;
    private $endDate;
    private $status;
    private $rules = array(
        'problemDesc' => 'required',
        'status' => 'required',
        'beginDate' => 'required|regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/|dateValid',
        'endDate' => 'required|regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/|dateValid'
    );

    public function validate() {
        $validationData = array(
            'problemDesc' => $this->problemDesc,
            'status' => $this->status,
            'beginDate' => $this->beginDate,
            'endDate' => $this->endDate
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setProblemRunningId($value) {
        $this->problemRunningId = $value;
    }

    public function setProblemId($value) {
        $this->problemId = $value;
    }

    public function setProblemDesc($value) {
        $this->problemDesc = $value;
    }

    public function setCause($value) {
        $this->cause = $value;
    }

    public function setHowTo($value) {
        $this->howTo = $value;
    }

    public function setBeginDate($value) {
        $this->beginDate = $value;
    }

    public function setEndDate($value) {
        $this->endDate = $value;
    }

    public function setStatus($value) {
        $this->status = $value;
    }

    private $fieldForDisplay = array();
    private static $MENU_ID = 219;
    private static $PROBLEM_ECONOMY_PROBLEM_ID = 1;
    private static $PROBLEM_ECONOMY_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_ECONOMY_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_SOCIAL_PROBLEM_ID = 2;
    private static $PROBLEM_SOCIAL_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_SOCIAL_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_ENVIRONMENT_PROBLEM_ID = 3;
    private static $PROBLEM_ENVIRONMENT_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_ENVIRONMENT_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_MANAGEMENT_PROBLEM_ID = 4;
    private static $PROBLEM_MANAGEMENT_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_MANAGEMENT_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_STABLE_PROBLEM_ID = 5;
    private static $PROBLEM_STABLE_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_STABLE_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_FARMER_PROBLEM_ID = 6;
    private static $PROBLEM_FARMER_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_FARMER_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_SOCIAL_PERFORMANCE_PROBLEM_ID = 7;
    private static $PROBLEM_SOCIAL_PERFORMANCE_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_SOCIAL_PERFORMANCE_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );

    public function getMenuNameForDisplay() {
        $menuName = MenuSetting::select('menu_name_th')
                ->where('menu_id', '=', self::$MENU_ID)
                ->first();
        return str_replace('การบันทึก', '', $menuName['menu_name_th']);
    }

    private function getDataForDisplay() {
        return Problem::select($this->fieldForDisplay)
                        ->where('problem_id', '=', $this->problemId)
                        ->where('catm', '=', $_SESSION['catm_menu'])
                        ->get();
    }

    private function getTitleForDisplay($problemId) {
        $problemDic = ProblemDic::select('problem_name')
                ->where('problem_dic_id', '=', $problemId)
                ->first();
        return $problemDic['problem_name'];
    }

    public function getProblemEconomyTitleForDisplay() {
        return $this->getTitleForDisplay(self::$PROBLEM_ECONOMY_PROBLEM_ID);
    }

    public function getProblemEconomyHeaderForDisplay() {
        return self::$PROBLEM_ECONOMY_HEADER;
    }

    public function getProblemEconomyDataForDisplay() {
        $this->problemId = self::$PROBLEM_ECONOMY_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_ECONOMY_FIELD;
        return $this->getDataForDisplay();
    }

    public function getProblemSocialTitleForDisplay() {
        return $this->getTitleForDisplay(self::$PROBLEM_SOCIAL_PROBLEM_ID);
    }

    public function getProblemSocialHeaderForDisplay() {
        return self::$PROBLEM_SOCIAL_HEADER;
    }

    public function getProblemSocialDataForDisplay() {
        $this->problemId = self::$PROBLEM_SOCIAL_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_SOCIAL_FIELD;
        return $this->getDataForDisplay();
    }

    public function getProblemEnvironmentTitleForDisplay() {
        return $this->getTitleForDisplay(self::$PROBLEM_ENVIRONMENT_PROBLEM_ID);
    }

    public function getProblemEnvironmentHeaderForDisplay() {
        return self::$PROBLEM_ENVIRONMENT_HEADER;
    }

    public function getProblemEnvironmentDataForDisplay() {
        $this->problemId = self::$PROBLEM_ENVIRONMENT_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_ENVIRONMENT_FIELD;
        return $this->getDataForDisplay();
    }

    public function getProblemManagementTitleForDisplay() {
        return $this->getTitleForDisplay(self::$PROBLEM_MANAGEMENT_PROBLEM_ID);
    }

    public function getProblemManagementHeaderForDisplay() {
        return self::$PROBLEM_MANAGEMENT_HEADER;
    }

    public function getProblemManagementDataForDisplay() {
        $this->problemId = self::$PROBLEM_MANAGEMENT_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_MANAGEMENT_FIELD;
        return $this->getDataForDisplay();
    }

    public function getProblemStableTitleForDisplay() {
        return $this->getTitleForDisplay(self::$PROBLEM_STABLE_PROBLEM_ID);
    }

    public function getProblemStableHeaderForDisplay() {
        return self::$PROBLEM_STABLE_HEADER;
    }

    public function getProblemStableDataForDisplay() {
        $this->problemId = self::$PROBLEM_STABLE_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_STABLE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getProblemFarmerTitleForDisplay() {
        return $this->getTitleForDisplay(self::$PROBLEM_FARMER_PROBLEM_ID);
    }

    public function getProblemFarmerHeaderForDisplay() {
        return self::$PROBLEM_FARMER_HEADER;
    }

    public function getProblemFarmerDataForDisplay() {
        $this->problemId = self::$PROBLEM_FARMER_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_FARMER_FIELD;
        return $this->getDataForDisplay();
    }

    public function getProblemSocialPerformanceTitleForDisplay() {
        return $this->getTitleForDisplay(self::$PROBLEM_SOCIAL_PERFORMANCE_PROBLEM_ID);
    }

    public function getProblemSocialPerformanceHeaderForDisplay() {
        return self::$PROBLEM_SOCIAL_PERFORMANCE_HEADER;
    }

    public function getProblemSocialPerformanceDataForDisplay() {
        $this->problemId = self::$PROBLEM_SOCIAL_PERFORMANCE_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_SOCIAL_PERFORMANCE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getProblem() {
        return Problem::find($this->problemRunningId);
    }

    public function insertToDatabase() {
        $problem = new Problem;
        $problem->catm = $_SESSION['catm_menu'];
        $problem->problem_id = $this->problemId;
        $problem->problem_desc = $this->problemDesc;
        $problem->cause = $this->cause;
        $problem->howto = $this->howTo;
        $problem->begin_date = DateClass::dateFormatBeforeInsert($this->beginDate);
        $problem->end_date = DateClass::dateFormatBeforeInsert($this->endDate);
        $problem->status = $this->status;
        $problem->save();
    }

    public function updateToDatabase() {
        $problem = Problem::find($this->problemRunningId);
        $problem->problem_id = $this->problemId;
        $problem->problem_desc = $this->problemDesc;
        $problem->cause = $this->cause;
        $problem->howto = $this->howTo;
        $problem->begin_date = DateClass::dateFormatBeforeInsert($this->beginDate);
        $problem->end_date = DateClass::dateFormatBeforeInsert($this->endDate);
        $problem->status = $this->status;
        $problem->save();
    }

    public function deleteToDatabase() {
        $problem = Problem::find($this->problemRunningId);
        $problem->delete();
    }

}
