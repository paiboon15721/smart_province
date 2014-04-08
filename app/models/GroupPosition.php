<?php

class GroupPosition extends Eloquent {

    protected $table = 'tab_group_position';
    public $timestamps = false;
    protected $primaryKey = 'position_id';

    public function groups() {
        return $this->BelongsTo('Groups', 'group_id');
    }

    public function memberPosition() {
        return $this->hasMany('MemberPosition', 'position_id');
    }

}
