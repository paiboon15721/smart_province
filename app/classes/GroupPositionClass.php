<?php

class GroupPositionClass {

    public function getGroupPositionNameList($groupId) {
        if ($groupId == 25) {
            return GroupPositionCareer::where('catm', '=', $_SESSION['catm_menu'])
                            ->lists('position_name', 'position_id');
        } else {
            return GroupPosition::where('group_id', '=', $groupId)
                            ->lists('position_name', 'position_id');
        }
    }

}
