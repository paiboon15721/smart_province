<?php

class TravelClass {

    private $fieldForDisplay = array();
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

}
