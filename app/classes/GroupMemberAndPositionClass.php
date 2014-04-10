<?php

class GroupMemberAndPositionClass {

    private $groupId;
    private $positionId;
    private $fieldForDisplay = array();
    private static $MEMBER_DIRECTOR_GROUP_ID = 21;
    private static $MEMBER_DIRECTOR_POSITION_ID = 1;
    private static $MEMBER_DIRECTOR_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $MEMBER_DIRECTOR_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $MEMBER_SECURITY_GROUP_ID = 21;
    private static $MEMBER_SECURITY_POSITION_ID = 2;
    private static $MEMBER_SECURITY_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $MEMBER_SECURITY_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $MEMBER_DEVELOP_GROUP_ID = 21;
    private static $MEMBER_DEVELOP_POSITION_ID = 3;
    private static $MEMBER_DEVELOP_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $MEMBER_DEVELOP_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $MEMBER_ECONOMY_GROUP_ID = 21;
    private static $MEMBER_ECONOMY_POSITION_ID = 4;
    private static $MEMBER_ECONOMY_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $MEMBER_ECONOMY_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $MEMBER_SOCIAL_GROUP_ID = 21;
    private static $MEMBER_SOCIAL_POSITION_ID = 5;
    private static $MEMBER_SOCIAL_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $MEMBER_SOCIAL_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $MEMBER_CULTURE_GROUP_ID = 21;
    private static $MEMBER_CULTURE_POSITION_ID = 6;
    private static $MEMBER_CULTURE_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $MEMBER_CULTURE_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
    );
    private static $MEMBER_PERFORM_GROUP_ID = 21;
    private static $MEMBER_PERFORM_POSITION_ID = 7;
    private static $MEMBER_PERFORM_FIELD = array('tab_group_member.member_pid', 'title_code', 'fname', 'mname', 'lname', 'member_address', 'member_phone1');
    private static $MEMBER_PERFORM_HEADER = array(
        array('class' => 'center', 'width' => '100px', 'text' => 'ลำดับที่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'รหัสบัตรประชาชน'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ชื่อ-นามสกุล'),
        array('class' => 'center', 'width' => '150px', 'text' => 'ที่อยู่'),
        array('class' => 'center', 'width' => '100px', 'text' => 'หมายเลขโทรศัพท์')
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
                        ->where('tab_group_position.position_id', '=', $this->positionId)
                        ->where('catm', '=', Session::get('catmId'))
                        ->groupBy('member_pid')
                        ->get();
    }

    private function getTitleForDisplay($groupId, $positionId) {
        return GroupPosition::select('position_name')
                        ->where('group_id', '=', $groupId)
                        ->where('position_id', '=', $positionId)
                        ->first()['position_name'];
    }

    public function getMemberDirectorTitleForDisplay() {
        return $this->getTitleForDisplay(self::$MEMBER_DIRECTOR_GROUP_ID, self::$MEMBER_DIRECTOR_POSITION_ID);
    }

    public function getMemberDirectorHeaderForDisplay() {
        return self::$MEMBER_DIRECTOR_HEADER;
    }

    public function getMemberDirectorDataForDisplay() {
        $this->groupId = self::$MEMBER_DIRECTOR_GROUP_ID;
        $this->positionId = self::$MEMBER_DIRECTOR_POSITION_ID;
        $this->fieldForDisplay = self::$MEMBER_DIRECTOR_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMemberSecurityTitleForDisplay() {
        return $this->getTitleForDisplay(self::$MEMBER_SECURITY_GROUP_ID, self::$MEMBER_SECURITY_POSITION_ID);
    }

    public function getMemberSecurityHeaderForDisplay() {
        return self::$MEMBER_SECURITY_HEADER;
    }

    public function getMemberSecurityDataForDisplay() {
        $this->groupId = self::$MEMBER_SECURITY_GROUP_ID;
        $this->positionId = self::$MEMBER_SECURITY_POSITION_ID;
        $this->fieldForDisplay = self::$MEMBER_SECURITY_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMemberDevelopTitleForDisplay() {
        return $this->getTitleForDisplay(self::$MEMBER_DEVELOP_GROUP_ID, self::$MEMBER_DEVELOP_POSITION_ID);
    }

    public function getMemberDevelopHeaderForDisplay() {
        return self::$MEMBER_DEVELOP_HEADER;
    }

    public function getMemberDevelopDataForDisplay() {
        $this->groupId = self::$MEMBER_DEVELOP_GROUP_ID;
        $this->positionId = self::$MEMBER_DEVELOP_POSITION_ID;
        $this->fieldForDisplay = self::$MEMBER_DEVELOP_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMemberEconomyTitleForDisplay() {
        return $this->getTitleForDisplay(self::$MEMBER_ECONOMY_GROUP_ID, self::$MEMBER_ECONOMY_POSITION_ID);
    }

    public function getMemberEconomyHeaderForDisplay() {
        return self::$MEMBER_ECONOMY_HEADER;
    }

    public function getMemberEconomyDataForDisplay() {
        $this->groupId = self::$MEMBER_ECONOMY_GROUP_ID;
        $this->positionId = self::$MEMBER_ECONOMY_POSITION_ID;
        $this->fieldForDisplay = self::$MEMBER_ECONOMY_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMemberSocialTitleForDisplay() {
        return $this->getTitleForDisplay(self::$MEMBER_SOCIAL_GROUP_ID, self::$MEMBER_SOCIAL_POSITION_ID);
    }

    public function getMemberSocialHeaderForDisplay() {
        return self::$MEMBER_SOCIAL_HEADER;
    }

    public function getMemberSocialDataForDisplay() {
        $this->groupId = self::$MEMBER_SOCIAL_GROUP_ID;
        $this->positionId = self::$MEMBER_SOCIAL_POSITION_ID;
        $this->fieldForDisplay = self::$MEMBER_SOCIAL_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMemberCultureTitleForDisplay() {
        return $this->getTitleForDisplay(self::$MEMBER_CULTURE_GROUP_ID, self::$MEMBER_CULTURE_POSITION_ID);
    }

    public function getMemberCultureHeaderForDisplay() {
        return self::$MEMBER_CULTURE_HEADER;
    }

    public function getMemberCultureDataForDisplay() {
        $this->groupId = self::$MEMBER_CULTURE_GROUP_ID;
        $this->positionId = self::$MEMBER_CULTURE_POSITION_ID;
        $this->fieldForDisplay = self::$MEMBER_CULTURE_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMemberPerformTitleForDisplay() {
        return $this->getTitleForDisplay(self::$MEMBER_PERFORM_GROUP_ID, self::$MEMBER_PERFORM_POSITION_ID);
    }

    public function getMemberPerformHeaderForDisplay() {
        return self::$MEMBER_PERFORM_HEADER;
    }

    public function getMemberPerformDataForDisplay() {
        $this->groupId = self::$MEMBER_PERFORM_GROUP_ID;
        $this->positionId = self::$MEMBER_PERFORM_POSITION_ID;
        $this->fieldForDisplay = self::$MEMBER_PERFORM_FIELD;
        return $this->getDataForDisplay();
    }

}
