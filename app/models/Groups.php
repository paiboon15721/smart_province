<?php

class Groups extends Eloquent {

    protected $table = 'tab_groups';
    public $timestamps = false;
    protected $primaryKey = 'group_id';

    public function groupPosition() {
        return $this->hasMany('GroupPosition', 'group_id');
    }

}
