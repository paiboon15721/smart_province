<?php

class TravelClass {

    private $travelId;
    private $travelType;
    private $travelName;
    private $travelStar;
    private $travelDetail;
    private $contractName;
    private $contractTel;
    private $contractAddr;
    private $latitude;
    private $longtitude;
    private $travelImage;
    private $rules = array(
        'travelTypeId' => 'required',
        'travelName' => 'required'
    );

    public function validate() {
        $validationData = array(
            'travelTypeId' => $this->travelType,
            'travelName' => $this->travelName
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setTravelId($value) {
        $this->travelId = $value;
    }

    public function setTravelType($value) {
        $this->travelType = $value;
    }

    public function setTravelName($value) {
        $this->travelName = $value;
    }

    public function setTravelStar($value) {
        $this->travelStar = $value;
    }

    public function setTravelDetail($value) {
        $this->travelDetail = $value;
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

    public function setLatitude($value) {
        $this->latitude = $value;
    }

    public function setLongtitude($value) {
        $this->longtitude = $value;
    }

    public function setTravelImage($value) {
        $this->travelImage = $value;
    }

    private $fieldForDisplay = array();
    private static $MENU_ID = 225;
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
                ->first();
        return str_replace('การบันทึก', '', $menuName['menu_name_th']);
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

    public function getTravel() {
        return Travel::find($this->travelId);
    }

    public function insertToDatabase() {
        $travel = new Travel;
        $travel->catm = Session::get('catmId');
        $travel->travel_type = $this->travelType;
        $travel->travel_name = $this->travelName;
        $travel->travel_star = $this->travelStar;
        $travel->travel_detail = $this->travelDetail;
        $travel->contract_name = $this->contractName;
        $travel->contract_tel = $this->contractTel;
        $travel->contract_addr = $this->contractAddr;
        $travel->latitude = $this->latitude;
        $travel->longtitude = $this->longtitude;
        if (input::hasFile('travelImage')) {
            $file = Input::file('travelImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->travelImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->travelImage);
        }
        $travel->pic_no = $this->travelImage;
        $travel->save();
    }

    public function updateToDatabase() {
        $travel = Travel::find($this->travelId);
        $travel->travel_type = $this->travelType;
        $travel->travel_name = $this->travelName;
        $travel->travel_star = $this->travelStar;
        $travel->travel_detail = $this->travelDetail;
        $travel->contract_name = $this->contractName;
        $travel->contract_tel = $this->contractTel;
        $travel->contract_addr = $this->contractAddr;
        $travel->latitude = $this->latitude;
        $travel->longtitude = $this->longtitude;
        if (input::hasFile('travelImage')) {
            $oldImageName = $travel->pic_no;
            $file = Input::file('travelImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->travelImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->travelImage);
            if (is_file(public_path() . '/data/' . $oldImageName)) {
                unlink(public_path() . '/data/' . $oldImageName);
            }
            $travel->pic_no = $this->travelImage;
        }
        $travel->save();
    }

    public function deleteToDatabase() {
        $travel = Travel::find($this->travelId);
        if (is_file(public_path() . '/data/' . $travel->pic_no)) {
            unlink(public_path() . '/data/' . $travel->pic_no);
        }
        $travel->delete();
    }

}
