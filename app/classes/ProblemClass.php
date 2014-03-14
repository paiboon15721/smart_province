<?php

class ProblemClass {

    private $problemId;
    private $fieldForDisplay = array();
    private static $PROBLEM_ECONOMY_PROBLEM_ID = 1;
    private static $PROBLEM_ECONOMY_TITLE = 'ปัญหาด้านเศรษฐกิจ';
    private static $PROBLEM_ECONOMY_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_ECONOMY_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_SOCIAL_PROBLEM_ID = 2;
    private static $PROBLEM_SOCIAL_TITLE = 'ปัญหาด้านสังคม';
    private static $PROBLEM_SOCIAL_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_SOCIAL_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_ENVIRONMENT_PROBLEM_ID = 3;
    private static $PROBLEM_ENVIRONMENT_TITLE = 'ปัญหาด้านทรัพยากรธรรมชาติและสิ่งแวดล้อม';
    private static $PROBLEM_ENVIRONMENT_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_ENVIRONMENT_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_MANAGEMENT_PROBLEM_ID = 4;
    private static $PROBLEM_MANAGEMENT_TITLE = 'ปัญหาด้านการบริหารจัดการ';
    private static $PROBLEM_MANAGEMENT_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_MANAGEMENT_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_STABLE_PROBLEM_ID = 5;
    private static $PROBLEM_STABLE_TITLE = 'ปัญหาด้านความมั่นคง';
    private static $PROBLEM_STABLE_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_STABLE_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_FARMER_PROBLEM_ID = 6;
    private static $PROBLEM_FARMER_TITLE = 'ปัญหาด้านการเกษตร';
    private static $PROBLEM_FARMER_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_FARMER_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );
    private static $PROBLEM_SOCIAL_PERFORMANCE_PROBLEM_ID = 7;
    private static $PROBLEM_SOCIAL_PERFORMANCE_TITLE = 'ปัญหาด้านการเรียนรู้และพัฒนาศักยภาพชุมชน';
    private static $PROBLEM_SOCIAL_PERFORMANCE_FIELD = array('problem_desc', 'cause', 'howto');
    private static $PROBLEM_SOCIAL_PERFORMANCE_HEADER = array(
        array('class' => 'center', 'width' => '70px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สภาพปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'สาเหตุปัญหา'),
        array('class' => 'center', 'width' => '300px', 'text' => 'แนวทางการแก้ไขปัญหา')
    );

    private function getDataForDisplay() {
        return Problem::select($this->fieldForDisplay)
                        ->where('problem_id', '=', $this->problemId)
                        ->where('catm', '=', Session::get('catmId'))
                        ->get();
    }

    public function getProblemEconomyTitleForDisplay() {
        return self::$PROBLEM_ECONOMY_TITLE;
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
        return self::$PROBLEM_SOCIAL_TITLE;
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
        return self::$PROBLEM_ENVIRONMENT_TITLE;
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
        return self::$PROBLEM_MANAGEMENT_TITLE;
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
        return self::$PROBLEM_STABLE_TITLE;
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
        return self::$PROBLEM_FARMER_TITLE;
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
        return self::$PROBLEM_SOCIAL_PERFORMANCE_TITLE;
    }

    public function getProblemSocialPerformanceHeaderForDisplay() {
        return self::$PROBLEM_SOCIAL_PERFORMANCE_HEADER;
    }

    public function getProblemSocialPerformanceDataForDisplay() {
        $this->problemId = self::$PROBLEM_SOCIAL_PERFORMANCE_PROBLEM_ID;
        $this->fieldForDisplay = self::$PROBLEM_SOCIAL_PERFORMANCE_FIELD;
        return $this->getDataForDisplay();
    }

}
