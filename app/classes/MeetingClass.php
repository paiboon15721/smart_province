<?php

class MeetingClass {

    private $meetingId;
    private $meetingName;
    private $meetingDate;
    private $meetingImage;
    private $rules = array(
        'meetingName' => 'required'
    );

    public function validate() {
        $validationData = array(
            'meetingName' => $this->meetingName
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setMeetingId($value) {
        $this->meetingId = $value;
    }

    public function setMeetingName($value) {
        $this->meetingName = $value;
    }

    public function setMeetingDate($value) {
        $this->meetingDate = $value;
    }

    public function setMeetingImage($value) {
        $this->meetingImage = $value;
    }

    private $fieldForDisplay = array();
    private static $MENU_ID = 233;
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
        return str_replace('ระบบบันทึก', '', $menuName['menu_name_th']);
    }

    private function getDataForDisplay() {
        return Travel::with('travelType')
                        ->select($this->fieldForDisplay)
                        ->where('catm', '=', $_SESSION['catm_menu'])
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

    public function getMeeting() {
        return Meeting::find($this->meetingId);
    }

    public function insertToDatabase() {
        $meeting = new Meeting;
        $meeting->catm = $_SESSION['catm_menu'];
        $meeting->meeting_name = $this->meetingName;
        $meeting->meeting_date = DateClass::dateFormatBeforeInsert($this->meetingDate);
        if (input::hasFile('meetingImage')) {
            $file = Input::file('meetingImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->meetingImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->meetingImage);
        }
        $meeting->pic_no = $this->meetingImage;
        $meeting->save();
    }

    public function updateToDatabase() {
        $meeting = Meeting::find($this->meetingId);
        $meeting->meeting_name = $this->meetingName;
        $meeting->meeting_date = DateClass::dateFormatBeforeInsert($this->meetingDate);
        if (input::hasFile('meetingImage')) {
            $oldImageName = $meeting->pic_no;
            $file = Input::file('meetingImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->meetingImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->meetingImage);
            if (is_file(public_path() . '/data/' . $oldImageName)) {
                unlink(public_path() . '/data/' . $oldImageName);
            }
            $meeting->pic_no = $this->meetingImage;
        }
        $meeting->save();
    }

    public function deleteToDatabase() {
        $meeting = Meeting::find($this->meetingId);
        if (is_file(public_path() . '/data/' . $meeting->pic_no)) {
            unlink(public_path() . '/data/' . $meeting->pic_no);
        }
        $meeting->delete();
    }

}
