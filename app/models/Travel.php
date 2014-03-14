<?php

class Travel extends Eloquent {

    protected $table = 'tab_travel';
    public $timestamps = false;
    protected $primaryKey = 'travel_id';

    public function travelType() {
        return $this->belongsTo('TravelType', 'travel_type')->select('travel_type', 'travel_type_name');
    }

}
