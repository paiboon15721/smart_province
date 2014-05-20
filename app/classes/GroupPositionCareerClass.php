<?php

class GroupPositionCareerClass {

    private $positionId;
    private $positionName;
    private $positionMember;
    private $positionBudget;
    private $rules = array(
        'positionName' => 'required',
        'positionMember' => 'Numeric',
        'positionBudget' => 'Numeric'
    );

    public function validate() {
        $validationData = array(
            'positionName' => $this->positionName,
            'positionMember' => $this->positionMember,
            'positionBudget' => $this->positionBudget
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setPositionId($value) {
        $this->positionId = $value;
    }

    public function setPositionName($value) {
        $this->positionName = $value;
    }

    public function setPositionMember($value) {
        $this->positionMember = $value;
    }

    public function setPositionBudget($value) {
        $this->positionBudget = $value;
    }

    private $fieldForDisplay = array();
    private static $MENU_ID = 253;
    private static $OTOP_TITLE = 'ข้อมูล OTOP';
    private static $OTOP_FIELD = array('otop_type', 'otop_name', 'otop_group', 'contract_name', 'contract_addr', 'contract_tel', 'otop_star', 'images');
    private static $OTOP_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'ประเภทสินค้า'),
        array('class' => 'center', 'width' => '150px', 'text' => 'สินค้าเกษตร/ผลิตภัณฑ์'),
        array('class' => 'center', 'width' => '150px', 'text' => 'กลุ่ม'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อผู้ขาย'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่ผู้ขาย'),
        array('class' => 'center', 'width' => '150px', 'text' => 'เบอร์โทรศัพท์ผู้ขาย'),
        array('class' => 'center', 'width' => '150px', 'text' => 'จำนวนดาว'),
        array('class' => 'center', 'width' => '150px', 'text' => 'รูปภาพ')
    );

    private function getDataForDisplay() {
        return Otop::with('otopType')
                        ->select($this->fieldForDisplay)
                        ->where('catm', '=', Session::get('catmId'))
                        ->get();
    }

    public function getOtopTitleForDisplay() {
        return self::$OTOP_TITLE;
    }

    public function getOtopHeaderForDisplay() {
        return self::$OTOP_HEADER;
    }

    public function getOtopDataForDisplay() {
        $this->fieldForDisplay = self::$OTOP_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMenuNameForDisplay() {
        $menuName = MenuSetting::select('menu_name_th')
                        ->where('menu_id', '=', self::$MENU_ID)
                        ->first()['menu_name_th'];
        return str_replace('ระบบบันทึก', '', $menuName);
    }

    public function getGroupPositionCareer() {
        return GroupPositionCareer::find($this->positionId);
    }

    public function insertToDatabase() {
        $groupPositionCareer = new GroupPositionCareer;
        $groupPositionCareer->catm = Session::get('catmId');
        $groupPositionCareer->position_name = $this->positionName;
        $groupPositionCareer->position_member = $this->positionMember;
        $groupPositionCareer->position_budget = $this->positionBudget;
        $groupPositionCareer->save();
    }

    public function updateToDatabase() {
        $groupPositionCareer = GroupPositionCareer::find($this->positionId);
        $groupPositionCareer->position_name = $this->positionName;
        $groupPositionCareer->position_member = $this->positionMember;
        $groupPositionCareer->position_budget = $this->positionBudget;
        $groupPositionCareer->save();
    }

    public function deleteToDatabase() {
        $groupPositionCareer = GroupPositionCareer::find($this->positionId);
        $groupPositionCareer->delete();
    }

}
