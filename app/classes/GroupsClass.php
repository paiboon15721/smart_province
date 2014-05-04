<?php

class GroupsClass {

    public function getGroupsNameList() {
        return Groups::lists('group_name', 'group_id');
    }

}
