<?php

class OtopClass {

    private $fieldForDisplay = array();
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

}
