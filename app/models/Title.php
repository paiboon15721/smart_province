<?php

class Title extends Eloquent {

    protected $table = 'title';
    public $timestamps = false;
    protected $primaryKey = 'title_code';

    public function groupMember() {
        return $this->hasMany('GroupMember', 'title_code');
    }

}
