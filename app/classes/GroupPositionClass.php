<?php

class GroupPositionClass {

    public function getGroupPositionNameList($groupId) {
        return GroupPosition::where('group_id', '=', $groupId)
                        ->lists('position_name', 'position_id');
    }

}
