<?php

class GroupMember extends Eloquent {

    protected $table = 'tab_group_member';
    public $timestamps = false;
    protected $primaryKey = 'member_pid';

    public function title() {
        return $this->belongsTo('Title', 'title_code')->select('title_code', 'title_print');
    }

    public function memberPosition() {
        return $this->hasMany('MemberPosition', 'member_pid')
                        ->leftJoin('tab_group_position', function($leftJoin) {
                            $leftJoin
                            ->on('tab_member_position.group_id', '=', 'tab_group_position.group_id')
                            ->on('tab_member_position.position_id', '=', 'tab_group_position.position_id');
                        });
    }

}
