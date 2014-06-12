<?php

class OtopClass {

    private $otopId;
    private $otopType;
    private $otopName;
    private $otopGroup;
    private $otopStar;
    private $otopDetail;
    private $contractName;
    private $contractTel;
    private $contractAddr;
    private $otopImage;
    private $rules = array(
        'otopTypeId' => 'required',
        'otopName' => 'required',
        'contractName' => 'required',
        'contractTel' => 'required',
        'otopImage' => 'required|image'
    );

    public function validate() {
        $validationData = array(
            'otopTypeId' => $this->otopType,
            'otopName' => $this->otopName,
            'contractName' => $this->contractName,
            'contractTel' => $this->contractTel,
            'otopImage' => $this->otopImage
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setOtopId($value) {
        $this->otopId = $value;
    }

    public function setOtopType($value) {
        $this->otopType = $value;
    }

    public function setOtopName($value) {
        $this->otopName = $value;
    }

    public function setOtopGroup($value) {
        $this->otopGroup = $value;
    }

    public function setOtopStar($value) {
        $this->otopStar = $value;
    }

    public function setOtopDetail($value) {
        $this->otopDetail = $value;
    }

    public function setContractName($value) {
        $this->contractName = $value;
    }

    public function setContractTel($value) {
        $this->contractTel = $value;
    }

    public function setContractAddr($value) {
        $this->contractAddr = $value;
    }

    public function setOtopImage($value) {
        $this->otopImage = $value;
    }

    private $fieldForDisplay = array();
    private static $MENU_ID = 224;
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
                        ->where('catm', '=', $_SESSION['catm_menu'])
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
                ->first();
        return str_replace('การบันทึก', '', $menuName['menu_name_th']);
    }

    public function getOtop() {
        return Otop::find($this->otopId);
    }

    public function insertToDatabase() {
        $otop = new Otop;
        $otop->catm = $_SESSION['catm_menu'];
        $otop->otop_type = $this->otopType;
        $otop->otop_name = $this->otopName;
        $otop->otop_group = $this->otopGroup;
        $otop->otop_star = $this->otopStar;
        $otop->otop_detail = $this->otopDetail;
        $otop->contract_name = $this->contractName;
        $otop->contract_tel = $this->contractTel;
        $otop->contract_addr = $this->contractAddr;
        if (input::hasFile('otopImage')) {
            $file = Input::file('otopImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->otopImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->otopImage);
        }
        $otop->images = $this->otopImage;
        $otop->save();
    }

    public function updateToDatabase() {
        $otop = Otop::find($this->otopId);
        $otop->otop_type = $this->otopType;
        $otop->otop_name = $this->otopName;
        $otop->otop_group = $this->otopGroup;
        $otop->otop_star = $this->otopStar;
        $otop->otop_detail = $this->otopDetail;
        $otop->contract_name = $this->contractName;
        $otop->contract_tel = $this->contractTel;
        $otop->contract_addr = $this->contractAddr;
        if (input::hasFile('otopImage')) {
            $oldImageName = $otop->images;
            $file = Input::file('otopImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->otopImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->otopImage);
            if (is_file(public_path() . '/data/' . $oldImageName)) {
                unlink(public_path() . '/data/' . $oldImageName);
            }
            $otop->images = $this->otopImage;
        }
        $otop->save();
    }

    public function deleteToDatabase() {
        $otop = Otop::find($this->otopId);
        if (is_file(public_path() . '/data/' . $otop->images)) {
            unlink(public_path() . '/data/' . $otop->images);
        }
        $otop->delete();
    }

}
