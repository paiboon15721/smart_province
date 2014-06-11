<?php

class GroupMemberClass {

    private $groupId;
    private $fieldForDisplay = array();
    private static $MENU_ID = 218;
    private $memberPid;
    private $titleId;
    private $memberName;
    private $memberMidname;
    private $memberSurname;
    private $gender;
    private $memberCareer;
    private $memberAddress;
    private $memberPhoneNumber1;
    private $memberPhoneNumber2;
    private $memberImage;
    private $allInformation;
    private $rules = array(
        'memberPid' => 'required|Numeric',
        'memberName' => 'required',
        'memberSurname' => 'required',
        'gender' => 'required'
    );

    public function validate() {
        $validationData = array(
            'memberPid' => $this->memberPid,
            'memberName' => $this->memberName,
            'memberSurname' => $this->memberSurname,
            'gender' => $this->gender
        );
        return Validator::make($validationData, $this->rules);
    }

    public function insertToDatabase() {
        //เตรียมข้อมูลสำหรับบันทึกข้อมูลทั่วไป
        $groupMember = new GroupMember;
        $groupMember->catm = $_SESSION['catm_menu'];
        $groupMember->member_pid = $this->memberPid;
        $groupMember->title_code = $this->titleId;
        $groupMember->fname = $this->memberName;
        $groupMember->mname = $this->memberMidname;
        $groupMember->lname = $this->memberSurname;
        $groupMember->sex = $this->gender;
        $groupMember->member_career = $this->memberCareer;
        $groupMember->member_address = $this->memberAddress;
        $groupMember->member_phone1 = $this->memberPhoneNumber1;
        $groupMember->member_phone2 = $this->memberPhoneNumber2;
        if (input::hasFile('memberImage')) {
            $file = Input::file('memberImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->memberImage = md5(date('YmdHis') . $filename) . '.' . $ext;
        }
        $groupMember->images = $this->memberImage;

        //สร้าง array position
        $position = array_slice($this->allInformation, 11);
        array_pop($position);
        array_pop($position);

        //ถ้าไม่ได้เลือก position เลย ให้บันทึกข้อมูลทั่วไปได้เลย
        if (count($position) == 0) {
            if (input::hasFile('memberImage')) {
                $file->move(public_path() . '/data', $this->memberImage);
            }
            $groupMember->save();
            return "true";
        }

        //ถ้ามีการเลือก position ให้บันทึก position
        $position = array_chunk($position, 5);
        $countPosition = count($position) - 1;
        $positionForInsert = array();
        for ($i = 0; $i <= $countPosition; $i++) {
            $tmpPosition = $position[$i];
            $group_id = $tmpPosition[0];
            $group_position_id = $tmpPosition[1];
            $group_problem = $tmpPosition[2];
            $group_position_start_date = $tmpPosition[3];
            $group_position_end_date = $tmpPosition[4];
            if (DateClass::dateCheck($group_position_start_date, 'positionStartDate') <> "true") {
                return 'startDateProblem';
            }
            if (DateClass::dateCheck($group_position_end_date, 'positionEndDate') <> "true") {
                return 'endDateProblem';
            }
            $group_position_start_date = DateClass::dateFormatBeforeInsert($group_position_start_date);
            $group_position_end_date = DateClass::dateFormatBeforeInsert($group_position_end_date);
            $subPositionForInsert = array('member_pid' => $this->memberPid, 'group_id' => $group_id, 'position_id' => $group_position_id, 'problem' => $group_problem, 'start_date' => $group_position_start_date, 'end_date' => $group_position_end_date);
            array_push($positionForInsert, $subPositionForInsert);
        }

        $checkPositionForInsert = array();
        for ($i = 0; $i <= $countPosition; $i++) {
            if (empty($checkPositionForInsert[$positionForInsert[$i]['group_id']][$positionForInsert[$i]['position_id']])) {
                $checkPositionForInsert[$positionForInsert[$i]['group_id']][$positionForInsert[$i]['position_id']] = 1;
            } else {
                return "positionProblem";
            }
        }

        if (input::hasFile('memberImage')) {
            $file->move(public_path() . '/data', $this->memberImage);
        }
        $groupMember->save();
        DB::table('tab_member_position')->insert($positionForInsert);
        return "true";
    }

    public function updateToDatabase() {
        //เตรียมข้อมูลสำหรับแก้ไขข้อมูลทั่วไป
        $groupMember = GroupMember::find($this->memberPid);
        $groupMember->title_code = $this->titleId;
        $groupMember->fname = $this->memberName;
        $groupMember->mname = $this->memberMidname;
        $groupMember->lname = $this->memberSurname;
        $groupMember->sex = $this->gender;
        $groupMember->member_career = $this->memberCareer;
        $groupMember->member_address = $this->memberAddress;
        $groupMember->member_phone1 = $this->memberPhoneNumber1;
        $groupMember->member_phone2 = $this->memberPhoneNumber2;
        $oldImageName = $groupMember->images;
        if (input::hasFile('memberImage')) {
            $file = Input::file('memberImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->memberImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $groupMember->images = $this->memberImage;
        }

        //สร้าง array position
        $position = array_slice($this->allInformation, 11);
        array_pop($position);
        array_pop($position);

        //ถ้าไม่ได้เลือก position เลย ให้บันทึกข้อมูลทั่วไปได้เลย
        if (count($position) == 0) {
            if (input::hasFile('memberImage')) {
                $file->move(public_path() . '/data', $this->memberImage);
                if (is_file(public_path() . '/data/' . $oldImageName)) {
                    unlink(public_path() . '/data/' . $oldImageName);
                }
            }
            $groupMember->save();

            //ลบตำแหน่งก่อนหน้านี้ทั้งหมด
            MemberPosition::where('member_pid', '=', $this->memberPid)->delete();
            return "true";
        }

        //ถ้ามีการเลือก position ให้บันทึก position
        $position = array_chunk($position, 5);
        $countPosition = count($position) - 1;
        $positionForInsert = array();
        for ($i = 0; $i <= $countPosition; $i++) {
            $tmpPosition = $position[$i];
            $group_id = $tmpPosition[0];
            $group_position_id = $tmpPosition[1];
            $group_problem = $tmpPosition[2];
            $group_position_start_date = $tmpPosition[3];
            $group_position_end_date = $tmpPosition[4];
            if (DateClass::dateCheck($group_position_start_date, 'positionStartDate') <> "true") {
                return 'startDateProblem';
            }
            if (DateClass::dateCheck($group_position_end_date, 'positionEndDate') <> "true") {
                return 'endDateProblem';
            }
            $group_position_start_date = DateClass::dateFormatBeforeInsert($group_position_start_date);
            $group_position_end_date = DateClass::dateFormatBeforeInsert($group_position_end_date);
            $subPositionForInsert = array('member_pid' => $this->memberPid, 'group_id' => $group_id, 'position_id' => $group_position_id, 'problem' => $group_problem, 'start_date' => $group_position_start_date, 'end_date' => $group_position_end_date);
            array_push($positionForInsert, $subPositionForInsert);
        }

        $checkPositionForInsert = array();
        for ($i = 0; $i <= $countPosition; $i++) {
            if (empty($checkPositionForInsert[$positionForInsert[$i]['group_id']][$positionForInsert[$i]['position_id']])) {
                $checkPositionForInsert[$positionForInsert[$i]['group_id']][$positionForInsert[$i]['position_id']] = 1;
            } else {
                return "positionProblem";
            }
        }

        //ลบตำแหน่งก่อนหน้านี้ทั้งหมด
        MemberPosition::where('member_pid', '=', $this->memberPid)->delete();

        if (input::hasFile('memberImage')) {
            $file->move(public_path() . '/data', $this->memberImage);
            if (is_file(public_path() . '/data/' . $oldImageName)) {
                unlink(public_path() . '/data/' . $oldImageName);
            }
        }
        $groupMember->save();
        DB::table('tab_member_position')->insert($positionForInsert);
        return "true";
    }

    public function deleteToDatabase() {
        $groupMember = GroupMember::find($this->memberPid);
        if (is_file(public_path() . '/data/' . $groupMember->images)) {
            unlink(public_path() . '/data/' . $groupMember->images);
        }
        MemberPosition::where('member_pid', '=', $this->memberPid)->delete();
        $groupMember->delete();
    }

    public function getGroupMember() {
        return GroupMember::find($this->memberPid);
    }

    public function getGroupMemberPosition() {
        return MemberPosition::where('member_pid', '=', $this->memberPid)->get();
    }

    public function setAllInformation($value) {
        $this->allInformation = $value;
    }

    public function setMemberPid($value) {
        $this->memberPid = $value;
    }

    public function setTitleId($value) {
        $this->titleId = $value;
    }

    public function setMemberName($value) {
        $this->memberName = $value;
    }

    public function setMemberMidname($value) {
        $this->memberMidname = $value;
    }

    public function setMemberSurname($value) {
        $this->memberSurname = $value;
    }

    public function setGender($value) {
        $this->gender = $value;
    }

    public function setMemberCareer($value) {
        $this->memberCareer = $value;
    }

    public function setMemberAddress($value) {
        $this->memberAddress = $value;
    }

    public function setMemberPhoneNumber1($value) {
        $this->memberPhoneNumber1 = $value;
    }

    public function setMemberPhoneNumber2($value) {
        $this->memberPhoneNumber2 = $value;
    }

    public function setMemberImage($value) {
        $this->memberImage = $value;
    }

    private static $EX_HEADMAN_GROUP_ID = 1;
    private static $EX_HEADMAN_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name', 'images');
    private static $EX_HEADMAN_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง'),
        array('class' => 'center', 'width' => '150px', 'text' => 'รูปภาพ')
    );
    private static $EX_SAO_GROUP_ID = 2;
    private static $EX_SAO_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address');
    private static $EX_SAO_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่')
    );
    private static $EX_VILLAGE_COMMITTEE_GROUP_ID = 3;
    private static $EX_VILLAGE_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_VILLAGE_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_FUND_VILLAGE_COMMITTEE_GROUP_ID = 4;
    private static $EX_FUND_VILLAGE_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_FUND_VILLAGE_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_PROJECT_VILLAGE_COMMITTEE_GROUP_ID = 5;
    private static $EX_PROJECT_VILLAGE_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_PROJECT_VILLAGE_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_FUND_WOMEN_DELEGATE_GROUP_ID = 6;
    private static $EX_FUND_WOMEN_DELEGATE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname');
    private static $EX_FUND_WOMEN_DELEGATE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล')
    );
    private static $EX_PROJECT_POOR_COMMITTEE_GROUP_ID = 8;
    private static $EX_PROJECT_POOR_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_PROJECT_POOR_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_FUND_QUEEN_GROUP_ID = 9;
    private static $EX_FUND_QUEEN_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_FUND_QUEEN_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_SAVINGS_MENUFACTURING_COMMITTEE_GROUP_ID = 10;
    private static $EX_SAVINGS_MENUFACTURING_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_SAVINGS_MENUFACTURING_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $ORGA_PUBLIC_HEALTH_UNDERTAKE_GROUP_ID = 12;
    private static $ORGA_PUBLIC_HEALTH_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_PUBLIC_HEALTH_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_SECURITY_UNDERTAKE_GROUP_ID = 13;
    private static $ORGA_SECURITY_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_SECURITY_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_DEV_COMMUNITY_UNDERTAKE_GROUP_ID = 14;
    private static $ORGA_DEV_COMMUNITY_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_DEV_COMMUNITY_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_LIVESTOCK_UNDERTAKE_GROUP_ID = 15;
    private static $ORGA_LIVESTOCK_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_LIVESTOCK_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_25_PINEAPPLE_GROUP_ID = 16;
    private static $ORGA_25_PINEAPPLE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_25_PINEAPPLE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_RED_CROSS_UNDERTAKE_GROUP_ID = 17;
    private static $ORGA_RED_CROSS_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_RED_CROSS_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_MEDIATE_CIVIL_DELEGATE_GROUP_ID = 18;
    private static $ORGA_MEDIATE_CIVIL_DELEGATE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_MEDIATE_CIVIL_DELEGATE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_FARMER_GROUP_ID = 19;
    private static $ORGA_FARMER_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_FARMER_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_SOIL_DOCTER_GROUP_ID = 20;
    private static $ORGA_SOIL_DOCTER_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_SOIL_DOCTER_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $OLDER_OLDER_GROUP_ID = 22;
    private static $OLDER_OLDER_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1', 'problem');
    private static $OLDER_OLDER_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์'),
        array('class' => 'center', 'width' => '150px', 'text' => 'สภาพปัญหา')
    );
    private static $OLDER_DISABLED_GROUP_ID = 23;
    private static $OLDER_DISABLED_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1', 'problem');
    private static $OLDER_DISABLED_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์'),
        array('class' => 'center', 'width' => '150px', 'text' => 'สภาพปัญหา')
    );
    private static $OLDER_MISERABLE_GROUP_ID = 24;
    private static $OLDER_MISERABLE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1', 'problem');
    private static $OLDER_MISERABLE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์'),
        array('class' => 'center', 'width' => '150px', 'text' => 'สภาพปัญหา')
    );

    private function getDataForDisplay() {
        return GroupMember::with('title')
                        ->select($this->fieldForDisplay)
                        ->leftJoin('tab_member_position', 'tab_group_member.member_pid', '=', 'tab_member_position.member_pid')
                        ->leftJoin('tab_group_position', function($leftJoin) {
                            $leftJoin
                            ->on('tab_member_position.group_id', '=', 'tab_group_position.group_id')
                            ->on('tab_member_position.position_id', '=', 'tab_group_position.position_id');
                        })
                        ->where('tab_group_position.group_id', '=', $this->groupId)
                        ->where('catm', '=', $_SESSION['catm_menu'])
                        ->groupBy('member_pid')
                        ->get();
    }

    private function getTitleForDisplay($groupId) {
        $groups = Groups::select('group_name')
                ->where('group_id', '=', $groupId)
                ->first();
        return $groups['group_name'];
    }

    public function getExHeadmanTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_HEADMAN_GROUP_ID);
    }

    public function getExHeadmanHeaderForDisplay() {
        return self::$EX_HEADMAN_HEADER;
    }

    public function getExHeadmanDataForDisplay() {
        $this->groupId = self::$EX_HEADMAN_GROUP_ID;
        $this->fieldForDisplay = self::$EX_HEADMAN_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExSAOTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_SAO_GROUP_ID);
    }

    public function getExSAOHeaderForDisplay() {
        return self::$EX_SAO_HEADER;
    }

    public function getExSAODataForDisplay() {
        $this->groupId = self::$EX_SAO_GROUP_ID;
        $this->fieldForDisplay = self::$EX_SAO_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExVillageCommitteeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_VILLAGE_COMMITTEE_GROUP_ID);
    }

    public function getExVillageCommitteeHeaderForDisplay() {
        return self::$EX_VILLAGE_COMMITTEE_HEADER;
    }

    public function getExVillageCommitteeDataForDisplay() {
        $this->groupId = self::$EX_VILLAGE_COMMITTEE_GROUP_ID;
        $this->fieldForDisplay = self::$EX_VILLAGE_COMMITTEE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExFundVillageCommitteeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_FUND_VILLAGE_COMMITTEE_GROUP_ID);
    }

    public function getExFundVillageCommitteeHeaderForDisplay() {
        return self::$EX_FUND_VILLAGE_COMMITTEE_HEADER;
    }

    public function getExFundVillageCommitteeDataForDisplay() {
        $this->groupId = self::$EX_FUND_VILLAGE_COMMITTEE_GROUP_ID;
        $this->fieldForDisplay = self::$EX_FUND_VILLAGE_COMMITTEE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExProjectVillageCommitteeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_PROJECT_VILLAGE_COMMITTEE_GROUP_ID);
    }

    public function getExProjectVillageCommitteeHeaderForDisplay() {
        return self::$EX_PROJECT_VILLAGE_COMMITTEE_HEADER;
    }

    public function getExProjectVillageCommitteeDataForDisplay() {
        $this->groupId = self::$EX_PROJECT_VILLAGE_COMMITTEE_GROUP_ID;
        $this->fieldForDisplay = self::$EX_PROJECT_VILLAGE_COMMITTEE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExFundWomenDelegateTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_FUND_WOMEN_DELEGATE_GROUP_ID);
    }

    public function getExFundWomenDelegateHeaderForDisplay() {
        return self::$EX_FUND_WOMEN_DELEGATE_HEADER;
    }

    public function getExFundWomenDelegateDataForDisplay() {
        $this->groupId = self::$EX_FUND_WOMEN_DELEGATE_GROUP_ID;
        $this->fieldForDisplay = self::$EX_FUND_WOMEN_DELEGATE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExProjectPoorCommitteeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_PROJECT_POOR_COMMITTEE_GROUP_ID);
    }

    public function getExProjectPoorCommitteeHeaderForDisplay() {
        return self::$EX_PROJECT_POOR_COMMITTEE_HEADER;
    }

    public function getExProjectPoorCommitteeDataForDisplay() {
        $this->groupId = self::$EX_PROJECT_POOR_COMMITTEE_GROUP_ID;
        $this->fieldForDisplay = self::$EX_PROJECT_POOR_COMMITTEE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExFundQueenTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_FUND_QUEEN_GROUP_ID);
    }

    public function getExFundQueenHeaderForDisplay() {
        return self::$EX_FUND_QUEEN_HEADER;
    }

    public function getExFundQueenDataForDisplay() {
        $this->groupId = self::$EX_FUND_QUEEN_GROUP_ID;
        $this->fieldForDisplay = self::$EX_FUND_QUEEN_FIELD;
        return $this->getDataForDisplay();
    }

    public function getExSavingsMenufacturingCommitteeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$EX_SAVINGS_MENUFACTURING_COMMITTEE_GROUP_ID);
    }

    public function getExSavingsMenufacturingCommitteeHeaderForDisplay() {
        return self::$EX_SAVINGS_MENUFACTURING_COMMITTEE_HEADER;
    }

    public function getExSavingsMenufacturingCommitteeDataForDisplay() {
        $this->groupId = self::$EX_SAVINGS_MENUFACTURING_COMMITTEE_GROUP_ID;
        $this->fieldForDisplay = self::$EX_SAVINGS_MENUFACTURING_COMMITTEE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaPublicHealthUndertakeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_PUBLIC_HEALTH_UNDERTAKE_GROUP_ID);
    }

    public function getOrgaPublicHealthUndertakeHeaderForDisplay() {
        return self::$ORGA_PUBLIC_HEALTH_UNDERTAKE_HEADER;
    }

    public function getOrgaPublicHealthUndertakeDataForDisplay() {
        $this->groupId = self::$ORGA_PUBLIC_HEALTH_UNDERTAKE_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_PUBLIC_HEALTH_UNDERTAKE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaSecurityUndertakeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_SECURITY_UNDERTAKE_GROUP_ID);
    }

    public function getOrgaSecurityUndertakeHeaderForDisplay() {
        return self::$ORGA_SECURITY_UNDERTAKE_HEADER;
    }

    public function getOrgaSecurityUndertakeDataForDisplay() {
        $this->groupId = self::$ORGA_SECURITY_UNDERTAKE_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_SECURITY_UNDERTAKE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaDevCommunityUndertakeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_DEV_COMMUNITY_UNDERTAKE_GROUP_ID);
    }

    public function getOrgaDevCommunityUndertakeHeaderForDisplay() {
        return self::$ORGA_DEV_COMMUNITY_UNDERTAKE_HEADER;
    }

    public function getOrgaDevCommunityUndertakeDataForDisplay() {
        $this->groupId = self::$ORGA_DEV_COMMUNITY_UNDERTAKE_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_DEV_COMMUNITY_UNDERTAKE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaLivestockUndertakeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_LIVESTOCK_UNDERTAKE_GROUP_ID);
    }

    public function getOrgaLivestockUndertakeHeaderForDisplay() {
        return self::$ORGA_LIVESTOCK_UNDERTAKE_HEADER;
    }

    public function getOrgaLivestockUndertakeDataForDisplay() {
        $this->groupId = self::$ORGA_LIVESTOCK_UNDERTAKE_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_LIVESTOCK_UNDERTAKE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrga25PineappleTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_25_PINEAPPLE_GROUP_ID);
    }

    public function getOrga25PineappleHeaderForDisplay() {
        return self::$ORGA_25_PINEAPPLE_HEADER;
    }

    public function getOrga25PineappleDataForDisplay() {
        $this->groupId = self::$ORGA_25_PINEAPPLE_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_25_PINEAPPLE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaRedCrossUndertakeTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_RED_CROSS_UNDERTAKE_GROUP_ID);
    }

    public function getOrgaRedCrossUndertakeHeaderForDisplay() {
        return self::$ORGA_RED_CROSS_UNDERTAKE_HEADER;
    }

    public function getOrgaRedCrossUndertakeDataForDisplay() {
        $this->groupId = self::$ORGA_RED_CROSS_UNDERTAKE_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_RED_CROSS_UNDERTAKE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaMediateCivilDelegateTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_MEDIATE_CIVIL_DELEGATE_GROUP_ID);
    }

    public function getOrgaMediateCivilDelegateHeaderForDisplay() {
        return self::$ORGA_MEDIATE_CIVIL_DELEGATE_HEADER;
    }

    public function getOrgaMediateCivilDelegateDataForDisplay() {
        $this->groupId = self::$ORGA_MEDIATE_CIVIL_DELEGATE_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_MEDIATE_CIVIL_DELEGATE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaFarmerTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_FARMER_GROUP_ID);
    }

    public function getOrgaFarmerHeaderForDisplay() {
        return self::$ORGA_FARMER_HEADER;
    }

    public function getOrgaFarmerDataForDisplay() {
        $this->groupId = self::$ORGA_FARMER_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_FARMER_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOrgaSoilDocterTitleForDisplay() {
        return $this->getTitleForDisplay(self::$ORGA_SOIL_DOCTER_GROUP_ID);
    }

    public function getOrgaSoilDocterHeaderForDisplay() {
        return self::$ORGA_SOIL_DOCTER_HEADER;
    }

    public function getOrgaSoilDocterDataForDisplay() {
        $this->groupId = self::$ORGA_SOIL_DOCTER_GROUP_ID;
        $this->fieldForDisplay = self::$ORGA_SOIL_DOCTER_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOlderOlderTitleForDisplay() {
        return $this->getTitleForDisplay(self::$OLDER_OLDER_GROUP_ID);
    }

    public function getOlderOlderHeaderForDisplay() {
        return self::$OLDER_OLDER_HEADER;
    }

    public function getOlderOlderDataForDisplay() {
        $this->groupId = self::$OLDER_OLDER_GROUP_ID;
        $this->fieldForDisplay = self::$OLDER_OLDER_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOlderDisabledTitleForDisplay() {
        return $this->getTitleForDisplay(self::$OLDER_DISABLED_GROUP_ID);
    }

    public function getOlderDisabledHeaderForDisplay() {
        return self::$OLDER_DISABLED_HEADER;
    }

    public function getOlderDisabledDataForDisplay() {
        $this->groupId = self::$OLDER_DISABLED_GROUP_ID;
        $this->fieldForDisplay = self::$OLDER_DISABLED_FIELD;
        return $this->getDataForDisplay();
    }

    public function getOlderMiserableTitleForDisplay() {
        return $this->getTitleForDisplay(self::$OLDER_MISERABLE_GROUP_ID);
    }

    public function getOlderMiserableHeaderForDisplay() {
        return self::$OLDER_MISERABLE_HEADER;
    }

    public function getOlderMiserableDataForDisplay() {
        $this->groupId = self::$OLDER_MISERABLE_GROUP_ID;
        $this->fieldForDisplay = self::$OLDER_MISERABLE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMenuNameForDisplay() {
        $menuName = MenuSetting::select('menu_name_th')
                ->where('menu_id', '=', self::$MENU_ID)
                ->first();
        return str_replace('การบันทึก', '', $menuName['menu_name_th']);
    }

}
