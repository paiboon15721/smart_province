<?php

class PlanClass {

    private $planId;
    private $planName;
    private $planType;
    private $planDate;
    private $planSize;
    private $planBudget;
    private $planHead;
    private $planBudgetResource;
    private $planStartYear;
    private $planEndYear;
    private $planStatus;
    private $planImage;
    private $rules = array(
        'planName' => 'required',
        'planBudget' => 'Numeric',
        'planStartYear' => 'Numeric',
        'planEndYear' => 'Numeric',
        'planDate' => 'regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/|dateValid'
    );

    public function validate() {
        $validationData = array(
            'planName' => $this->planName,
            'planBudget' => $this->planBudget,
            'planStartYear' => $this->planStartYear,
            'planEndYear' => $this->planEndYear,
            'planDate' => $this->planDate
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setPlanId($value) {
        $this->planId = $value;
    }

    public function setPlanName($value) {
        $this->planName = $value;
    }

    public function setPlanType($value) {
        $this->planType = $value;
    }

    public function setPlanDate($value) {
        $this->planDate = $value;
    }

    public function setPlanSize($value) {
        $this->planSize = $value;
    }

    public function setPlanBudget($value) {
        $this->planBudget = $value;
    }

    public function setPlanHead($value) {
        $this->planHead = $value;
    }

    public function setPlanBudgetResource($value) {
        $this->planBudgetResource = $value;
    }

    public function setPlanStartYear($value) {
        $this->planStartYear = $value;
    }

    public function setPlanEndYear($value) {
        $this->planEndYear = $value;
    }

    public function setPlanStatus($value) {
        $this->planStatus = $value;
    }

    public function setPlanImage($value) {
        $this->planImage = $value;
    }

    private $fieldForDisplay = array();
    private static $MENU_ID = 232;
    private static $TRAVEL_TITLE = 'ข้อมูลการท่องเที่ยว';
    private static $TRAVEL_FIELD = array('travel_type', 'travel_name', 'travel_detail', 'contract_name', 'contract_addr', 'latitude', 'longtitude', 'contract_tel', 'travel_star', 'pic_no');
    private static $TRAVEL_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'ประเภทสถานที่ท่องเที่ยว'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อสถานที่ท่องเที่ยว'),
        array('class' => 'center', 'width' => '150px', 'text' => 'รายละเอียด'),
        array('class' => 'center', 'width' => '150px', 'text' => 'จำนวนดาว'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ผู้ดูแล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่ผู้ดูแล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'เบอร์โทรศัพท์ผู้ดูแล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'lattitude'),
        array('class' => 'center', 'width' => '150px', 'text' => 'longtitude'),
        array('class' => 'center', 'width' => '150px', 'text' => 'รูปภาพ')
    );

    public function getMenuNameForDisplay() {
        $menuName = MenuSetting::select('menu_name_th')
                        ->where('menu_id', '=', self::$MENU_ID)
                        ->first()['menu_name_th'];
        return str_replace('ระบบบันทึก', '', $menuName);
    }

    private function getDataForDisplay() {
        return Travel::with('travelType')
                        ->select($this->fieldForDisplay)
                        ->where('catm', '=', Session::get('catmId'))
                        ->get();
    }

    public function getTravelTitleForDisplay() {
        return self::$TRAVEL_TITLE;
    }

    public function getTravelHeaderForDisplay() {
        return self::$TRAVEL_HEADER;
    }

    public function getTravelDataForDisplay() {
        $this->fieldForDisplay = self::$TRAVEL_FIELD;
        return $this->getDataForDisplay();
    }

    public function getPlan() {
        return Plan::find($this->planId);
    }

    public function insertToDatabase() {
        $plan = new Plan;
        $plan->catm = Session::get('catmId');
        $plan->plan_name = $this->planName;
        $plan->type = $this->planType;
        $plan->plan_date = DateClass::dateFormatBeforeInsert($this->planDate);
        $plan->size = $this->planSize;
        $plan->budget = $this->planBudget;
        $plan->head = $this->planHead;
        $plan->budget_resource = $this->planBudgetResource;
        $plan->start_year = $this->planStartYear;
        $plan->end_year = $this->planEndYear;
        $plan->status = $this->planStatus;
        if (input::hasFile('planImage')) {
            $file = Input::file('planImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->planImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->planImage);
            $plan->pic_no = $this->planImage;
        }

        $plan->save();
    }

    public function updateToDatabase() {
        $plan = Plan::find($this->planId);
        $plan->plan_name = $this->planName;
        $plan->type = $this->planType;
        $plan->plan_date = DateClass::dateFormatBeforeInsert($this->planDate);
        $plan->size = $this->planSize;
        $plan->budget = $this->planBudget;
        $plan->head = $this->planHead;
        $plan->budget_resource = $this->planBudgetResource;
        $plan->start_year = $this->planStartYear;
        $plan->end_year = $this->planEndYear;
        $plan->status = $this->planStatus;
        if (input::hasFile('planImage')) {
            $oldImageName = $plan->pic_no;
            $file = Input::file('planImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->planImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->planImage);
            if (is_file(public_path() . '/data/' . $oldImageName)) {
                unlink(public_path() . '/data/' . $oldImageName);
            }
            $plan->pic_no = $this->planImage;
        }
        $plan->save();
    }

    public function deleteToDatabase() {
        $plan = Plan::find($this->planId);
        if (is_file(public_path() . '/data/' . $plan->pic_no)) {
            unlink(public_path() . '/data/' . $plan->pic_no);
        }
        $plan->delete();
    }

}
