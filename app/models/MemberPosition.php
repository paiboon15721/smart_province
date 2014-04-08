<?php

class MemberPosition extends Eloquent {

    protected $table = 'tab_member_position';
    public $timestamps = false;
    protected $primaryKey = 'member_pid';

    public function memberPosition() {
        return $this->belongsToMany('GroupMember', 'member_pid');
    }

}
