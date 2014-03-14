<?php

class TravelType extends Eloquent {

    protected $table = 'tab_travel_type';
    public $timestamps = false;
    protected $primaryKey = 'travel_type';

    public function travel() {
        return $this->hasMany('Travel', 'travel_type');
    }

}
