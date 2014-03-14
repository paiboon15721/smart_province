<?php

class GroupMemberClass {

    private $groupId;
    private $fieldForDisplay = array();
    private static $EX_HEADMAN_GROUP_ID = 1;
    private static $EX_HEADMAN_TITLE = 'ผู้ใหญ่บ้าน/ผู้ช่วยผู้ใหญ่บ้าน';
    private static $EX_HEADMAN_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name', 'images');
    private static $EX_HEADMAN_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง'),
        array('class' => 'center', 'width' => '150px', 'text' => 'รูปภาพ')
    );
    private static $EX_SAO_GROUP_ID = 2;
    private static $EX_SAO_TITLE = 'สมาชิกสภาท้องถิ่น (เทศบาล/อบต.) ประจำหมู่บ้าน';
    private static $EX_SAO_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address');
    private static $EX_SAO_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่')
    );
    private static $EX_VILLAGE_COMMITTEE_GROUP_ID = 3;
    private static $EX_VILLAGE_COMMITTEE_TITLE = 'คณะกรรมการหมู่บ้าน';
    private static $EX_VILLAGE_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_VILLAGE_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_FUND_VILLAGE_COMMITTEE_GROUP_ID = 4;
    private static $EX_FUND_VILLAGE_COMMITTEE_TITLE = 'คณะกรรมการกองทุนหมู่บ้านและชุมชนเมือง (กทบ.)';
    private static $EX_FUND_VILLAGE_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_FUND_VILLAGE_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_PROJECT_VILLAGE_COMMITTEE_GROUP_ID = 5;
    private static $EX_PROJECT_VILLAGE_COMMITTEE_TITLE = 'คณะกรรมการโครงการหมู่บ้านและชุมชนเมือง (SML)';
    private static $EX_PROJECT_VILLAGE_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_PROJECT_VILLAGE_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_FUND_WOMEN_DELEGATE_GROUP_ID = 6;
    private static $EX_FUND_WOMEN_DELEGATE_TITLE = 'ผู้แทนกองทุนพัฒนาบทบาทสตรีประจำหมู่บ้าน';
    private static $EX_FUND_WOMEN_DELEGATE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname');
    private static $EX_FUND_WOMEN_DELEGATE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล')
    );
    private static $EX_PROJECT_POOR_COMMITTEE_GROUP_ID = 8;
    private static $EX_PROJECT_POOR_COMMITTEE_TITLE = 'คณะกรรมการโครงการแก้ไขปัญหาความยากจน (กข.คจ.)';
    private static $EX_PROJECT_POOR_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_PROJECT_POOR_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_FUND_QUEEN_GROUP_ID = 9;
    private static $EX_FUND_QUEEN_TITLE = 'คณะกรรมการกองทุนแม่ของแผ่นดิน';
    private static $EX_FUND_QUEEN_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_FUND_QUEEN_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $EX_SAVINGS_MENUFACTURING_COMMITTEE_GROUP_ID = 10;
    private static $EX_SAVINGS_MENUFACTURING_COMMITTEE_TITLE = 'คณะกรรมการกลุ่มออมทรัพย์เพื่อการผลิต';
    private static $EX_SAVINGS_MENUFACTURING_COMMITTEE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'position_name');
    private static $EX_SAVINGS_MENUFACTURING_COMMITTEE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ตำแหน่ง')
    );
    private static $ORGA_PUBLIC_HEALTH_UNDERTAKE_GROUP_ID = 12;
    private static $ORGA_PUBLIC_HEALTH_UNDERTAKE_TITLE = 'อาสาสมัครสาธารณสุขประจำหมู่บ้าน (อสม.)';
    private static $ORGA_PUBLIC_HEALTH_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_PUBLIC_HEALTH_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_SECURITY_UNDERTAKE_GROUP_ID = 13;
    private static $ORGA_SECURITY_UNDERTAKE_TITLE = 'อาสาสมัครป้องกันภัยฝ่ายพลเรือน (อปพร.)';
    private static $ORGA_SECURITY_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_SECURITY_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_DEV_COMMUNITY_UNDERTAKE_GROUP_ID = 14;
    private static $ORGA_DEV_COMMUNITY_UNDERTAKE_TITLE = 'อาสาพัฒนาชุมชนประจำหมู่บ้าน (อช.)';
    private static $ORGA_DEV_COMMUNITY_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_DEV_COMMUNITY_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_LIVESTOCK_UNDERTAKE_GROUP_ID = 15;
    private static $ORGA_LIVESTOCK_UNDERTAKE_TITLE = 'อาสาปศุสัตว์ (อศ.)';
    private static $ORGA_LIVESTOCK_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_LIVESTOCK_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_25_PINEAPPLE_GROUP_ID = 16;
    private static $ORGA_25_PINEAPPLE_TITLE = '25 ตาสับปะรด';
    private static $ORGA_25_PINEAPPLE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_25_PINEAPPLE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_RED_CROSS_UNDERTAKE_GROUP_ID = 17;
    private static $ORGA_RED_CROSS_UNDERTAKE_TITLE = 'อาสากาชาด';
    private static $ORGA_RED_CROSS_UNDERTAKE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_RED_CROSS_UNDERTAKE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_MEDIATE_CIVIL_DELEGATE_GROUP_ID = 18;
    private static $ORGA_MEDIATE_CIVIL_DELEGATE_TITLE = 'ผู้แทนผู้ไกล่เกลี่ยและประนอมข้อพิพาททางแพ่ง';
    private static $ORGA_MEDIATE_CIVIL_DELEGATE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_MEDIATE_CIVIL_DELEGATE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_FARMER_GROUP_ID = 19;
    private static $ORGA_FARMER_TITLE = 'อาสาสมัครเกษตร (อกม.)';
    private static $ORGA_FARMER_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_FARMER_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $ORGA_SOIL_DOCTER_GROUP_ID = 20;
    private static $ORGA_SOIL_DOCTER_TITLE = 'หมอดินอาสา';
    private static $ORGA_SOIL_DOCTER_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $ORGA_SOIL_DOCTER_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $OLDER_OLDER_GROUP_ID = 22;
    private static $OLDER_OLDER_TITLE = 'ผู้สูงอายุ';
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
    private static $OLDER_DISABLED_TITLE = 'ผู้พิการ';
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
    private static $OLDER_MISERABLE_TITLE = 'ผู้ยากไร้';
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
                        ->where('catm', '=', Session::get('catmId'))
                        ->groupBy('member_pid')
                        ->get();
    }

    public function getExHeadmanTitleForDisplay() {
        return self::$EX_HEADMAN_TITLE;
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
        return self::$EX_SAO_TITLE;
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
        return self::$EX_VILLAGE_COMMITTEE_TITLE;
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
        return self::$EX_FUND_VILLAGE_COMMITTEE_TITLE;
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
        return self::$EX_PROJECT_VILLAGE_COMMITTEE_TITLE;
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
        return self::$EX_FUND_WOMEN_DELEGATE_TITLE;
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
        return self::$EX_PROJECT_POOR_COMMITTEE_TITLE;
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
        return self::$EX_FUND_QUEEN_TITLE;
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
        return self::$EX_SAVINGS_MENUFACTURING_COMMITTEE_TITLE;
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
        return self::$ORGA_PUBLIC_HEALTH_UNDERTAKE_TITLE;
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
        return self::$ORGA_SECURITY_UNDERTAKE_TITLE;
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
        return self::$ORGA_DEV_COMMUNITY_UNDERTAKE_TITLE;
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
        return self::$ORGA_LIVESTOCK_UNDERTAKE_TITLE;
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
        return self::$ORGA_25_PINEAPPLE_TITLE;
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
        return self::$ORGA_RED_CROSS_UNDERTAKE_TITLE;
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
        return self::$ORGA_MEDIATE_CIVIL_DELEGATE_TITLE;
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
        return self::$ORGA_FARMER_TITLE;
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
        return self::$ORGA_SOIL_DOCTER_TITLE;
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
        return self::$OLDER_OLDER_TITLE;
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
        return self::$OLDER_DISABLED_TITLE;
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
        return self::$OLDER_MISERABLE_TITLE;
    }

    public function getOlderMiserableHeaderForDisplay() {
        return self::$OLDER_MISERABLE_HEADER;
    }

    public function getOlderMiserableDataForDisplay() {
        $this->groupId = self::$OLDER_MISERABLE_GROUP_ID;
        $this->fieldForDisplay = self::$OLDER_MISERABLE_FIELD;
        return $this->getDataForDisplay();
    }

}
